<?php

namespace App\Console;

use App\Mail\AppointmentReminderMail;
use App\Models\DoctorAppointment;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Mail;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->call(function () {
            $formatted_date = now()->format('Y-m-d');
            $appointments = DoctorAppointment::with('medicalRecord')->whereBetween('appointment_date', [$formatted_date . " 00:00:00", $formatted_date . " 23:59:59"])->get();

            foreach ($appointments as $appointment) {
                $user = $appointment->medicalRecord->pet->user;
                Mail::to($user->email)->send(new AppointmentReminderMail($appointment, $user));
            }
        })->dailyAt('05:00');
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
