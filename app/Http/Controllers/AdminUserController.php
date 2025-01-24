<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    // Display all users
    public function index()
    {
        $users = User::all(); // Get all users
        return view('admin.users.index', compact('users'));
    }

    // Show the form to create a new user
    public function create()
    {
        return view('admin.users.create');
    }

    // Store a newly created user
    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'administrator' => 'required|boolean', // Ensure administrator field is present and valid
        ]);

        // Create a new user
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'administrator' => $request->administrator, // Set administrator field
        ]);

        // Redirect to users list with a success message
        return redirect()->route('admin.users')->with('success', 'User created successfully!');
    }

    // Show the form to edit a user
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    // Update the user details
    public function update(Request $request, $id)
    {
        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8|confirmed',
            'administrator' => 'required|boolean', // Ensure administrator field is present and valid
        ]);

        // Find the user and update their details
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
        $user->administrator = $request->administrator; // Update administrator field
        $user->save();

        // Redirect to users list with a success message
        return redirect()->route('admin.users')->with('success', 'User updated successfully!');
    }

    // Delete a user
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        // Redirect to users list with a success message
        return redirect()->route('admin.users')->with('success', 'User deleted successfully!');
    }
}
