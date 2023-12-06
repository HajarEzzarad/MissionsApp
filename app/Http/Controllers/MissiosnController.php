<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;
use App\Models\Mission;
use App\Models\Client;
use Carbon\Carbon;


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
            'duration' =>$request->input('duration'),
        

        ]);

        return redirect()->back()->with('message','Mission Created Succefully');
    }

    public function show(Mission $mission)
    {
        $timeToStop = $mission->calculateTimeToStop();
        $clients =Client::where('missioncomplete','like','%"id":%'.$mission->id. '%')->get();
        return view('missions.show', compact('mission','clients','timeToStop'));
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

    //apis ////////////////////////////////////////
    public function getMissionsByCategory($categoryId)
    {
        $missions = Mission::where('categorie_id', $categoryId)->get();
    
        return response()->json(['missions' => $missions]);
    }
    public function deleteMission($id)
    {
        try {
            $mission = Mission::findOrFail($id);
            $mission->delete();

            return response()->json(['message' => 'Mission deleted successfully']);
        } catch (\Exception $e) {
            \Log::error('Error deleting mission: ' . $e->getMessage());

            return response()->json(['error' => 'Error deleting mission', 'message' => $e->getMessage()], 500);
        }
    }
    public function createMissionAPI(Request $request, $categoryId)
    {
        try {
            $category = Categorie::findOrFail($categoryId);

            $mission = $category->mission()->create([
                'nom' => $request->input('nom'),
                'prix' => $request->input('prix'),
                'description' => $request->input('description'),
                'link' => $request->input('link'),
            ]);

            return response()->json(['message' => 'Mission created successfully', 'mission' => $mission]);
        } catch (\Exception $e) {
            \Log::error('Error creating mission: ' . $e->getMessage());

            return response()->json(['error' => 'Error creating mission', 'message' => $e->getMessage()], 500);
        }
    }

    public function updateMission(Request $request, $id)
    {
      try {
        $mission = Mission::findOrFail($id);
        
        $mission->update([
            'nom' => $request->input('nom'),
            'prix' => $request->input('prix'),
            'description' => $request->input('description'),
            'link' => $request->input('link'),
        ]);

        return response()->json(['message' => 'Mission updated successfully', 'mission' => $mission]);
       } catch (\Exception $e) {
        \Log::error('Error updating mission: ' . $e->getMessage());

        return response()->json(['error' => 'Error updating mission', 'message' => $e->getMessage()], 500);
       }
    }
      
    public function getMissionHistory($missionIds)
{
    $missionIdsArray = explode(',', $missionIds);

    $missions = Mission::with(['category:id,nom'])
        ->whereIn('id', $missionIdsArray)
        ->get(['id', 'nom','prix','description' ,'link' ,'categorie_id as category_id']);

    return response()->json(['missions' => $missions]);
}

     

    public function destroy(Mission $mission)
    { 
        $mission->delete();
        return redirect()->back()->with('message', 'the mission deleted!!');
    }
}
