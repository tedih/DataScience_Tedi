<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\InputController;
use App\Http\Controllers\TokenController;
use App\Http\Controllers\SubmissionController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\ReferenceLetterController;
use App\Http\Controllers\ReferenceCreateController;
use App\Http\Controllers\AdminLogUserController;
use App\Http\Controllers\AdminLogReferenceController;
use App\Http\Controllers\MailController;

Route::get('/', function () {
    return view('auth.login'); // Redirect to the login page or a custom default page
});

// Registration Routes
Route::get('register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [AuthController::class, 'register']);

// Login Routes
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);

// Logout Route
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

// Dashboard/Home Route - After login or registration
Route::get('dashboard', function() {
    return view('dashboard'); // You can customize the dashboard view
})->name('dashboard');

Route::get('/input', [InputController::class, 'create'])->name('input.create');
Route::post('/input', [InputController::class, 'store'])->name('input.store');
Route::post('/reference/store', [ReferenceCreateController::class, 'store'])->name('reference_store');

Route::get('/validate-token/{token}', [TokenController::class, 'validateToken'])->name('token.validate');

Route::get('/submit/{token}', function ($token) {
    // Look up the reference letter by token
    $referenceLetter = \App\Models\ReferenceLetter::where('token', $token)->first();

    if (!$referenceLetter) {
        return abort(404, 'Reference letter not found.');
    }

    // You can return a simple view or perform other actions
    return view('submit.form', compact('referenceLetter'));
});

Route::get('/submit/{token}', [SubmissionController::class, 'showForm'])->name('submission.show');
Route::get('/submit/{token}', [SubmissionController::class, 'showForm'])->name('submission.form');
Route::post('/submit', [SubmissionController::class, 'submit'])->name('submission.submit');

Route::get('/reference_create', function () {
    return view('reference_create');
})->name('reference_create');
Route::post('/reference/store', [ReferenceCreateController::class, 'store'])->name('reference_store');

// Add the reference create route here');

Route::get('/reference/create', [ReferenceCreateController::class, 'create'])->name('reference_create');
Route::post('/reference/store', [ReferenceCreateController::class, 'store'])->name('reference_store');

Route::middleware(['auth', 'admin'])->group(function () {
    // Admin Dashboard Route
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    // Admin-specific routes for managing users, submissions, etc.
    // Other admin routes here
});

Route::get('reference_create', [ReferenceCreateController::class, 'create'])->name('reference_create');
Route::post('reference_store', [ReferenceCreateController::class, 'store'])->name('reference_store');
    

Route::get('/reference_create', function () {
    return view('reference_create');
})->name('reference_create');

Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

Route::get('/admin/users', [AdminController::class, 'viewUsers'])->name('admin.users');
Route::get('/admin/reference_letters', [AdminController::class, 'viewReferenceLetters'])->name('admin.reference_letters');

Route::get('/admin/users', [AdminUserController::class, 'index'])->name('admin.users');
Route::get('/admin/users/create', [AdminUserController::class, 'create'])->name('admin.users.create');
Route::post('/admin/users', [AdminUserController::class, 'store'])->name('admin.users.store');
Route::get('/admin/users/{id}/edit', [AdminUserController::class, 'edit'])->name('admin.users.edit');
Route::put('/admin/users/{id}', [AdminUserController::class, 'update'])->name('admin.users.update');
Route::delete('/admin/users/{id}', [AdminUserController::class, 'destroy'])->name('admin.users.delete');

Route::prefix('admin')->name('admin.')->middleware('auth')->group(function() {
    Route::resource('reference_letters', ReferenceLetterController::class);
});

Route::middleware('auth')->group(function () {
    // Route to display the list of users (if applicable, for admins or managers)
    Route::get('/user/index', [AdminLogUserController::class, 'index'])->name('user.index');

    // Route to show the authenticated user's profile
    Route::get('/user/profile', [AdminLogUserController::class, 'show'])->name('user.profile');

    // Route to show the form for editing the authenticated user's profile
    Route::get('/user/profile/edit', [AdminLogUserController::class, 'edit'])->name('user.edit');

    Route::put('/user/profile/update', [AdminLogUserController::class, 'update'])->name('user.update'); // This route handles the PUT request

});

Route::middleware(['auth'])->group(function () {
    // Display the list of reference letters
    Route::get('/user/reference-letters', [AdminLogReferenceController::class, 'index'])->name('user.reference_letters.index');

    // Show a specific reference letter (the route causing the error)
    Route::get('/user/reference-letters/{referenceLetter}', [AdminLogReferenceController::class, 'show'])->name('user.reference_letters.show');
});

Route::get('/send-email', function () {
    return view('send-email');
})->name('send.email.view');
Route::post('/send-email', [MailController::class, 'Email'])->name('send.email');
