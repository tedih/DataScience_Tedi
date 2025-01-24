<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReferenceLetter;

class TokenController extends Controller
{
    /**
     * Validate token and return response.
     *
     * @param string $token
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function validateToken($token)
    {
        // Check if the token exists in the database
        $reference = ReferenceLetter::where('token', $token)->first();

        if (!$reference) {
            // Token is invalid or expired
            return response()->json([
                'success' => false,
                'message' => 'Invalid or expired token.',
            ], 404);
        }

        // Token is valid, redirect or respond
        return response()->json([
            'success' => true,
            'message' => 'Token is valid.',
            'reference_id' => $reference->id,
        ]);
    }
}
