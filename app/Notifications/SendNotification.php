<?php
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use App\Channels\FcmChannel;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification as FirebaseNotification;

class SendNotification extends Notification
{
    use Queueable;

    protected string $name;
    protected string $title;
    protected string $body;
    protected ?string $url;

    /**
     * Create a new notification instance.
     */
    public function __construct(string $name, string $title, string $body, ?string $url = null)
    {
        $this->name = $name;
        $this->title = $title;
        $this->body  = $body;
        $this->url   = $url;
    }

    /**
     * Get the delivery channels.
     */
    public function via(object $notifiable): array
    {
        return [FcmChannel::class];
    }

    /**
     * Convert to FCM format.
     */
    public function toFcm(object $notifiable): CloudMessage
    {
        return CloudMessage::withTarget('token', $notifiable->fcm_token)
            ->withNotification(FirebaseNotification::create(
                $this->title,
                "Hey {$this->name}, {$this->body}"
            ))
            ->withData([
                'click_action' => $this->url ?? '',
                'user_id' => (string) $notifiable->id,
                
            ]);
    }
}
