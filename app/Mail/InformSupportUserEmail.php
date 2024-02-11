<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class InformSupportUserEmail extends Mailable
{
    use Queueable, SerializesModels;

    protected $contact_phone_number;

    /**
     * Create a new message instance.
     */
    public function __construct(string $contact_phone_number)
    {
       $this->contact_phone_number = $contact_phone_number;
    }


    /**
     * Build the message.
     *
     * @return
     */
    public function build()
    {
        return $this->markdown('emails.inform-support-user-email')
            ->from('no-reply@homewardbound.gr', 'Homewardbound Inc.')
            ->subject('New Pet Report: Urgent Assistance Needed')
            ->with('contact_phone_number', $this->contact_phone_number);
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
