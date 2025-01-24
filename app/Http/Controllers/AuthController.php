<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // Show the registration form
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    // Handle registration
    public function register(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed', // Confirm password field
        ]);

        // If validation fails, redirect back with errors
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Create the user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Encrypt password using bcrypt
        ]);

        // Log the user in automatically after registration
        Auth::login($user);

        // Redirect to the dashboard (or home page), you can choose to use 'home' if you have a named route
        return redirect()->route('dashboard'); // Adjust to 'home' if that's your preferred route name
    }

    // Show the login form
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Handle login
    public function login(Request $request)
    {
        // Validate the login request
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // Check if the user exists with the provided email
        $user = User::where('email', $request->email)->first();

        // Check if the user exists and the password is correct
        if ($user && Hash::check($request->password, $user->password)) {
            // If the user wants to log in as an administrator, check the 'administrator' column
            if ($request->has('login_as_admin') && $user->administrator == 1) {
                // Log the user in as an admin
                Auth::login($user);
            
                // Redirect to the admin dashboard
                return redirect()->route('admin.dashboard');  // Redirect to the admin dashboard
            }
            
            // If the user is a regular user, log them in and redirect to the regular dashboard
            Auth::login($user);
            
            return redirect()->route('dashboard'); // Redirect to the regular user dashboard
        }

        // If login fails, return an error message
        return back()->with('error', 'Invalid credentials. Please try again or register.');
    }

    // Handle logout
    public function logout(Request $request)
    {
        Auth::logout();

        // Regenerate the session to prevent session fixation attacks
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect to the login page
        return redirect()->route('login');
    }
}