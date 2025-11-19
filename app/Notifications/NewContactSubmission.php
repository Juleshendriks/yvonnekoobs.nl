<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\ContactSubmission;

class NewContactSubmission extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(
        public ContactSubmission $submission
    ) {}

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Nieuwe contactaanvraag ontvangen 📩')
            ->greeting('Hallo Yvonne,')
            ->line('Er is een nieuwe contactaanvraag binnengekomen.')
            ->line('**Naam:** ' . $this->submission->name)
            ->line('**E-mail:** ' . $this->submission->email)
            ->line('**Onderwerp:** ' . $this->submission->subject)
            ->line('**Bericht:**')
            ->line('“' . $this->submission->message . '”')
            ->line('---')
            ->line('**IP-adres:** ' . $this->submission->ip_address)
            ->line('**User agent:** ' . $this->submission->user_agent)
            ->line('**Status:** ' . $this->submission->status->value)
            ->action('Bekijk inzending', url('/admin/contact-submissions/'))
            ->salutation("Met vriendelijke groet,\nHet Coachklik-systeem");
    }

    public function toArray(object $notifiable): array
    {
        return [
            'submission_id' => $this->submission->id,
            'name' => $this->submission->name,
            'email' => $this->submission->email,
            'subject' => $this->submission->subject,
        ];
    }
}
