<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Manager;

class HomeController extends Controller
{
    public function index(){
        // Count the clients
        $ClientsCount = Client::where('approved',true)->count();
         // Retrieve data from the database
         $clients = Client::where('approved', true)->get();

         $missionsByMonth = [];

foreach ($clients as $client) {
    $completemissions = json_decode($client->missioncomplete, true);

    foreach ($completemissions as $mission) {
        $completedDate = date('Y-m', strtotime($mission['complete_at']));

        if (!isset($missionsByMonth[$completedDate])) {
            $missionsByMonth[$completedDate] = 1;
        } else {
            $missionsByMonth[$completedDate]++;
        }
    }
}

ksort($missionsByMonth);

        //count the new clients
        $newClientsCount = Client::where('approved',true)->whereDate('created_at', '>=', now()->subDays(7))->count();
        //count the managers
        $ManagersCount = Manager::count();
        //count the persontage of users and managers
        if($ClientsCount == 0 and $ManagersCount == 0)
        {
            $total = 1;
        }else{
            $total = $ClientsCount + $ManagersCount;
        }
        
        $clientPersontage = ($ClientsCount / $total) * 100;
        $managerPersontage = ($ManagersCount / $total) * 100;
        return view('dashboard', ['ClientsCount' => $ClientsCount, 
        'ManagersCount' => $ManagersCount,
         'newClientsCount' => $newClientsCount,
         'clientPersontage' => $clientPersontage,
         'managerPersontage' => $managerPersontage,
        'missionsByMonth'=> $missionsByMonth]);
    }
}