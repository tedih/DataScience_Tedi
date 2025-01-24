<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminLogUserController extends Controller
{
    // Display the list of users (only authenticated admin user)
    public function index()
    {
        $users = User::all(); // Get all users (can filter or paginate if needed)
        return view('user.index', compact('users')); // Return the view with users data
    }

    // Show the user's own details (only the authenticated user)
    public function show($id = null)
{
    if (!$id) {
        return redirect()->route('user.index')->with('error', 'No user ID provided.');
    }

    $user = User::findOrFail($id); // Find the user by ID
    // Ensure only the authenticated user can view their own profile
    if (Auth::user()->id != $user->id) {
        return redirect()->route('user.index')->with('error', 'You can only view your own profile.');
    }

    return view('user.profile', compact('user')); // Return the profile view with the user's data
}

    // Show the form for editing the user's details (only the authenticated user)
    public function edit()
    {
        $user = Auth::user(); // Get the authenticated user

        // Return the edit form with the user's data
        return view('user.edit', compact('user'));
    }

    // Custom save method without logging
    protected function customSave(User $user)
    {
        try {
            $user->save(); // Perform the save operation
        } catch (\Exception $e) {
            // Return the error message without logging
            return redirect()->route('user.profile')->with('error', 'An error occurred while updating your profile.');
        }
    }

    // Update the user's details (only the authenticated user)
    public function update(Request $request)
    {
        // Get the currently authenticated user
        $user = Auth::user();
    
        // Check if user is null (in case no user is authenticated)
        if (!$user) {
            return redirect()->route('user.index')->with('error', 'User not authenticated.');
        }
    
        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id, // Exclude current user's email from uniqueness check
            'password' => 'nullable|string|min:8|confirmed', // Password is optional, but should be validated if present
        ]);
    
        // Update the user's profile details
        $user->name = $request->name;
        $user->email = $request->email;
    
        // If password is provided, hash and update it
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
    
        // Use the custom save method
        $this->customSave($user);
    
        // Redirect back to the profile page with a success message
        return redirect()->route('user.profile')->with('success', 'Your profile has been updated successfully!');
    }
}