<?php

namespace App\Http\Controllers;

use App\Models\ReferenceLetter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ReferenceLetterController extends Controller
{
    // Show all reference letters
    public function index()
    {
        $referenceLetters = ReferenceLetter::all(); // Get all reference letters
        return view('admin.reference_letters.index', compact('referenceLetters'));
    }

    // Show form to edit a reference letter
    public function edit($id)
    {
        $referenceLetter = ReferenceLetter::find($id);

        if (!$referenceLetter) {
            return redirect()->route('admin.reference_letters.index')->with('error', 'Reference Letter not found.');
        }

        return view('admin.reference_letters.edit', compact('referenceLetter'));
    }

    // Update reference letter data
    public function update(Request $request, $id)
    {
        // Validate the incoming request data
        $request->validate([
            'sender_email' => 'required|email',
            'receiver_email' => 'required|email',
            'message' => 'nullable|string',
            'reference_letter_pdf' => 'nullable|file|mimes:pdf,doc,docx|max:10240', // Allow PDF or Word documents
        ]);

        $referenceLetter = ReferenceLetter::find($id);

        if (!$referenceLetter) {
            return redirect()->route('admin.reference_letters.index')->with('error', 'Reference Letter not found.');
        }

        // Handle file upload (if provided)
        if ($request->hasFile('reference_letter_pdf')) {
            // Delete the old file if it exists
            if ($referenceLetter->reference_letter_pdf && Storage::exists($referenceLetter->reference_letter_pdf)) {
                Storage::delete($referenceLetter->reference_letter_pdf);
            }

            // Store the new file
            $file = $request->file('reference_letter_pdf');
            $filePath = $file->store('reference_letters', 'public'); // Store in the 'public' disk

            // Update the reference letter's PDF field in the database
            $referenceLetter->reference_letter_pdf = $filePath;
        }

        // Update other fields
        $referenceLetter->sender_email = $request->input('sender_email');
        $referenceLetter->receiver_email = $request->input('receiver_email');
        $referenceLetter->message = $request->input('message');
        
        $referenceLetter->save();

        return redirect()->route('admin.reference_letters.index')->with('success', 'Reference Letter updated successfully.');
    }

    // Delete a reference letter
    public function destroy($id)
    {
        $referenceLetter = ReferenceLetter::find($id);

        if (!$referenceLetter) {
            return redirect()->route('admin.reference_letters.index')->with('error', 'Reference Letter not found.');
        }

        // Delete the reference letter's file if it exists
        if ($referenceLetter->reference_letter_pdf && Storage::exists($referenceLetter->reference_letter_pdf)) {
            Storage::delete($referenceLetter->reference_letter_pdf);
        }

        $referenceLetter->delete();

        return redirect()->route('admin.reference_letters.index')->with('success', 'Reference Letter deleted successfully.');
    }
}
