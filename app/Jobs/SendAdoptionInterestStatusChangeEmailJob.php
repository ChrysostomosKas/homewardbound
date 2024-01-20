<?php

namespace App\Jobs;

use App\Mail\AdoptionInterestStatusChangeNotification;
use App\Models\AdoptionInterest;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendAdoptionInterestStatusChangeEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $user;
    protected AdoptionInterest $adoptionInterest;
    /**
     * Create a new job instance.
     */
    public function __construct($user, AdoptionInterest $adoptionInterest)
    {
        $this->user = $user;
        $this->adoptionInterest = $adoptionInterest;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->user->email)->send(new AdoptionInterestStatusChangeNotification($this->adoptionInterest));
    }
}
