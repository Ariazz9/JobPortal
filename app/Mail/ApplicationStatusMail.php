<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ApplicationStatusMail extends Mailable
{
    use Queueable, SerializesModels;

    public $application;
    public $status;

    public function __construct($application, $status)
    {
        $this->application = $application;
        $this->status = $status;
    }

    public function envelope(): Envelope
    {
        if ($this->status == 'Accepted') {
            $subject = 'Selamat! Lamaran Anda Diterima';
        } else {
            $subject = 'Update Lamaran Kerja Anda';
        }

        return new Envelope(
            subject: $subject,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.application_status',
        );
    }
}