<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SuperUser;

class SuperUserController extends Controller
{
    public function index()
    {
        $users = SuperUser::all();
        return view('superadmin.superuser', compact('users'));
    }

    public function create()
    {
        return view('superadmin.create_superuser');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'role' => 'required',
            'password' => 'required|min:6',
        ]);

        SuperUser ::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('superusers.index')->with('success', 'User  created successfully.');
    }

    public function edit($id)
    {
        $user = SuperUser ::findOrFail($id);
        return view('superadmin.edit_superuser', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'role' => 'required',
            'password' => 'nullable|min:6', 
        ]);

        $user = SuperUser ::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
        
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password); 
        }

        $user->save();

        return redirect()->route('superusers.index')->with('success', 'User  updated successfully.');
    }

    public function destroy($id)
    {
        $user = SuperUser ::findOrFail($id);
        $user->delete();

        return redirect()->route('superusers.index')->with('success', 'User  deleted successfully.');
    }
}
