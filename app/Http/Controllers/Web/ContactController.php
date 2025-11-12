<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactSubmissionRequest;
use App\Models\CoachingType;
use App\Models\ContactSubmission;
use App\Enums\ContactSubmissionStatus;
use App\Models\Profile;
use App\Notifications\ContactConfirmationMail;
use Illuminate\Support\Facades\Notification;

class ContactController extends Controller
{
    public function create()
    {
        session(['contact_form_loaded_at' => now()->timestamp]);
        $profile = Profile::first();
        $coachingTypes = CoachingType::orderBy('title')->get();

        return view('web.contact.create', compact('profile', 'coachingTypes'));
    }

    public function confirm()
    {
        $profile = Profile::first();
        return view('web.contact.confirm', compact('profile'));
    }

    public function store(ContactSubmissionRequest $request)
    {
        // Check rate limiting
//        if ($request->hasRecentSubmission()) {
//            return back()->with('error', 'Je hebt recent al een bericht gestuurd. Wacht even voordat je opnieuw probeert.');
//        }

        // Get validated data with metadata
        $data = $request->getValidatedDataForStorage();

        // Check for spam
        if ($request->isPotentialSpam()) {
            $data['status'] = ContactSubmissionStatus::Afgewezen;
        }

        // Save submission
        $submission = ContactSubmission::create($data);

        // Send notifications (alleen als niet afgewezen)
        if ($submission->status !== ContactSubmissionStatus::Afgewezen) {


            Notification::route('mail', $request->email)
                ->notify(new ContactConfirmationMail($submission));

            \Log::info('Contact submission received', [
                'submission_id' => $submission->id,
                'name' => $submission->name,
                'email' => $submission->email,
                'subject' => $submission->subject,
            ]);
        }

        return redirect()->route('web.contact.confirm');
    }
}
