<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactSubmissionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'min:2',
                'max:255',
                'regex:/^[a-zA-ZÀ-ÿ\s\-\'\.]+$/', // Alleen letters, spaties, koppeltekens, apostrofes en punten
            ],
            'email' => [
                'required',
                'email:rfc,dns',
                'max:255',
            ],
            'subject' => [
                'required',
                'string',
                'min:5',
                'max:255',
            ],
            'message' => [
                'required',
                'string',
                'min:10',
                'max:5000',
            ],
            // Honeypot field voor spam protectie
            'website' => [
                'nullable',
                'max:0', // Moet leeg blijven
            ],
            // Google reCAPTCHA (optioneel)
            'g-recaptcha-response' => [
                'nullable',
                // 'recaptcha', // Als je recaptcha package gebruikt
            ],
        ];
    }

    /**
     * Get custom error messages for validation rules.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Naam is verplicht.',
            'name.min' => 'Naam moet minimaal :min tekens bevatten.',
            'name.max' => 'Naam mag maximaal :max tekens bevatten.',
            'name.regex' => 'Naam mag alleen letters, spaties, koppeltekens en apostrofes bevatten.',

            'email.required' => 'E-mailadres is verplicht.',
            'email.email' => 'Voer een geldig e-mailadres in.',
            'email.max' => 'E-mailadres mag maximaal :max tekens bevatten.',

            'subject.required' => 'Onderwerp is verplicht.',
            'subject.min' => 'Onderwerp moet minimaal :min tekens bevatten.',
            'subject.max' => 'Onderwerp mag maximaal :max tekens bevatten.',

            'message.required' => 'Bericht is verplicht.',
            'message.min' => 'Bericht moet minimaal :min tekens bevatten.',
            'message.max' => 'Bericht mag maximaal :max tekens bevatten.',

            'website.max' => 'Dit veld moet leeg blijven.',
        ];
    }

    /**
     * Get custom attribute names for validation errors.
     */
    public function attributes(): array
    {
        return [
            'name' => 'naam',
            'email' => 'e-mailadres',
            'subject' => 'onderwerp',
            'message' => 'bericht',
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'name' => trim($this->name),
            'email' => strtolower(trim($this->email)),
            'subject' => trim($this->subject),
            'message' => trim($this->message),
        ]);
    }

    /**
     * Get validated data with additional fields for storage.
     */
    public function getValidatedDataForStorage(): array
    {
        $validated = $this->validated();

        // Verwijder honeypot en captcha velden
        unset($validated['website'], $validated['g-recaptcha-response']);

        // Voeg metadata toe
        $validated['ip_address'] = $this->ip();
        $validated['user_agent'] = $this->userAgent();
        $validated['status'] = \App\Enums\ContactSubmissionStatus::Nieuw;

        return $validated;
    }

    /**
     * Check if submission might be spam based on various factors.
     */
    public function isPotentialSpam(): bool
    {
        $spamIndicators = 0;

        // Check honeypot
        if (!empty($this->website)) {
            return true;
        }

        // Check for suspicious patterns
        $message = strtolower($this->message);
        $spamWords = [
            'viagra', 'casino', 'loan', 'credit', 'bitcoin', 'crypto',
            'seo services', 'make money', 'work from home', 'click here',
            'free money', 'get rich', 'guarantee', 'no risk'
        ];

        foreach ($spamWords as $word) {
            if (str_contains($message, $word)) {
                $spamIndicators++;
            }
        }

        // Check for excessive links
        $linkCount = substr_count($message, 'http');
        if ($linkCount > 2) {
            $spamIndicators += $linkCount;
        }

        // Check for repeated characters
        if (preg_match('/(.)\1{4,}/', $this->message)) {
            $spamIndicators++;
        }

        // Check for all caps
        if (strlen($this->message) > 20 && $this->message === strtoupper($this->message)) {
            $spamIndicators++;
        }

        // Check submission time (too fast might be bot)
        if (session()->has('contact_form_loaded_at')) {
            $timeSpent = now()->timestamp - session('contact_form_loaded_at');
            if ($timeSpent < 5) { // Less than 5 seconds
                $spamIndicators += 2;
            }
        }

        return $spamIndicators >= 3;
    }

    /**
     * Rate limiting key for this request.
     */
    public function getRateLimitKey(): string
    {
        return 'contact:' . $this->ip();
    }

    /**
     * Check if this IP has submitted recently.
     */
    public function hasRecentSubmission(): bool
    {
        return \App\Models\ContactSubmission::where('ip_address', $this->ip())
            ->where('created_at', '>', now()->subMinutes(5))
            ->exists();
    }
}
