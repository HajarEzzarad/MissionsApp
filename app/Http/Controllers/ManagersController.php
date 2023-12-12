<?php

namespace App\Http\Controllers;

use App\Models\Manager;
use App\Models\User;

use App\Models\Client;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Laravel\Jetstream\Jetstream;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Str;
use App\Mail\CreateManager;
use Illuminate\Support\Facades\Mail;

class ManagersController extends Controller
{
    
    public function index(Request $request)
    {
       
        $managers = Manager::all();
        return view('managers.index', compact('managers'));
    }

    public function create()
    {
        return view('managers.create');
    }

    public function store(Request $request)
    {
         //generate a random password
         $passwordGenerate = Str::random(6);
         
        //upload CIN scané
        $request->validate(['CIN_recto_path'=>'required|image|mimes:jpeg,png,jpg|max:2048',]);
        $request->validate(['CIN_verso_path'=>'required|image|mimes:jpeg,png,jpg|max:2048',]);

        //create manager
        $managers=new Manager;
            $managers->password = $passwordGenerate;
             $managers->nom =$request->input('nom');
             $managers->prenom = $request->input('prenom');
             $managers->phone =$request->input('phone');
             $managers->email = $request->input('email');
             $managers->pays = $request->input('pays');
             $managers->ville = $request->input('ville');
             $managers->RIB = $request->input('RIB');
             $managers->NomBanque = $request->input('NomBanque');

        if($request->hasFile('CIN_recto_path')){
             $name= $request->file('CIN_recto_path')->getClientOriginalName();
            $request->file('CIN_recto_path')->storeAs('public/CIN_photo', $name);
            $managers->CIN_recto_path= $name;
        }
        
        if($request->hasFile('CIN_verso_path')){
            $name= $request->file('CIN_verso_path')->getClientOriginalName();
            $request->file('CIN_verso_path')->storeAs('public/CIN_photo', $name);
            $managers->CIN_verso_path= $name;
        }
        $managers->save();
        Mail::to($managers->email)->send(new CreateManager($managers,$passwordGenerate));
        
        return redirect()->route('managers.index');
    }

    public function show($id)
    {
        $managers= Manager::findOrFail($id);
        $categoriesCount = Manager::with('category')->find($managers->id);
        $categoriesCount = $managers->category->count();
        
        return view('managers.show', compact('managers', 'categoriesCount'));
    }
    public function edit($id)
    {
        $managers= Manager::findOrFail($id);
        return view('managers.edit', compact('managers'));
    }
    public function update(Request $request, $id)
    {
        $managers= Manager::findOrFail($id);
        $managers->nom =$request->input('nom');
        $managers->prenom = $request->input('prenom');
        $managers->phone =$request->input('phone');
        $managers->email = $request->input('email');
        $managers->pays = $request->input('pays');
        $managers->ville = $request->input('ville');
        $managers->RIB = $request->input('RIB');
        $managers->NomBanque = $request->input('NomBanque');
        if($request->hasFile('CIN_recto_path')){
            $name= $request->file('CIN_recto_path')->getClientOriginalName();
            $request->file('CIN_recto_path')->storeAs('public/CIN_photo', $name);
            $managers->CIN_recto_path= $name;
           }
           
           if($request->hasFile('CIN_verso_path')){
               $name= $request->file('CIN_verso_path')->getClientOriginalName();
               $request->file('CIN_verso_path')->storeAs('public/CIN_photo', $name);
               $managers->CIN_verso_path= $name;
           }
        $managers->save();
        return redirect()->route('managers.index');
    }

    public function destroy($id)
    { 
        $managers= Manager::findOrFail($id);
        $managers->delete();
        return redirect()->route('managers.index');
    }
    



    public function login(Request $request)
{
    // Check in Manager table
    $manager = Manager::where('email', $request->email)->first();

    if ($manager && $request->password === $manager->password) {
        // Authentication successful for Manager
        return response()->json([
            'user' => $manager,
            'role' => 'Manager',
        ], 200);
    }

    // If not found in Manager table, check in User table
    $user = User::where('email', $request->email)->first();

    if ($user && $request->password === $user->password) {
        // Authentication successful for User
        return response()->json([
            'user' => $user,
            'role' => 'Admin',
        ], 200);
    }

    // If not found in either table, return Unauthorized
    return response()->json(['message' => 'Unauthorized'], 401);
}

public function getManagers()
{
    $users = Manager::all();

    return response()->json($users);
}

public function getUserDetails(Request $request)
{
    $userId = $request->input('userId');
    $role = $request->input('role');

    // Determine the table based on the role
    $table = $role === 'Client' ? 'Client' : 'Manager';

    // Use the selected table to fetch user details
    $user = $table === 'Client'
        ? Client::where('id', $userId)->first()
        : Manager::where('id', $userId)->first();

    if ($user) {
    return response()->json([
        'id' => $user->id,
        'name' => $user->nom,
        'prenom' => $user->prenom,
        'profile' => $user->profile_photo_path,
         'role'=>$role
        // Add any other fields you need
    ]);
} else {
    return response()->json(['error' => 'User not found'], 404);
}

}
public function getManagerDetails($id)
{
   

    // Use the selected table to fetch user details
    $user=Manager::where('id', $id)->first();

    if ($user) {
    return response()->json([
      'Manager'  =>$user
        // Add any other fields you need
    ]);
} else {
    return response()->json(['error' => 'User not found'], 404);
}

}

}
