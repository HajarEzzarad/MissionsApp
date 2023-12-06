<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categorie;
use App\Models\Manager;
use App\Models\Mission;
use Illuminate\Support\Facades\Storage;

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

foreach ($missions as $mission) {
    $timeToStop = $mission->calculateTimeToStop();

    if (now()->gt($timeToStop) && $mission->status) {
        $mission->status = false;
        $mission->save();
    }
}
        //count the missions
        $missionsCount = Mission::where('categorie_id', $category->id)->count();
        //get the data of the category
        $category = Categorie::with('managers')->find($category->id);
        $managersCount = $category->managers->count();
        $categories= Categorie::with('managers')->findOrFail($category->id);
        return view('categories.show', [
            'missions' => $missions,
            'category'=>$categories,
            'missionsCount' => $missionsCount,
            'managersCount' => $managersCount, 
            'timeToStop' => $timeToStop,
        ]);
    }

    
    //api for the app
     public function fetchCategories()
     {
        
        $categories = Categorie::withCount('mission')->get();

        // Assuming there is a 'missions_count' attribute in the response
        $response = ['categories' => $categories];
    
        return response()->json($response);
     }

     public function categoriesForManager($managerId)
    {
      // Find the manager
      $manager = Manager::findOrFail($managerId);

       // Load the categories associated with the manager and count of missions for each category
       $categories = $manager->category()->withCount('mission')->get();

       return response()->json(['categories' => $categories]);
    }
    public function deleteC($id)
    {
        $categories= Categorie::findOrFail($id);
        $categories->managers()->detach();
        $categories->mission()->delete();
        $categories->delete();
        return response()->json(['message' => 'Category deleted successfully']);


    }
     
    public function updateCategory(Request $request, $id)
    {
        try {
            // Find the category
            $category = Categorie::findOrFail($id);

            // Validate the request data
            $request->validate([
                'nom' => 'required|string',
                // Add other validation rules as needed
            ]);

            // Update the category fields
            $category->nom = $request->input('nom');

            // Handle image update
            if ($request->hasFile('icon_path')) {
                // Delete the existing image if it exists
                if ($category->icon_path) {
                    Storage::delete('public/category_images/' . $category->icon_path);
                }

                // Upload the new image
                $image = $request->file('icon_path');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->storeAs('public/category_images', $imageName);

                // Update the icon_path field
                $category->icon_path = $imageName;
            }

            // Save the updated category
            $category->save();

            return response()->json(['message' => 'Category updated successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error updating category', 'message' => $e->getMessage()], 500);
        }
    }

    
    // CategoriesController.php

          public function addCategoryByManager(Request $request)
    {
         try {
        // Get the manager ID from the request
        $managerId = $request->input('manager_id');

        // Find the manager
        $manager = Manager::find($managerId);

        // Check if the manager exists
        if (!$manager) {
            return response()->json(['error' => 'Manager not found'], 404);
        }

        // Validate the request data
        // $request->validate([
        //     'nom' => 'required|string',
        //     'icon_path' => 'required|string',
        //     // Add other validation rules as needed
        // ]);

        // Create a new category
        $category = new Categorie([
            'nom' => $request->input('nom'),
            // Add other fields as needed
        ]);

        // Handle image upload
        if ($request->hasFile('icon_path')) {
            $image = $request->file('icon_path');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/category_images', $imageName);
            $category->icon_path = $imageName;
        }

        // Save the category and associate it with the manager
        $manager->category()->save($category);

        return response()->json(['message' => 'Category added successfully'], 201);
     } catch (\Exception $e) {
        return response()->json(['error' => 'Error adding category', 'message' => $e->getMessage()], 500);
      }
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
        $categories->nom= $request->input('nom');
        if($request->hasFile('icon_path')){
            $name= $request->file('icon_path')->getClientOriginalName();
            $imagePath = $request->file('icon_path')->storeAs('public/category_photo', $name);
            $categories->icon_path= $imagePath;
        }
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
