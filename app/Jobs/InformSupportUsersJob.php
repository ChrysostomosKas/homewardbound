<?php

namespace App\Jobs;

use App\Mail\InformSupportUserEmail;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class InformSupportUsersJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $contact_phone_number;
    /**
     * Create a new job instance.
     */
    public function __construct(string $contact_phone_number)
    {
        $this->contact_phone_number = $contact_phone_number;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $supportUsers = User::whereHas('roles', function ($query) {
            $query->where('id', 3);
        })->get();
dd('test');
        foreach ($supportUsers as $supportUser) {
            Mail::to($supportUser->email)->send(new InformSupportUserEmail($this->contact_phone_number));
        }
    }
}
