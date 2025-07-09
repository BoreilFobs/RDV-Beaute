<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;

class FcmService
{
    protected $serverKey;

    public function __construct()
    {
        $this->serverKey = config('services.fcm.server_key');
    }

    public function sendToToken(string $token, string $title, string $body)
    {
        return Http::withHeaders([
            'Authorization' => 'key=' . $this->serverKey,
            'Content-Type' => 'application/json',
        ])->post('https://fcm.googleapis.com/fcm/send', [
            'to' => $token,
            'notification' => [
                'title' => $title,
                'body' => $body,
                'click_action' => url('/'), // optional
            ],
        ]);
    }
}
