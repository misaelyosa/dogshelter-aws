<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Doge;

class AdoptionResultToUser extends Mailable
{
    use Queueable, SerializesModels;

    public $doge;
    public $accepted;

    public function __construct(Doge $doge, bool $accepted)
    {
        $this->doge = $doge;
        $this->accepted = $accepted;
    }

    public function build()
    {
        $subject = $this->accepted ? 'Your Adoption Request Was Accepted' : 'Your Adoption Request Was Declined';
        return $this->subject($subject)
                    ->view('emails.adoption_result_to_user');
    }
}
