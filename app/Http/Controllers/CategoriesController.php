<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categorie;
use App\Models\Mission;

class CategoriesController extends Controller
{
    public function index()
    {
        $categories = Categorie::withCount('mission')->get();
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $request->validate(['icon_path'=>'required|image|mimes:jpeg,png,jpg|max:2048',]);
        if($request->hasFile('icon_path')){
            $icon= $request->file('icon_path')->store('ICON_PHOTOS','public');
        }
        //create category
        $categories= Categorie::create([
            'nom'=>$request->input('nom'),
            'icon_path' => $icon,
        ]);
        $categories->save();

        return redirect()->route('categories.index');
    }

    public function show(Categorie $category)
    {
        //showing the missions in this category
        $missions = Mission::where('categorie_id', $category->id)->get();
        //count the missions
        $missionsCount = Mission::where('categorie_id', $category->id)->count();
        //get the data of the category
        $categories= Categorie::findOrFail($category->id);
        return view('categories.show', [
            'missions' => $missions,
            'category' => $categories,
            'missionsCount' => $missionsCount,
        ]);
    }
    public function edit($id)
    {
        $categories= Categorie::findOrFail($id);
        return view('categories.edit', compact('categories'));
    }
    public function update(Request $request, $id)
    {
        $missions = Mission::where('categorie_id', $id);
        $categories= Categorie::findOrFail($id);
        $categories->update($request->all());
        $categories->save();
        return redirect()->route('categories.index', [
            'missions' => $missions,
        ]);
    }

    public function destroy($id)
    { 
        $categories= Categorie::findOrFail($id);
        $categories->delete();
        return redirect()->route('categories.index');
    }
}
