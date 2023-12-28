<?php

namespace App\Http\Controllers;

use App\Models\Confidentialite;
use Illuminate\Http\Request;

class ConfidentialiteController extends Controller
{
    public function index()
    {
        $confidentialite= Confidentialite::all();
        return view('confidentialite.index', compact('confidentialite'));
    }
    public function create()
    {
    return view('confidentialite.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'text' => 'required',
        ]);
    $config = new Confidentialite();
    $config->text = $request->input('text');

    $config->save();
        return redirect()->route('confidentialite.index');
    }

    public function edit($id)
    {
        $confidentialite= Confidentialite::findOrFail($id);
     return view('confidentialite.edit', compact('confidentialite'));
    }
     public function update(Request $request,$id)
     {
        $config= Confidentialite::findOrFail($id);
         $config->update($request->all());
         $config->save();
         return redirect()->route('confidentialite.index')->with('message','confidentialité Edited successufully');
     }

     public function destroy($id)
     {
        $config= Confidentialite::findOrFail($id);
         $config->delete();
         return redirect()->back();
     }
}
