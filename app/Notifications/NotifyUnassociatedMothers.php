<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;

class NotifyUnassociatedMothers extends Notification
{
    use Queueable;

    protected $totalUnassociated;

    public function __construct($totalUnassociated)
    {
        $this->totalUnassociated = $totalUnassociated;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'total_unassociated' => $this->totalUnassociated,
        ];
    }
}
