<?php

namespace App\Mail;

use App\Mail\AthleteRejected;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class AthleteRejected extends Mailable
{
    use Queueable, SerializesModels;

    public $details;

    public function __construct($details)
    {
        $this->details = $details;
    }

    public function build()
    {
        return $this->from('serinurul02@gmail.com')
                    ->view('mail.athletereject')
                    ->with('details', $this->details);
    }
}

