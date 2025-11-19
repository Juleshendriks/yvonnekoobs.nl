<?php

namespace App\Http\Controllers;

use App\Models\NewsletterSubscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use App\Notifications\NewSubscriberConfirmation;
use App\Notifications\UnsubscribedConfirmation;

class NewsletterController extends Controller
{
    public function subscribe(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email',
            'name' => 'required|string',
            'last_name' => 'prohibited'
        ]);

        $subscriber = NewsletterSubscriber::firstOrNew(['email' => $data['email']]);
        $subscriber->name = $data['name'];
        $subscriber->active = true;
        $subscriber->save();

        // Verstuur queueable bevestiging
        Notification::route('mail', $subscriber->email)
            ->notify(new NewSubscriberConfirmation($subscriber->name, $subscriber->email));

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

            // Verstuur queueable uitschrijvingsbevestiging
            Notification::route('mail', $subscriber->email)
                ->notify(new UnsubscribedConfirmation($subscriber->name));

            return view('web.newsletter.unsubscribe-success');
        }

        return view('web.newsletter.unsubscribe-failed');
    }
}
