<?php

// app/Http/Middleware/AdminMiddleware.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Check if the user is authenticated and is an admin
        if (Auth::check() && Auth::user()->administrator) {
            return $next($request);
        }

        // If not an admin, redirect them to the normal dashboard or login
        return redirect()->route('dashboard'); // Or redirect to login
    }
}

