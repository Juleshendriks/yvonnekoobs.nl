<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('user')
            ->where('is_published', true)
            ->where('published_at', '<=', now())
            ->orderBy('published_at', 'desc')
            ->paginate(9);

        return view('web.posts.index', compact('posts'));
    }

    public function show(Post $post)
    {
        // Check if post is published
        if (!$post->is_published || $post->published_at > now()) {
            abort(404);
        }

        // Increment view count
        $post->increment('view_count');

        // Load the user relationship
        $post->load('user');

        return view('web.posts.show', compact('post'));
    }
}
