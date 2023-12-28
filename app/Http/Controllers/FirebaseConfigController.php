<?php

namespace App\Http\Controllers;

use App\Models\FirebaseConfig;
use Illuminate\Http\Request;

class FirebaseConfigController extends Controller
{
    public function index()
    {
        $config=FirebaseConfig::all();
        return view('configuration.index', compact('config'));
    }
    public function create()
    {
        return view('configuration.create');
    }
    public function store(Request $request)
    {
        
        $request->validate([
            'apiKey' => 'required',
            'authDomain' => 'required',
            'databaseURL' => 'required',
            'projectId' => 'required',
            'storageBocket' => 'required',
            'messagingSenderId' => 'required',
            'appId' => 'required',
            'measurementId' => 'required',
        ]);
   $config = new FirebaseConfig;
    $config->apiKey = $request->input('apiKey');
    $config->authDomain = $request->input('authDomain');
    $config->databaseURL =$request->input('databaseURL');
    $config->projectId = $request->input('projectId');
    $config->storageBocket = $request->input('storageBocket');
    $config->messagingSenderId =  $request->input('messagingSenderId');
    $config->appId = $request->input('appId');
    $config->measurementId = $request->input('measurementId');

$config->save();
        return redirect()->route('configuration.index');
    }
   
    public function edit($id)
    {
        $config= FirebaseConfig::findOrFail($id);
     return view('configuration.edit', compact('config'));
    }
     public function update(Request $request,$id)
     {
        $config= FirebaseConfig::findOrFail($id);
         $config->update($request->all());
         $config->save();
         return redirect()->route('configuration.index')->with('message','Configuration Edited successufully');
     }

     public function destroy($id)
     {
        $config= FirebaseConfig::findOrFail($id);
         $config->delete();
         return redirect()->back();
     }

}
