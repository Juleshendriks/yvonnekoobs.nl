<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class NewsletterSubscriber extends Model
{
    use Notifiable;


    protected $fillable = ['name', 'email', 'active'];

    public function routeNotificationForMail()
    {
        return $this->email; // or return the correct email field
    }

}
