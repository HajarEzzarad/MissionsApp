<?php

namespace App\Events;

use App\Models\Mission;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MissionUpdated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $mission;

    public function __construct(Mission $mission)
    {
        $this->mission = $mission;
    }

    public function handle()
    {
        // Check if the duration has ended
        if ($this->mission->calculateTimeToStop()->isPast()) {
            // Update the mission status to 0
            $this->mission->update(['status' => 0]);
        }
    }
}

