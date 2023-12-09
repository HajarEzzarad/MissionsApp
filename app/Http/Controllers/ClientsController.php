<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use App\Mail\AcceptingClient;
use Illuminate\Http\Request;
use Illuminate\Http\Request\UpdateUserRequest;
use App\Models\Client;
use App\Models\Mission;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

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

        // $client = Client::create($request->all());
        $client = Client::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'phone' => $request->phone,
            'pays' => $request->pays,
            'ville'=>$request->ville,
            "password" => Hash::make($request->input('password')),
        ]);

        return response()->json(['message' => 'Client created successfully', 'client' => $client], 201);
    }
   
    public function login(Request $request)
{
    $credentials = [
        'email' => $request->email,
    ];

    $user = Client::where('email', $request->email)->first();
   
    if ($user) {
        // Check if the user is approved
        if ($user->approved) {
            // Check if the password is correct
            if (Hash::check($request->password, $user->password)) {
                // Authentication successful
                
                return response()->json([
                    'user' => $user,
                ], 200);
            } else {
                // Incorrect password
                return response()->json(['message' => 'Incorrect password',$user->password,Hash::make($request->password)], 401);
            }
        } else {
            // User is not approved
            return response()->json(['message' => 'User not approved'], 401);
        }
    } else {
        // User not found
        return response()->json(['message' => 'User not found'], 401);
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
        $client->credit+=$request->missionPrice;
        // Save the changes
        $client->save();

        // You can return a response here if needed
        return response()->json(['message' => 'Mission status updated successfully']);
    }
    
    public function getClientsByMission($missionId)
    {
        // Modified query to use the LIKE operator with wildcards
        $clients = Client::where('missioncomplete', 'like', '%"id":%' . $missionId . '%')->get();
    
        // Extract the complete_at property from the missioncomplete JSON for the specific mission ID
        $clientsWithCompleteAt = $clients->map(function ($client) use ($missionId) {
            $missionCompleteData = json_decode($client->missioncomplete, true);
    
            // Check if the missioncomplete field is valid JSON and contains the complete_at key
            if ($missionCompleteData && is_array($missionCompleteData)) {
                // Search for the specific mission ID in the missioncomplete array
                foreach ($missionCompleteData as $missionData) {
                    if (isset($missionData['id']) && $missionData['id'] == $missionId) {
                        // Match found, set the complete_at property
                        $client->complete_at = $missionData['complete_at'];
                        return $client; // Exit the loop once a match is found
                    }
                }
            }
    
            // Handle the case where the key is not present, JSON is invalid, or no match found
            $client->complete_at = null;
            return $client;
        });
    
        return response()->json(['clients' => $clientsWithCompleteAt]);
    }
    public function AddPayer(Request $request, $Id)
    {
        $client = Client::find($Id);
    
        if (!$client) {
            return response()->json(['error' => 'Client not found'], 404);
        }
    
        // Ensure payer and credit are treated as decimals
        $payerToAdd = (float)$request->input('payer');
        $client->payer = bcadd($client->payer, $payerToAdd, 2); // bcadd for precise decimal arithmetic
        $client->credit = bcsub($client->credit, $payerToAdd, 2);
    
        // Save changes to the database
        $client->save();
    
        return response()->json(['message' => 'Ajouter avec succès'], 200);
    }
    
    
    public function getClientInfo($Id){
        $client = Client::find($Id);
    
        if (!$client) {
            return response()->json(['error' => 'Client not found'], 404);
        }
        return response()->json(['client' => $client]);

    }
     

    public function updateClientInfo(Request $request, $id)
    {
        \Log::info('Received request data:', ['data' => $request->all()]);

        $client = Client::find($id);
        if (!$client) {
            return response()->json(['error' => 'Client not found'], 404);
        }
    
        try {
            // Update client fields
            
            $client->email = $request->email;
            $client->nom = $request->nom;
            $client->prenom = $request->prenom;
            $client->phone = $request->phone;
            $client->pays = $request->pays;
            $client->ville = $request->ville;
            $client->RIB = $request->RIB;
            $client->NomBanque = $request->NomBanque;
          
            if ($request->hasFile('profile_photo_path')) {
                $image = $request->file('profile_photo_path');
            
                // Use the putFile method to store the file
                $filename = time() . '_' . $image->getClientOriginalName();
                $image->move(storage_path('app/public/profile_photo_path'), $filename);
            
                // Log the uploaded filename and path
            
                // Update the client's profile_photo_path with the filename
                $client->profile_photo_path = $filename;
            }
    
           
            // Update other fields as needed
            $client->save();
    
            return response()->json(['message' => 'Client updated successfully']);
        } catch (\Exception $e) {
            // Log the error for further investigation
            \Log::error('Error updating client: ' . $e->getMessage());
    
            // Return a generic error response
            return response()->json(['error' => 'An error occurred while updating the client.'], 500);
        }
    }
    
    public function getUserMissionStatistics($userId)
    {
        try {
            // Fetch user's completed missions JSON column
            $user = Client::findOrFail($userId);
    
            // Check if the completemission column exists and is not empty
            if (!isset($user->missioncomplete) || empty($user->missioncomplete)) {
                return response()->json(['error' => 'No completed missions for this user.']);
            }
    
            // Decode the JSON data
            $completedMissions = json_decode($user->missioncomplete, true);
    
            // Check if decoding was successful
            if (json_last_error() != JSON_ERROR_NONE) {
                return response()->json(['error' => 'Error decoding mission data.']);
            }
    
            // Ensure that the decoded data is an array
            if (!is_array($completedMissions)) {
                return response()->json(['error' => 'Invalid mission data format.']);
            }
    
            // Calculate mission completion statistics by week, month, and year
            $missionStatistics = [
                'week' => [],
                'month' => [],
                'year' => [],
            ];
    
            foreach ($completedMissions as $mission) {
                if (isset($mission['complete_at']) && is_string($mission['complete_at'])) {
                    $completeDate = \Carbon\Carbon::parse($mission['complete_at']);
    
                    $weekKey =   $completeDate->isoWeek() . '-' . $completeDate->year;
                    $monthKey = $completeDate->monthName . '-' . $completeDate->year;
                    $yearKey = (string) $completeDate->year;
    
                    // Increment the mission count for the corresponding week, month, and year
                    $missionStatistics['week'][$weekKey]['mission_count'] = isset($missionStatistics['week'][$weekKey]['mission_count']) ?
                        $missionStatistics['week'][$weekKey]['mission_count'] + 1 : 1;
    
                    $missionStatistics['month'][$monthKey]['mission_count'] = isset($missionStatistics['month'][$monthKey]['mission_count']) ?
                        $missionStatistics['month'][$monthKey]['mission_count'] + 1 : 1;
    
                    $missionStatistics['year'][$yearKey]['mission_count'] = isset($missionStatistics['year'][$yearKey]['mission_count']) ?
                        $missionStatistics['year'][$yearKey]['mission_count'] + 1 : 1;
                }
            }
    
            return response()->json($missionStatistics);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }
    
//     public function getClientPayerStatistics($clientId)
// {
//     // Cumulative amount added to payer per day
//     $dailyStatistics = DB::table('clients')
//         ->select(
//             DB::raw('DATE(created_at) as date'),
//             DB::raw('SUM(payer) as cumulative_payer_amount')
//         )
//         ->where('id', $clientId)
//         ->groupBy('date')
//         ->orderBy('date', 'asc')
//         ->get();

//     // Cumulative amount added to payer per week
//     $weeklyStatistics = DB::table('clients')
//         ->select(
//             DB::raw('WEEK(created_at) as week_number'),
//             DB::raw('SUM(payer) as cumulative_payer_amount')
//         )
//         ->where('id', $clientId)
//         ->groupBy('week_number')
//         ->orderBy('week_number', 'asc')
//         ->get();

//     // Cumulative amount added to payer per month
//     $monthlyStatistics = DB::table('clients')
//         ->select(
//             DB::raw('YEAR(created_at) as year_number'),
//             DB::raw('MONTH(created_at) as month_number'),
//             DB::raw('SUM(payer) as cumulative_payer_amount')
//         )
//         ->where('id', $clientId)
//         ->groupBy('year_number', 'month_number')
//         ->orderBy('year_number', 'asc')
//         ->orderBy('month_number', 'asc')
//         ->get();

//     // Cumulative amount added to payer per year
//     $yearlyStatistics = DB::table('clients')
//         ->select(
//             DB::raw('YEAR(created_at) as year_number'),
//             DB::raw('SUM(payer) as cumulative_payer_amount')
//         )
//         ->where('id', $clientId)
//         ->groupBy('year_number')
//         ->orderBy('year_number', 'asc')
//         ->get();

//     return response()->json([
//         'daily' => $dailyStatistics,
//         'weekly' => $weeklyStatistics,
//         'monthly' => $monthlyStatistics,
//         'yearly' => $yearlyStatistics,
//     ]);
// }

public function getStatisticsPayer($id)
{
    $client = Client::find($id);

    if (!$client) {
        return response()->json(['error' => 'Client not found'], 404);
    }

    $statistics = [
        'daily'   => $this->getWinsByPeriod($client, 'day'),
        'weekly'  => $this->getWinsByPeriod($client, 'week'),
        'monthly' => $this->getWinsByPeriod($client, 'month'),
        'yearly'  => $this->getWinsByPeriod($client, 'year'),
    ];

    return response()->json(['statistics' => $statistics]);
}

private function getWinsByPeriod($client, $period)
{
    $now = Carbon::now();

    switch ($period) {
        case 'day':
            return $client->whereDate('created_at', $now->toDateString())->sum('payer');
        case 'week':
            return $client->whereBetween('created_at', [$now->startOfWeek(), $now->endOfWeek()])->sum('payer');
        case 'month':
            return $client->whereYear('created_at', $now->year)
                          ->whereMonth('created_at', $now->month)
                          ->sum('payer');
        case 'year':
            return $client->whereYear('created_at', $now->year)->sum('payer');
        default:
            return 0;
    }
}




}

