<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Post;

class NewsLetterNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public Post $post;
    public string $url;

    public function __construct(Post $post, string $url)
    {
        $this->post = $post;
        $this->url = $url;
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $name = $notifiable->name ?? 'lezer';
        $unsubscribeUrl = route('web.newsletter.unsubscribe', ['email' => $notifiable->email]);

        return (new MailMessage)
            ->subject("Nieuwsbrief Yvonne Koobs: {$this->post->title}")
            ->greeting("Beste {$name},")
            ->line("Er is een nieuw artikel gepubliceerd op onze website:")
            ->line($this->post->title)  // no markdown here
            ->line(str($this->post->excerpt)->limit(150))
            ->action('Lees het artikel', $this->url)
            ->line('Bedankt voor je interesse in onze nieuwsbrief!')
            ->line('')
            ->line('--------------------------------------------------')
            ->line('Wil je geen nieuwsbrief meer ontvangen?')
            ->line("Klik hier om je uit te schrijven: $unsubscribeUrl");
    }
}
