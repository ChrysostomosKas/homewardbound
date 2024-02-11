<?php

namespace App\Mail;

use App\Models\DoctorAppointment;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AppointmentReminderMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $appointment;
    protected $user;

    /**
     * Create a new message instance.
     */
    public function __construct(DoctorAppointment $appointment, User $user)
    {
        $this->appointment = $appointment;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return AppointmentReminderMail
     */
    public function build()
    {
        return $this->markdown('emails.appointment-reminder-mail')
            ->from('no-reply@homewardbound.gr', 'Homewardbound Inc.')
            ->subject('Appointment Reminder Mail')
            ->with(['appointment' => $this->appointment, 'user' => $this->user]);
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
