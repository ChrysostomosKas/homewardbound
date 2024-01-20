<?php

namespace App\Mail;

use App\Models\AdoptionInterest;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AdoptionInterestStatusChangeNotification extends Mailable
{
    use Queueable, SerializesModels;

    public AdoptionInterest $adoptionInterest;
    /**
     * Create a new message instance.
     */
    public function __construct(AdoptionInterest $adoptionInterest)
    {
        $this->adoptionInterest = $adoptionInterest;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.adoptionInterest-status-change-notification')
            ->from('no-reply@homewardbound.gr', 'Homewardbound Inc.')
            ->subject('Η κατάσταση του αίτησης σας άλλαξε');
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
