<?php

namespace App\Http\Controllers;

use App\Mail\AcceptingClient;
use Illuminate\Http\Request;
use Illuminate\Http\Request\UpdateUserRequest;
use App\Models\Client;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Laravel\Jetstream\Jetstream;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Str;
use App\Mail\CreateManager;
use Illuminate\Support\Facades\Mail;

class ClientsController extends Controller
{
    public function index()
    {
        //count the client that unprroved
        $unapprovedClientsCount = Client::where('approved',false)->count();
        //get the clients who approved by Admin
        $approvedClients = Client::where('approved',true)->get();
        return view('users.index', compact('approvedClients'), ['unapprovedClientsCount'=> $unapprovedClientsCount]);
    }
    public function show($id)
    {
        $user= Client::findOrFail($id);
        return view('users.show', compact('user'));
    }
    public function ShowUnapprovedClients()
    {
        //get the client that unapproved
        $unapprovedClients = Client::where('approved',false)->get();
        return view('users.ClientsPending', ['unapprovedClients' => $unapprovedClients]);
    }
    public function acceptClient($id)
    {
        //generate a random password
         $passwordGenerate = Str::random(6);
        $clients = Client::find($id);
        $clients->approved = true;
        $clients->save();
        Mail::to($clients->email)->send(new AcceptingClient($clients,$passwordGenerate));
        return redirect()->route('unapproved-clients')->with('message','Client Accepted');
    }

    public function edit($id)
    {
        $user= Client::findOrFail($id);
        return view('users.edit', compact('user'));
    }
    public function update(Request $request, $id)
    {  
        $user= Client::findOrFail($id);
        $user->update($request->all());
    $user->save();
    return redirect()->route('users.index');
    }

    public function destroy($id)
    { 
        $user= Client::findOrFail($id);
        $user->delete();
        return redirect()->route('users.index');
    }
}

