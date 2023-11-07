<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ManagersController extends Controller
{
    public function index()
    {
        $users = User::all();

        return view('managers.index', compact('users'));
    }

    public function create()
    {
        return view('managers.create');
    }

    public function store(Request $request)
    {
        $user = new User;
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = $request->input('password');
        $user->save();

        return redirect()->route('managers.index');
    }

    public function show($id)
    {
        $user= User::findOrFail($id);
        return view('managers.show', compact('user'));
    }
    public function edit($id)
    {
        $user= User::findOrFail($id);
        return view('managers.edit', compact('user'));
    }
    public function update(Request $request, $id)
    {
        $user= User::findOrFail($id);
        $user->update($request->all());
    $user->save();
    return redirect()->route('managers.index');
    }

    public function destroy($id)
    { 
        $user= User::findOrFail($id);
        $user->delete();
        return redirect()->route('managers.index');
    }
}
