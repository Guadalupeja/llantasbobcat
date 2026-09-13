<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BobcatLeadMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public array $lead)
    {
        //
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Nuevo lead desde chat Ruguex Bobcat',
            replyTo: [
                new Address(
                    $this->lead['correo'],
                    $this->lead['nombre']
                ),
            ],
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.bobcat-lead',
            with: [
                'lead' => $this->lead,
            ],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}