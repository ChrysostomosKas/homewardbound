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
        $pdfFileName = $this->adoptionInterest->adoption_certificate ?? null;
        if (!is_null($pdfFileName)) {
            $pdfPath = storage_path('app/public/' . $pdfFileName);
        }

        if (is_null($pdfFileName)) {
            return $this->markdown('emails.adoptionInterest-status-change-notification')
                ->from('no-reply@homewardbound.gr', 'Homewardbound Inc.')
                ->subject(__('Your request status has changed'));
        } else {
            $pdfContent = file_get_contents($pdfPath);
            return $this->markdown('emails.adoptionInterest-status-change-notification')
                ->from('no-reply@homewardbound.gr', 'Homewardbound Inc.')
                ->subject(__('Your request status has changed'))
                ->attachData($pdfContent, 'AdoptionCertificate.pdf');
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
