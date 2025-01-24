<?php

namespace App\Http\Controllers;

use App\Models\ReferenceLetter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdminLogReferenceController extends Controller
{
    // Show all reference letters for the authenticated user
    public function index()
    {
        // Get all reference letters for the authenticated user
        $user = Auth::user();
        $referenceLetters = ReferenceLetter::where('receiver_email', $user->email)->get(); // Get all reference letters where the receiver is the logged-in user

        return view('user.reference_letters.index', compact('referenceLetters'));
    }

    // Show form to view a specific reference letter
    public function show($id)
    {
        // Get the reference letter by its ID
        $referenceLetter = ReferenceLetter::find($id);

        if (!$referenceLetter) {
            return redirect()->route('user.reference_letters.index')->with('error', 'Reference Letter not found.');
        }

        // Ensure that the logged-in user is the recipient of the letter
        $user = Auth::user();
        if ($referenceLetter->receiver_email !== $user->email) {
            return redirect()->route('user.reference_letters.index')->with('error', 'You are not authorized to view this reference letter.');
        }

        return view('user.reference_letters.show', compact('referenceLetter'));
    }
}
