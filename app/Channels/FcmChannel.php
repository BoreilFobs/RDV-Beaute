<?php

namespace App\Channels;

use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Log;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification as FirebaseNotification;
use Kreait\Firebase\Contract\Messaging;

class FcmChannel
{
    protected $messaging;

    public function __construct(Messaging $messaging)
    {
        $this->messaging = $messaging;
    }

    /**
     * Send the given notification.
     *
     * @param  mixed  $notifiable
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return void
     */
    public function send(mixed $notifiable, Notification $notification): void
    {
        $fcmToken = $notifiable->fcm_token;

        if (! $fcmToken) {
            // User does not have an FCM token, so we cannot send a notification.
            return;
        }

        $message = $notification->toFcm($notifiable); // Notification class will define this method

        try {
            $this->messaging->send($message);
        } catch (\Throwable $e) {
            // Log the error for debugging
            Log::error('FCM Notification Error: ' . $e->getMessage(), [
                'token' => $fcmToken,
                'notification_data' => $message->jsonSerialize()
            ]);
        }
    }
}