<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AthleteScouted extends Mailable
{
    use Queueable, SerializesModels;

    public $event;
    public $athlete;

    /**
     * Create a new message instance.
     */
    public function __construct($event, $athlete)
    {
        $this->event = $event;
        $this->athlete = $athlete;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Athlete Scout Notification',
        );
    }

    // /**
    //  * Get the message content definition.
    //  */
    // public function content(): Content
    // {
    //     return new Content(
    //         view: 'emailscouted',
    //     );
    // }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }

    public function build()
    {
        return $this->subject('You Have Been Scouted!')
                    ->view('emailscouted')
                    ->with([
                        'event' => $this->event,
                        'athlete' => $this->athlete,
                    ]);
    }
}
