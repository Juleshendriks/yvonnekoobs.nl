<?php

namespace App\Http\Controllers;

use App\Models\NewsletterSubscriber;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    public function subscribe(Request $request)
    {
        $data = $request->validate(
            [
                'email' => 'required|email',
                'name' => 'required',
            ]
        );


        $subscriber = NewsletterSubscriber::where('email', $data['email'])->first();

        if ($subscriber) {
            $subscriber->active = 1;
        } else {
            $subscriber = new NewsletterSubscriber($data);
        }

        $subscriber->save();

        return redirect()->back()->with('success', 'Bedankt voor je aanmelding!');
    }

    public function unsubscribe(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email', 'exists:newsletter_subscribers,email'],
        ]);

        $subscriber = NewsletterSubscriber::where('email', $request->email)->first();

        if ($subscriber) {
            $subscriber->active = false;
            $subscriber->save();

            return view('web.newsletter.unsubscribe-success'); // Blade with Vue inside
        }

        return view('web.newsletter.unsubscribe-failed');
    }

}
