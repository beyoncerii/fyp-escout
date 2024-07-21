<?php

namespace App\Mail;

use App\Models\Event;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class EventUpdatedNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $event;

    public function __construct(Event $event) // Corrected type hint
    {
        $this->event = $event;
    }

    public function build()
    {
        return $this->view('emaileventupdated')
            ->subject('Event Updated: ' . $this->event->name)
            ->with(['event' => $this->event]);
    }

}
