<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Manager;

class HomeController extends Controller
{
    public function index()
    {
        // Count the clients
        $clientsCount = Client::where('approved', true)->count();
    
        // Retrieve data from the database
        $clients = Client::where('approved', true)->get();
    
        $missionsByMonth = [];
      
    if ($clients && (is_array($clients) || is_object($clients))) {
        foreach ($clients as $client) {
            $completemissions = json_decode($client->missioncomplete, true);

            // Check if $completemissions is not null and is an array
            if ($completemissions && is_array($completemissions)) {
                foreach ($completemissions as $mission) {
                    $completedDate = date('Y-m', strtotime($mission['complete_at']));

                    $missionsByMonth[$completedDate] = ($missionsByMonth[$completedDate] ?? 0) + 1;
                }
            }
        }

        ksort($missionsByMonth);
        } else {
            $missionsByMonth = [];
        }
    
        $newClientsCount = Client::where('approved', true)->whereDate('created_at', '>=', now()->subDays(7))->count();
        $managersCount = Manager::count();
        $total = $clientsCount + $managersCount;
    
        $clientPercentage = ($clientsCount / $total) * 100;
        $managerPercentage = ($managersCount / $total) * 100;
    
        return view('dashboard', [
            'clientsCount' => $clientsCount,
            'managersCount' => $managersCount,
            'newClientsCount' => $newClientsCount,
            'clientPercentage' => $clientPercentage,
            'managerPercentage' => $managerPercentage,
            'missionsByMonth' => $missionsByMonth
        ]);
    }
}    