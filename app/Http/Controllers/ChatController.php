<?php

namespace App\Http\Controllers;

use App\Models\Manager;
use App\Models\Client;

class ChatController extends Controller
{
public function index()
    {
        $managers = Manager::all();
        $clients = Client::all();

        $managers->each->setAttribute('type', 'manager');
        $clients->each->setAttribute('type', 'client');

        return view('chats.index', ['managers' => $managers, 'clients' => $clients]);
    }

    public function getChattedUsers()
{
    $chattedUsers = [];

    // Fetch the managers
    $managers = Manager::all();
    foreach ($managers as $manager) {
            $chattedUsers[] = [
                'id' => $manager->id,
                'name' => $manager->nom . ' ' . $manager->prenom,
                'role' => 'manager',
            ];

    }

    // Fetch the clients
    $clients = Client::all();
    foreach ($clients as $client) {
            $chattedUsers[] = [
                'id' => $client->id,
                'name' => $client->nom . ' ' . $client->prenom,
                'role' => 'client',
            ];
       
    }

    return response()->json(['chattedUsers' => $chattedUsers]);
}


}
