<?php

namespace App\Http\Controllers;

use App\Mail\AcceptingClient;
use Illuminate\Http\Request;
use Illuminate\Http\Request\UpdateUserRequest;
use App\Models\Client;
use App\Models\Mission;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use Laravel\Jetstream\Jetstream;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ClientsController extends Controller
{
    public function toPayement($userId)
    {
        $clients = Client::findOrFail($userId);
        $missioncomplete = json_decode($clients->missioncomplete, true) ?? [];
       

        // Filter missions with status 0
        $completedMissions = array_filter($missioncomplete, function ($mission) {
            return isset($mission['status']) && $mission['status'] == 0;
        });
    
        $missionsCount = count($completedMissions);
        $count = count($missioncomplete);
        $completedCount = collect($missioncomplete)->where('status', 1)->count();
        $totalMissions = count($missioncomplete);
    
        $completionPercentage = $totalMissions > 0 ? ($completedCount / $totalMissions) * 100 : 0;
    
   


          $dailyPayerData = [];

    foreach ($clients as $client) {
        if (is_object($clients)) {
            $clientPayments = json_decode($clients->payment, true) ?? [];

            $monthlyData = [];

            foreach ($clientPayments as $payment) {
                $paymentDate = Carbon::parse($payment['time_pay']);

                // Extract year and month from the payment date
                $yearMonth = $paymentDate->format('Y-m');

                // Add the payment amount to the monthly data for the corresponding year and month
                if (!isset($monthlyData[$yearMonth])) {
                    $monthlyData[$yearMonth] = 0;
                }

                $monthlyData[$yearMonth] += $payment['payer'];
            }

            $dailyPayerData[$clients->id] = $monthlyData;
        }
    }
        return view('users.payement', compact('dailyPayerData', 'count', 'clients', 'missionsCount', 'completionPercentage', 'completedCount'));
    }
    
    public function ajouterPayer(Request $request, $userId)
    {
        $client = Client::findOrFail($userId);
        $payerAmount = $request->input('payer');
    
        if ($payerAmount > $client->credit) {
            return redirect()->back()->with('error', 'Le montant payé est supérieur au crédit disponible.');
        }
 
        $client->credit -= $payerAmount;
    
        $paymentData = [
            'payer' => $payerAmount,
            'time_pay' => Carbon::now()->toDateString(), 
        ];
 
        $existingPayments = json_decode($client->payment, true) ?? [];
   
        $existingPayments[] = $paymentData;
        $client->payment = json_encode($existingPayments);

        $client->save();
    
        return redirect()->back()->with('message', 'Payer est ajouté avec succès.');
    }


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
     return redirect()->route('unapproved-clients')->with('message','Client Accepted');
    }
//complete missions for evrey client

public function toMissionsCompleted(Request $request, $userId)
{
    $client = Client::findOrFail($userId);
    $missioncomplete = json_decode($client->missioncomplete, true) ?? [];

    // Filter missions with status 0
    $completedMissions = array_filter($missioncomplete, function ($mission) {
        return isset($mission['status']) && $mission['status'] == 0;
    });

    $formattedDates = [];
    foreach ($completedMissions as $mission) {
        $completeAt = $mission['complete_at'];
        
        // Parse the date using Carbon
        $carbonDate = Carbon::parse($completeAt);
        
        // Format the date as per your requirement
        $formattedDates[] = $carbonDate->format('Y-m-d H:i:s');
    }

    $missionsCount = count($completedMissions);

    return view('users.MissionsCompleted', compact('client', 'completedMissions', 'missionsCount', 'formattedDates'));
}




public function validateMissionsCompleted($userId, $missionId)
{
    $client = Client::findOrFail($userId);

    $missioncomplete = json_decode($client->missioncomplete, true) ?? [];
    foreach ($missioncomplete as &$mission) {
        if ($mission['id'] == $missionId) {
            $mission['status'] = 1;
            break;
        }
    }

    $client->missioncomplete = json_encode($missioncomplete);

    $mission = Mission::findOrFail($missionId);
    $client->badge += $mission->prix;
    $client->credit += $mission->prix;
    $client->save();

    return redirect()->back();
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
            $client->cin_recto_path = $filename;
        }
    
        // Handle file uploads for cin_verso
        if ($request->hasFile('cin_verso')) {
            $image = $request->file('cin_verso');
            $filename = time() . '_' . $image->getClientOriginalName();
            $image->storeAs('public/cin_images', $filename); // You may customize the storage path
            $client->cin_verso_path = $filename;
        }
    
        // Update other fields as needed
    
        $client->save();
    
        return response()->json(['message' => 'Client updated successfully']);
    }
    public function getClients()
    {
        $users = Client::all();
        

        return response()->json($users);
    }


    public function updateMissionComplete(Request $request, $clientId)
    {
        $client = Client::find($clientId);
    
        if (!$client) {
            return response()->json(['error' => 'Client not found'], 404);
        }
    
        $completedMissions = $request->input('missions');
        $existingMissions = json_decode($client->missioncomplete, true) ?? [];
        $existingMissions[] = $completedMissions;
    
        $client->missioncomplete = json_encode($existingMissions);
    
        $client->save();
    
        // Retrieve the updated client with the latest changes
        $updatedClient = Client::find($clientId);
    
        return response()->json(['message' => 'Mission complete information updated successfully', 'client' => $updatedClient]);
    }
    
     
    public function updateMissionStatus(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'clientId' => 'required|exists:clients,id',
            'missionId' => 'required',
            'missionPrice'=>'required'
        ]);

        // Find the client
        $client = Client::findOrFail($request->clientId);

        // Get the current missioncomplete array
        $missioncomplete = json_decode($client->missioncomplete, true) ?? [];

        // Iterate through missioncomplete
        foreach ($missioncomplete as &$mission) {
            if ($mission['id'] == $request->missionId) {
                // Update the status of the specified mission
                $mission['status'] = 1;
                break; // Stop iterating once the mission is found and updated
            }
        }

        // Update the missioncomplete array in the client model
        $client->missioncomplete = json_encode($missioncomplete);
        $client->badge+=$request->missionPrice;
        // Save the changes
        $client->save();

        // You can return a response here if needed
        return response()->json(['message' => 'Mission status updated successfully']);
    }
   

    
    
    

}

