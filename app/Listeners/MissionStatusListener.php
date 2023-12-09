<?php

namespace App\Listeners;

use App\Events\MissionUpdated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class MissionStatusListener
{
    public function handle(MissionUpdated $event)
    {
        // Update the status of the mission to 0
        $event->mission->update(['status' => 0]);
    }
}

