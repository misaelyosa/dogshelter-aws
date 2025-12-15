<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Doge;

class NewDogeAdded extends Mailable
{
    use Queueable, SerializesModels;

    public $doge;

    public function __construct(Doge $doge)
    {
        $this->doge = $doge;
    }

    public function build()
    {
        return $this->subject('A New Dog Has Been Added')
                    ->view('emails.new_doge_added');
    }
}
