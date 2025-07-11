<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use GuzzleHttp\Exception\RequestException;

class OrangeSmsService
{
    protected $clientId;
    protected $clientSecret;
    protected $senderAddress; // Can be a phone number or alphanumeric sender ID

    public function __construct()
    {
        $this->clientId = config('services.orange.client_id');
        $this->clientSecret = config('services.orange.client_secret');
        $this->senderAddress = config('services.orange.sender_address'); // or config('services.orange.sender_name')
    }

    /**
     * Get an Orange API access token.
     * Caches the token to avoid repeated authentication.
     *
     * @return string|null
     */
    protected function getAccessToken()
    {
        // Cache the token for a specific duration (e.g., 55 minutes, as tokens usually expire in 60)
        return Cache::remember('orange_sms_access_token', 3300, function () {
            try {
                $response = Http::asForm()->post('https://api.orange.com/oauth/v3/token', [
                    'grant_type' => 'client_credentials',
                    'client_id' => $this->clientId,
                    'client_secret' => $this->clientSecret,
                ]);

                $response->throw(); // Throw an exception if a client or server error occurred

                $data = $response->json();
                return $data['access_token'] ?? null;
            } catch (RequestException $e) {
                // Log the error for debugging
                logger()->error('Orange SMS API Token Error: ' . $e->getMessage(), ['response' => $e->response->body()]);
                return null;
            }
        });
    }

    /**
     * Send an SMS message.
     *
     * @param string $recipientPhoneNumber The recipient's phone number in international format (e.g., 237XXXXXXXXX).
     * @param string $message The content of the SMS.
     * @return array
     */
    public function sendSms(string $recipientPhoneNumber, string $message): array
    {
        $accessToken = $this->getAccessToken();

        if (!$accessToken) {
            return ['success' => false, 'message' => 'Failed to obtain Orange API access token.'];
        }

        try {
            // Orange expects phone numbers in a specific format: tel:+{number}
            $formattedRecipient = 'tel:+' . preg_replace('/[^0-9]/', '', $recipientPhoneNumber);
            $formattedSender = $this->senderAddress;

            // Determine if sender is a number or alphanumeric
            if (!str_starts_with($formattedSender, 'tel:+')) {
                // If it's an alphanumeric sender, you might need a different endpoint or parameter
                // Consult Orange API documentation for alphanumeric sender specifics.
                // For this example, we assume it's a 'tel:' format or you've configured it correctly.
                // If using alphanumeric, the 'senderAddress' might just be the string itself,
                // and the API endpoint might change. The general Orange SMS API for MEA region
                // often uses 'senderName' for alphanumeric.
                // For simplicity, we stick to the 'tel:' format here.
                // If Orange Cameroon requires 'senderName' for alphanumeric:
                // $payload['outboundSMSMessageRequest']['senderName'] = $this->senderAddress;
                // unset($payload['outboundSMSMessageRequest']['senderAddress']);
            }


            $payload = [
                'outboundSMSMessageRequest' => [
                    'address' => $formattedRecipient,
                    'senderAddress' => $formattedSender, // Use your Orange number or approved alphanumeric sender
                    'outboundSMSTextMessage' => [
                        'message' => $message,
                    ],
                ],
            ];

            // The senderAddress in the URL part should match the one in the payload for Orange SMS API (MEA)
            // Example: https://api.orange.com/smsmessaging/v1/outbound/tel%3A%2B{country_sender_number}/requests
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])->post("https://api.orange.com/smsmessaging/v1/outbound/tel%3A%2B" . preg_replace('/[^0-9]/', '', $formattedSender) . "/requests", $payload);


            $response->throw(); // Throw an exception for 4xx or 5xx responses

            return ['success' => true, 'data' => $response->json()];

        } catch (RequestException $e) {
            // Log the error for debugging
            logger()->error('Orange SMS API Send SMS Error: ' . $e->getMessage(), ['response' => $e->response->body()]);
            return ['success' => false, 'message' => 'Failed to send SMS: ' . $e->getMessage(), 'response' => $e->response ? $e->response->json() : null];
        } catch (\Exception $e) {
            logger()->error('Orange SMS API General Error: ' . $e->getMessage());
            return ['success' => false, 'message' => 'An unexpected error occurred: ' . $e->getMessage()];
        }
    }
}