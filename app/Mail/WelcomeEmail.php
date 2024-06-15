<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class WelcomeEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $mailmessage;
    public $name;
    public $username;
    public $useremail;
    public $municipality;
    /**
     * Create a new message instance.
     */
    public function __construct($message, $name, $username, $email, $municipality)
    {
        $this->mailmessage = $message;
        $this->name = $name;
        $this->username = $username;
        $this->useremail = $email;
        $this->municipality = $municipality;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Good day!Thanks for signing up to PDRRMO!',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'shared.welcome-email',
        );
    }

 
    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
