<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Shelter;

class AdminNewShelterRequest extends Mailable
{
    use Queueable, SerializesModels;

    public $shelter;

    public function __construct(Shelter $shelter)
    {
        $this->shelter = $shelter;
    }

    public function build()
    {
        return $this->subject('New Shelter Verification Request')
                    ->view('emails.admin_new_shelter_request');
    }
}
