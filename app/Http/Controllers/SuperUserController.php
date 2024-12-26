<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SuperUser;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

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

    public function edit($id)
    {
        $user = SuperUser ::findOrFail($id);
        return response()->json($user);
        // return view('superadmin.edit_superuser', compact('user'));
    }

    public function update(Request $request, $id)
    {
        // Validate the incoming data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $id,
            'role' => 'required|string|in:admin,user,superadmin',
            'password' => 'nullable|string|min:8|confirmed', // Password is optional for update
        ]);
    
        // Find the user to update
        $user = User::findOrFail($id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->role = $request->input('role');
        
        // If a password is provided, hash it and update
        if ($request->filled('password')) {
            $user->password = Hash::make($request->input('password'));
        }
    
        $user->save();
    
        return redirect()->route('superusers.index')->with('success', 'User updated successfully.');
    }
    
    public function store(Request $request)
    {
        // Validate the incoming data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'role' => 'required|string|in:admin,user,superadmin',
            'password' => 'required|string|min:8|confirmed',
        ]);
    
        // Create the user
        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->role = $request->input('role');
        $user->password = Hash::make($request->input('password')); // Hash the password
        $user->save();
    
        return redirect()->route('superusers.index')->with('success', 'User added successfully.');
    }
    
    
    
    
    
    public function destroy($id)
    {
        $user = SuperUser::findOrFail($id);
        $user->delete();
    
        return redirect()->route('superusers.index')->with('success', 'User Deleted successfully.');

    }    
    
    
};
