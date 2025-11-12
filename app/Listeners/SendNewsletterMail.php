<?php

namespace App\Listeners;

use App\Events\BlogPostPublished;
use App\Models\NewsletterSubscriber;
use App\Notifications\NewsLetterNotification;

class SendNewsletterMail
{
    /**
     * Handle the event.
     */
    public function handle(BlogPostPublished $event): void
    {

        \Log::info('blog post published');

        $post = $event->post;
        $url = route('web.posts.show', $post->slug);

        $subscribers = NewsletterSubscriber::where('active', true)->get();

        foreach ($subscribers as $subscriber) {
            $subscriber->notify(new NewsLetterNotification($post, $url));
        }
    }
}
