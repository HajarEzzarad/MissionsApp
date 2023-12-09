<?php

namespace App\Console\Commands;
use App\Models\Mission;

use Illuminate\Console\Command;

class UpdateMissionStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-mission-status';
    public function handle()
    {
        $missions = Mission::where('status', 1)->get();

        foreach ($missions as $mission) {
            if (now() > $mission->calculateTimeToStop()) {
                $mission->update(['status' => 0]);
            }
        }

        $this->info('Mission statuses updated successfully.');
    }
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    
}
