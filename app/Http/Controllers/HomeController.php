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

         // Process and aggregate the data
         $missionsByDay = [];
 
         foreach ($clients as $client) {
             $completemissions = json_decode($client->missioncomplete, true);
 
             foreach ($completemissions as $mission) {
                 $completedDate = date('Y-m-d', strtotime($mission['complete_at']));
 
                 if (!isset($missionsByDay[$completedDate])) {
                     $missionsByDay[$completedDate] = 1;
                 } else {
                     $missionsByDay[$completedDate]++;
                 }
             }
            }
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
        'missionsByDay'=> $missionsByDay]);
    }
}