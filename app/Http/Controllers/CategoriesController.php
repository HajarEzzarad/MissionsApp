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
            'nom'=>'required',
        ]);
          //create category
          $categories=new Categorie;
          $categories->nom=$request->input('nom');

        if($request->hasFile('icon_path')){
            $name= $request->file('icon_path')->getClientOriginalName();
            $request->file('icon_path')->storeAs('public/photos/category_images', $name);
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
            'category'=>$categories,
            'missionsCount' => $missionsCount,
            'managersCount' => $managersCount,
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
                    Storage::delete('public/photos/category_images/' . $category->icon_path);
                }

                // Upload the new image
                $image = $request->file('icon_path');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->storeAs('public/photos/category_images', $imageName);

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
    
    public function getManager($categoryId)
    {
      $category = Categorie::with('managers')->find($categoryId);
       $managers = $category->managers;
        return response()->json(['managers' => $managers]);
    }

    public function getCategoryManagers($categoryId)
    {
        // Retrieve the category by its ID
        $category = Categorie::find($categoryId);

        if ($category) {
            // Retrieve the managers associated with the category
            $managers = $category->managers;

            return response()->json(['managers' => $managers], 200);
        }

        return response()->json(['message' => 'Category not found or has no managers.'], 404);
    }
    
    // CategoriesController.php

          public function addCategoryByManager(Request $request)
    {
         try {
        // Get the manager ID from the request
        $managerIds = $request->input('manager_ids');

        // If it's not an array, use the single manager_id
        if (!is_array($managerIds)) {
            $managerIds = [$request->input('manager_id', null)];
        }

        // Filter out null values
        $managerIds = array_filter($managerIds, function ($id) {
            return $id !== null;
        });

       

        // Create a new category
        $category = new Categorie([
            'nom' => $request->input('nom'),
            // Add other fields as needed
        ]);

        // Handle image upload
        if ($request->hasFile('icon_path')) {
            $image = $request->file('icon_path');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/photos/category_images', $imageName);
            $category->icon_path = $imageName;
        }

        // Save the category and associate it with the manager
        foreach ($managerIds as $managerId) {
            $manager = Manager::find($managerId);

            // Check if the manager exists
            if ($manager) {
                $manager->category()->save($category);
            }
        }

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
            $imagePath = $request->file('icon_path')->storeAs('public/photos/category_images', $name);
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
