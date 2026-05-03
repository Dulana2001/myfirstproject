<?php

namespace App\Mail;

use App\Models\Advertisement;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AdApproved extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Advertisement $advertisement)
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Your Ad Has Been Approved!',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.ad-approved',
        );
    }
}