<?php

namespace App\Observers;

use App\Events\BlogPostPublished;
use App\Models\Post;

class PostObserver
{
    /**
     * Handle the Post "created" event.
     */
    public function created(Post $post): void
    {
        // Only when created as published + newsletter
        if ($post->is_published && $post->is_newsletter_post) {
            BlogPostPublished::dispatch($post);
        }
    }

    /**
     * Handle the Post "updated" event.
     */
    public function updated(Post $post): void
    {
        // If a post was previously not published/newsletter but now is
        if (
            $post->is_published &&
            $post->is_newsletter_post &&
            (
                $post->wasChanged('is_published') ||
                $post->wasChanged('is_newsletter_post')
            )
        ) {
            BlogPostPublished::dispatch($post);
        }
    }
}
