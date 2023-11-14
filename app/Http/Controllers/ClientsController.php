<?php

namespace App\Http\Controllers;

use App\Mail\AcceptingClient;
use Illuminate\Http\Request;
use Illuminate\Http\Request\UpdateUserRequest;
use App\Models\Client;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

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
        $clients->password= $passwordGenerate;
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
    public function createClient(Request $request)
    {
        $request->validate([
            'nom' => 'required|string',
            'prenom' => 'required|string',
            'email' => 'required|email|unique:clients',
            'phone' => 'required|string',
            'pays' => 'required|string',
            'ville' => 'required|string',
            
        ]);
        $request->merge(['password' => bcrypt($request->password)]);

        // $client = Client::create($request->all());
        $client = Client::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'phone' => $request->phone,
            'pays' => $request->pays,
            'ville'=>$request->ville,
            'password'=>bcrypt('rim123')
        ]);

        return response()->json(['message' => 'Client created successfully', 'client' => $client], 201);
    }
    public function login(Request $request)
    {
    $credentials = [
        'email' => $request->email,
    ];
    $user = Client::where('email', $request->email)->first();

    if ($user && Hash::check($request->password, $user->password)) {
    // Authentication successful
    return response()->json([
        
        'user' => $user,
    ], 200);
    }

     else {
        return response()->json(['message' => 'Unauthorized'], 401);
    }
    }
    public function updateClient(Request $request, $id)
    {
        $client = Client::find($id);
    
        if (!$client) {
            return response()->json(['error' => 'Client not found'], 404);
        }
    
        $client->RIB = $request->input('RIB');
        $client->NomBanque = $request->input('NomBanque');
    
        // Handle file uploads for cin_recto
        if ($request->hasFile('cin_recto')) {
            $image = $request->file('cin_recto');
            $filename = time() . '_' . $image->getClientOriginalName();
            $image->storeAs('public/cin_images', $filename); // You may customize the storage path
            $client->cin_recto = $filename;
        }
    
        // Handle file uploads for cin_verso
        if ($request->hasFile('cin_verso')) {
            $image = $request->file('cin_verso');
            $filename = time() . '_' . $image->getClientOriginalName();
            $image->storeAs('public/cin_images', $filename); // You may customize the storage path
            $client->cin_verso = $filename;
        }
    
        // Update other fields as needed
    
        $client->save();
    
        return response()->json(['message' => 'Client updated successfully']);
    }
    

    
    
    

}

