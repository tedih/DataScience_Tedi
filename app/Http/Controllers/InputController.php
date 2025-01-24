<?php

namespace App\Http\Controllers;

use App\Models\ReferenceLetter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str; // Add this import
use App\Http\Controllers\MailController;

class InputController extends Controller
{
    public function create()
    {
        return view('input'); // This returns the input form
    }

    public function store(Request $request)
{
    // Validation
    $validated = $request->validate([
        'sender_email' => 'required|email',
        'receiver_email' => 'required|email',
        'reference_letter_pdf' => 'nullable|file|mimes:pdf|max:10240', // Validate PDF file
        'message' => 'nullable|string',
        'status' => 'required|in:draft,sent',
    ]);

    // Handle file upload if there is one
    $fileName = null;
    $filePath = null; // Add a variable to store the file path
    if ($request->hasFile('reference_letter_pdf')) {
        $file = $request->file('reference_letter_pdf');
        $fileName = time() . '-' . $file->getClientOriginalName();
        // Store the file in the public/reference_letters directory
        $filePath = $file->storeAs('public/reference_letters', $fileName);
    }

    // Create the ReferenceLetter entry in the database
    $referenceLetter = ReferenceLetter::create([
        'sender_email' => $validated['sender_email'],
        'receiver_email' => $validated['receiver_email'],
        'reference_letter_pdf' => $fileName,  // Store file name in reference_letter_pdf field
        'reference_letter' => $filePath,      // Save the full file path in reference_letter field
        'message' => $validated['message'],
        'status' => $validated['status'],
        'token' => Str::random(32), // Generate a random token using Str facade
    ]);

    // If the status is 'sent', trigger the email sending logic
    if ($validated['status'] == 'sent') {
        $mailController = new MailController();
        $emailSent = $mailController->sendReferenceLetterEmail(
            $validated['sender_email'],
            $validated['receiver_email'],
            $fileName,
            $referenceLetter->token
        );

        // Check if email sending was successful
        if ($emailSent) {
            return redirect()->route('input.create')->with('success', 'Reference letter uploaded and email sent successfully.');
        } else {
            return redirect()->route('input.create')->with('error', 'Failed to send the email.');
        }
    }

    // If the status is 'draft', just save it and return success
    return redirect()->route('input.create')->with('success', 'Reference letter uploaded successfully as draft.');
    }
}