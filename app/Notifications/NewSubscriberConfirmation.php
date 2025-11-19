<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewSubscriberConfirmation extends Notification implements ShouldQueue
{
    use Queueable;

    public string $name;
    public string $email;

    public function __construct(string $name, string $email)
    {
        $this->name = $name;
        $this->email = $email;
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $unsubscribeUrl = route('web.newsletter.unsubscribe', ['email' => $this->email]);

        return (new MailMessage)
            ->subject('Bedankt voor je aanmelding 🎉')
            ->greeting('Hoi ' . $this->name . ',')
            ->line('Bedankt dat je je hebt aangemeld voor onze nieuwsbrief!')
            ->line('Vanaf nu blijf je op de hoogte van nieuwe artikelen, updates en handige tips.')
            ->action('Bezoek de website', url('/'))
            ->line('')
            ->line('--------------------------------------------------')
            ->line('Wil je je uitschrijven? Klik hier:')
            ->line($unsubscribeUrl)
            ->salutation("Met vriendelijke groet,\nHet Coachklik-team");
    }
}
