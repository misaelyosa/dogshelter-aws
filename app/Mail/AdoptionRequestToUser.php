<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Doge;

class AdoptionRequestToUser extends Mailable
{
    use Queueable, SerializesModels;

    public $doge;

    public function __construct(Doge $doge)
    {
        $this->doge = $doge;
    }

    public function build()
    {
        return $this->subject('Your Adoption Request Has Been Submitted')
                    ->view('emails.adoption_request_to_user');
    }
}
