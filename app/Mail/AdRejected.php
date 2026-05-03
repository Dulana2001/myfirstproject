<?php

namespace App\Mail;

use App\Models\Advertisement;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AdRejected extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Advertisement $advertisement)
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Your Ad Was Not Approved',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.ad-rejected',
        );
    }
}