<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\ContactSubmission;

class ContactConfirmationMail extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(
        public ContactSubmission $submission
    ) {}

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Bedankt voor je bericht 🙏')
            ->greeting('Hoi ' . $this->submission->name . ',')
            ->line('Bedankt dat je contact hebt opgenomen. We hebben je bericht goed ontvangen.')
            ->line('**Onderwerp:** ' . $this->submission->subject)
            ->line('**Je bericht:**')
            ->line('“' . $this->submission->message . '”')
            ->line('Wij nemen zo snel mogelijk contact met je op via ' . $this->submission->email . '.')
            ->action('Terug naar de website', url('/'))
            ->salutation("Met vriendelijke groet,\nHet Coachklik-team");
    }
}
