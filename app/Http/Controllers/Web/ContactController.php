<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactSubmissionRequest;
use App\Models\CoachingType;
use App\Models\ContactSubmission;
use App\Enums\ContactSubmissionStatus;
use App\Models\Profile;
use App\Models\User;
use App\Notifications\ContactConfirmationMail;
use App\Notifications\NewContactSubmission;
use Illuminate\Support\Facades\Notification;

class ContactController extends Controller
{
    public function create()
    {
        session(['contact_form_loaded_at' => now()->timestamp]);

        // Generate simple human check
        $a = rand(1, 9);
        $b = rand(1, 9);

        session([
            'contact_sum_a' => $a,
            'contact_sum_b' => $b,
            'contact_sum_result' => $a + $b,
        ]);

        $profile = Profile::first();
        $coachingTypes = CoachingType::orderBy('title')->get();

        return view('web.contact.create', compact('profile', 'coachingTypes', 'a', 'b'));
    }

    public function confirm()
    {
        $profile = Profile::first();
        return view('web.contact.confirm', compact('profile'));
    }

    public function store(ContactSubmissionRequest $request)
    {
        // Validate human check
        $correct = session('contact_sum_result');
        if ($request->input('human_check') != $correct) {
            return back()
                ->withInput()
                ->withErrors(['human_check' => 'De som is niet correct. Probeer het opnieuw.']);
        }

        // Get validated data with metadata
        $data = $request->getValidatedDataForStorage();

        // Check for spam
        if ($request->isPotentialSpam()) {
            return redirect()->back();
        }

        // Save submission
        $submission = ContactSubmission::create($data);

        // Send notifications
        if ($submission->status !== ContactSubmissionStatus::Afgewezen) {

            Notification::route('mail', $request->email)
                ->notify(new ContactConfirmationMail($submission));

            $users = User::where('is_admin', true)->get();

            foreach ($users as $user) {
                $user->notify(new NewContactSubmission($submission));
            }
        }

        return redirect()->route('web.contact.confirm');
    }

}
