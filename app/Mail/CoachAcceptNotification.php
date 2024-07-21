<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CoachAcceptNotification extends Mailable
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
            subject: 'Coach Accept Notification',
        );
    }

    /**
     * Get the message content definition.
     */
    // public function content(): Content
    // {
    //     return new Content(
    //         view: 'view.name',
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
        return $this->subject('Athlete Accepted Your Event')
                    ->view('emailaccepted')
                    ->with([
                        'event' => $this->event,
                        'athlete' => $this->athlete,
                    ]);
    }

}
