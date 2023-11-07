<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Http\Request\UpdateUserRequest;
use App\Models\Client;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Laravel\Jetstream\Jetstream;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Str;


class ClientsController extends Controller
{
    public function index()
    {
        $users = Client::all();

        return view('users.index', compact('users'));
    }
    public function show($id)
    {
        $user= Client::findOrFail($id);
        return view('users.show', compact('user'));
    }
    public function edit($id)
    {
        $user= Client::findOrFail($id);
        return view('users.edit', compact('user'));
    }
    public function update(Request $request, $id)
    {
        $user= Client::findOrFail($id);
        $user->update($request->all());
    $user->save();
    return redirect()->route('users.index');
    }

    public function destroy($id)
    { 
        $user= Client::findOrFail($id);
        $user->delete();
        return redirect()->route('users.index');
    }
}

