<?php

namespace App\Http\Controllers;

use App\Models\Manager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Laravel\Jetstream\Jetstream;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Str;
use App\Mail\CreateManager;
use Illuminate\Support\Facades\Mail;

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
         $passwordGenerate = Str::random(6);
         
        //upload CIN scané
        $request->validate(['CIN_recto_path'=>'required|image|mimes:jpeg,png,jpg|max:2048',]);
        if($request->hasFile('CIN_recto_path')){
            $photoRECTO= $request->file('CIN_recto_path')->store('CIN_PHOTOS','public');
        }
        $request->validate(['CIN_verso_path'=>'required|image|mimes:jpeg,png,jpg|max:2048',]);
        if($request->hasFile('CIN_verso_path')){
            $photoVERSO= $request->file('CIN_verso_path')->store('CIN_PHOTOS','public');
        }
        //create manager
        $managers= Manager::create([
            'password'=> Hash::make($passwordGenerate),
             'nom' =>$request->input('nom'),
             'prenom' =>$request->input('prenom'),
             'phone' =>$request->input('phone'),
             'email' =>$request->input('email'),
             'pays' =>$request->input('pays'),
             'ville' =>$request->input('ville'),
             'RIB' =>$request->input('RIB'),
             'NomBanque' =>$request->input('NomBanque'),
             'CIN_recto_path' => $photoRECTO,
             'CIN_verso_path' => $photoVERSO,
         ]);
        $managers->save();
        Mail::to($managers->email)->send(new CreateManager($managers,$passwordGenerate));
        
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
}
