<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categorie;
use App\Models\Manager;
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
        $request->validate([
            'icon_path'=>'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);
          //create category
          $categories=new Categorie;
          $categories->nom=$request->input('nom');

        if($request->hasFile('icon_path')){
            $name= $request->file('icon_path')->getClientOriginalName();
            $request->file('icon_path')->storeAs('public/category_photo', $name);
            $categories->icon_path= $name;
          
        }
      
       
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
        $category = Categorie::with('managers')->find($category->id);
        $managersCount = $category->managers->count();
        $categories= Categorie::with('managers')->findOrFail($category->id);
        return view('categories.show', [
            'missions' => $missions,
            'missionsCount' => $missionsCount,
            'managersCount' => $managersCount,
        ]);
    }

    return view('categories.show', [
        'missions' => $missions,
        'category' => $categoryData, // Corrected variable name
        'missionsCount' => $missionsCount,
    ]);
}
     public function fetchCategories(){
        
        $categories = Categorie::withCount('mission')->get();

        // Assuming there is a 'missions_count' attribute in the response
        $response = ['categories' => $categories];
    
        return response()->json($response);
     }

    public function edit($id)
    {
        $AllManagers= Manager::all();
        $categories= Categorie::findOrFail($id);
        $managers= Categorie::with('managers')->findOrFail($id);
        $availableManagers = $AllManagers->diff($categories->managers);
        return view('categories.edit', compact('categories', 'managers', 'AllManagers', 'availableManagers'));
    }
    public function update(Request $request, $id)
    {
        
       // $managers = Manager::whereIn('id',$request->input('manager_ids'))->get();
       
        $missions = Mission::where('categorie_id', $id);
        $categories= Categorie::findOrFail($id);
        $categories->update($request->all());
        $categories->icon_path=$request->input('icon_path');
        $categories->save();
        return redirect()->route('categories.index', [
            'missions' => $missions,
            'category' => $categories->id,
        ]);
    }
    public function detachManager(Categorie $category, Manager $manager)
    {
        $category->managers()->detach($manager->id);
        return redirect()->back();
    }
    public function addManager(Categorie $category, Manager $manager)
    {
        $category->managers()->attach($manager->id);
        return redirect()->back();
    }

    public function destroy($id)
    { 
        $categories= Categorie::findOrFail($id);
        $categories->managers()->detach();
        $categories->delete();
        return redirect()->route('categories.index');
    }
}
