<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Shelter;

class OwnerShelterStatus extends Mailable
{
    use Queueable, SerializesModels;

    public $shelter;
    public $accepted;

    public function __construct(Shelter $shelter, bool $accepted)
    {
        $this->shelter = $shelter;
        $this->accepted = $accepted;
    }

    public function build()
    {
        $subject = $this->accepted ? 'Shelter Verification Approved' : 'Shelter Verification Declined';
        return $this->subject($subject)
                    ->view('emails.owner_shelter_status');
    }
}
