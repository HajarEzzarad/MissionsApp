<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class MissiosnController extends Controller
{
    public function index()
    {
        $users = User::all();

        return view('missions.index', compact('users'));
    }

    public function create()
    {
        return view('missions.create');
    }

    public function store(Request $request)
    {
        $user = new User;
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = $request->input('password');
        $user->save();

        return redirect()->route('users.index');
    }

    public function show($id)
    {
        $user= User::findOrFail($id);
        return view('users.show', compact('user'));
    }
    public function edit($id)
    {
        $user= User::findOrFail($id);
        return view('users.edit', compact('user'));
    }
    public function update(Request $request, $id)
    {
        $user= User::findOrFail($id);
        $user->update($request->all());
    $user->save();
    return redirect()->route('users.index');
    }

    public function destroy($id)
    { 
        $user= User::findOrFail($id);
        $user->delete();
        return redirect()->route('users.index');
    }
}
