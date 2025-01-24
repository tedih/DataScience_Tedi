<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class SubmissionController extends Controller
{
    /**
     * Show the submission form.
     *
     * @return \Illuminate\View\View
     */
    public function showForm()
    {
        return view('submission');
    }

    /**
     * Handle the submission form request.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function submit(Request $request)
{
    // Validate the form input
    $request->validate([
        'submitter_name' => 'required|string|max:255',
        'student_name' => 'required|string|max:255',
        'message' => 'nullable|string|max:1000',
        'reference_letter' => 'required|mimes:pdf|max:2048', // Only accept PDF files
    ]);

    // Generate a new token for the submission
    $token = Str::random(32); // Generates a random 32-character string for the token

    try {
        // Handle file upload
        $file = $request->file('reference_letter');

        if (!$file->isValid()) {
            return redirect()->back()->with('error', 'The uploaded file is invalid.');
        }

        // Generate a unique file name
        $fileName = time() . '-' . $file->getClientOriginalName();
        // Store the file in the public/reference_letters directory
        $filePath = $file->storeAs('public/reference_letters', $fileName);

        // Save the submission data to the database
        DB::table('reference_letters')->insert([
            'sender_email' => $request->input('submitter_name'),
            'receiver_email' => $request->input('student_name'),
            'message' => $request->input('message'),
            'reference_letter_pdf' => $fileName, // Save file name
            'reference_letter' => $filePath,    // Save file path in reference_letter field
            'created_at' => now(),
            'updated_at' => now(),
            'token' => $token,
            'draft' => 0, // Default value for the draft column
        ]);

        return redirect()->back()->with('success', 'Submission successfully uploaded!');
    } catch (\Exception $e) {
        Log::error('Error saving submission: ' . $e->getMessage());
        return redirect()->back()->with('error', 'There was an error saving your submission. Please try again.');
    }
    }
}
