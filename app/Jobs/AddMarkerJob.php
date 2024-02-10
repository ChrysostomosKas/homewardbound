<?php

namespace App\Jobs;

use App\Models\MapMarker;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class AddMarkerJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $requestData;
    /**
     * Create a new job instance.
     */
    public function __construct(array $requestData)
    {
        $this->requestData = $requestData;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $mapMarker = new MapMarker();
        $mapMarker->contact_phone_number = $this->requestData['contact_phone_number'];
        $mapMarker->lat = $this->requestData['lat'];
        $mapMarker->lng = $this->requestData['lng'];

        if (isset($this->requestData['image'])) {
            $mapMarker->image = $this->requestData['image'];
        }
        $mapMarker->save();
    }
}
