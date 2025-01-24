<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\ReferenceLetter;

class ReferenceCreateController extends Controller
{
    /**
     * Show the form to create a new reference letter.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('reference_create');
    }

    /**
     * Store a new reference letter.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'sender_email' => 'required|email',
            'receiver_email' => 'required|email',
            'message' => 'nullable|string',
            'reference_letter_pdf' => 'required|file|mimes:pdf,doc,docx|max:2048',
        ]);

        // Handle the file upload
        $file = $request->file('reference_letter_pdf');
        $filePath = $file->store('reference_letters', 'public');

        // Generate a unique token
        $token = Str::random(32);

        // Create a new reference letter record in the database
        $referenceLetter = ReferenceLetter::create([
            'sender_email' => $request->input('sender_email'),
            'receiver_email' => $request->input('receiver_email'),
            'message' => $request->input('message'),
            'reference_letter_pdf' => $file->getClientOriginalName(),
            'reference_letter' => $filePath,
            'token' => $token,
        ]);

        // Redirect to the dashboard after storing
        return redirect()->route('dashboard')->with('success', 'Reference letter successfully created.');
    }
}
