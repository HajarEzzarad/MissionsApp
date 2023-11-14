<?php

namespace App\Http\Controllers;

use App\Models\Manager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Laravel\Jetstream\Jetstream;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Str;

class ManagersController extends Controller
{
    public function index()
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
        $password = Str::random(6);
      
        $managers= Manager::create($request->all());
        //upload CIN scané
        $request->validate(['CIN_path'=>'required|image|mimes:jpeg,png,jpg|max:2048',]);
        if($request->hasFile('CIN_path')){
            $photoPath= $request->file('CIN_path')->store('CIN_PHOTOS','public');
        }

        //hash the genrerated password before storing it in the db;
        $managers->password= Hash::make($password);
        $managers->save();
        
        return redirect()->route('managers.index');
    }

    public function show($id)
    {
        $managers= Manager::findOrFail($id);
        return view('managers.show', compact('managers'));
    }
    public function edit($id)
    {
        $managers= Manager::findOrFail($id);
        return view('managers.edit', compact('managers'));
    }
    public function update(Request $request, $id)
    {
        $managers= Manager::findOrFail($id);
        $managers->update($request->all());
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
    $user = Manager::where('email', $request->email)->first();

    if ($user && $request->password === $user->password) {
        // Authentication successful
        return response()->json([
            'user' => $user,
        ], 200);
    } else {
        return response()->json(['message' => 'Unauthorized'], 401);
    }
}

}
