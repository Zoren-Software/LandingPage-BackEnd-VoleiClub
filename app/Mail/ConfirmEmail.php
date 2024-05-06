<?php

namespace App\Mail;

use App\Models\Lead;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\URL;

class ConfirmEmail extends Mailable
{
    use Queueable;
    use SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(
        public Lead $lead,
    ) {
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: trans('Leads.confirm_e-mail'),
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        $locale = app()->getLocale(); // Obter o idioma atual

        return new Content(
            markdown: 'emails.confirmEmail',
            with: [
                'url' => URL::temporarySignedRoute(
                    'leads.confirm-email',
                    now()->addMinutes(30),
                    [
                        'id' => $this->lead->id,
                        'locale' => $locale,
                    ]
                ),
            ],
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
