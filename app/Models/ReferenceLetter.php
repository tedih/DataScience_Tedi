<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReferenceLetter extends Model
{
    use HasFactory;

    protected $fillable = [
        'sender_email',
        'receiver_email',
        'reference_letter_pdf',
        'reference_letter',
        'message',
        'token',
        'draft', // Include the draft column here
    ];
}
