<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;
use App\Models\Mission;

class MissiosnController extends Controller
{
    public function index()
    {
        return view('categories.show');
    }

    public function create(Categorie $category)
    {
        return view('missions.create', compact('category'));
    }

    public function store(Request $request, Categorie $category)
    {
        
        $category->mission()->create([
            'nom' =>$request->input('nom'),
            'prix' =>$request->input('prix'),
            'description' =>$request->input('description'),
            'link' => $request->input('link'),

        ]);

        return redirect()->back()->with('message','Mission Created Succefully');
    }

    public function show(Mission $mission)
    {
        return view('missions.show', compact('mission'));
    }
    public function edit($id)
   {
    $missions= Mission::find($id);
    return view('missions.edit', compact('missions'));
   }
    public function update(Request $request, $id)
    {
        $missions= Mission::findOrFail($id);
        $missions->update($request->all());
        $missions->save();
        return redirect()->back()->with('message','Mission Edited successufully');
    }

    public function destroy(Mission $mission)
    { 
       
        $mission->delete();
        return redirect()->back()->with('message', 'the mission deleted!!');
    }
}
