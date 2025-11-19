<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UnsubscribedConfirmation extends Notification implements ShouldQueue
{
    use Queueable;

    public string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Je bent uitgeschreven 💛')
            ->greeting('Hoi ' . $this->name . ',')
            ->line('Je bent succesvol uitgeschreven van onze nieuwsbrief.')
            ->line('Je ontvangt vanaf nu geen e-mails meer van ons.')
            ->action('Bezoek de website', url('/'))
            ->salutation("Met vriendelijke groet,\nHet Coachklik-team");
    }
}
