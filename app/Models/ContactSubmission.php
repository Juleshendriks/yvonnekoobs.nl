<?php

namespace App\Models;

use App\Enums\ContactSubmissionStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;

class ContactSubmission extends Model
{
    protected $fillable = [
        'name',
        'email',
        'subject',
        'message',
        'ip_address',
        'user_agent',
        'status',
    ];

    protected $casts = [
        'status' => ContactSubmissionStatus::class,
    ];
}

