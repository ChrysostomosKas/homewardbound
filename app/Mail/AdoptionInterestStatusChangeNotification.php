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
        $pdfFileName = $this->adoptionInterest->adoption_certificate;
        $pdfPath = storage_path('app/public/' . $pdfFileName);

        if (!file_exists($pdfPath)) {
            return $this->markdown('emails.adoptionInterest-status-change-notification')
                ->from('no-reply@homewardbound.gr', 'Homewardbound Inc.')
                ->subject('Η κατάσταση του αίτησης σας άλλαξε');
        } else {
            $pdfContent = file_get_contents($pdfPath);
            return $this->markdown('emails.adoptionInterest-status-change-notification')
                ->from('no-reply@homewardbound.gr', 'Homewardbound Inc.')
                ->subject('Η κατάσταση του αίτησης σας άλλαξε')
                ->attachData($pdfContent, 'filename.pdf');
        }
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
