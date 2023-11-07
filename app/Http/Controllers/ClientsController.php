<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Http\Request\UpdateUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;


class ClientsController extends Controller
{
    public function index()
    {
        $users = User::all();

        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
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

