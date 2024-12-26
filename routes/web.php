<?php

use App\Http\Controllers\ClassController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\SubmissionController;
use App\Http\Controllers\SubjectController;

Route::get('/', function () {
    return view('welcome');
});

// Dashboard Murid
Route::get('/murid/dashboard', function () {
    return view('murid.dashboard');
})->middleware(['auth', 'verified', 'menumurid'])->name('murid.dashboard');

//Dashboard Siswa
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified', 'menumurid'])->name('dashboard');

//Dashboard Guru
Route::get('/guru/dashboard', function () {
    return view('guru.dashboard');
})->middleware(['auth', 'verified', 'menuguru'])->name('guru.dashboard');

//Dashboard Admin
Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'verified', 'menuadmin'])->name('admin.dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/halamanutama', function () {
    return view('halamanutama'); // Ganti 'nama_halaman' dengan nama file di folder views tanpa '.blade.php'
});

Route::get('/halamanprofile', function () {
    return view('halamanprofile'); // Ganti 'nama_halaman' dengan nama file di folder views tanpa '.blade.php'
});

Route::get('/halamansarana', function () {
    return view('halamansarana'); // Ganti 'nama_halaman' dengan nama file di folder views tanpa '.blade.php'
});

Route::get('/halamankontak', function () {
    return view('halamankontak'); // Ganti 'nama_halaman' dengan nama file di folder views tanpa '.blade.php'
});

Route::get('/halamanhubungan', function () {
    return view('halamanhubungan'); // Ganti 'nama_halaman' dengan nama file di folder views tanpa '.blade.php'
});

Route::get('/halamangaleri', function () {
    return view('halamangaleri'); // Ganti 'nama_halaman' dengan nama file di folder views tanpa '.blade.php'
});

Route::resource('users', UserController::class)->middleware(['auth']);

Route::get('/admin/dashboard', function () {
    $userCount = app(UserController::class)->hitung();
    $assignmentCount = app(AssignmentController::class)->count();
    $submissionCount = app(SubmissionController::class)->count();

    return view('admin.dashboard', compact('userCount', 'assignmentCount', 'submissionCount'));
})->name('admin.dashboard');

Route::get('/assignments/create', [AssignmentController::class, 'create'])->name('assignments.create');
Route::post('/assignments', [AssignmentController::class, 'store'])->name('assignments.store');
Route::get('/assignments', [AssignmentController::class, 'index'])->name('assignments.index');

Route::get('assignments/{id}/edit', [AssignmentController::class, 'edit'])->name('assignments.edit');
Route::put('assignments/{id}', [AssignmentController::class, 'update'])->name('assignments.update');
Route::delete('assignments/{id}', [AssignmentController::class, 'destroy'])->name('assignments.destroy');

Route::get('subjects/{id}', [SubjectController::class, 'show'])->name('subjects.show');

Route::get('/guru/dashboard', [SubjectController::class, 'index'])->name('guru.dashboard');
Route::get('/guru/dashboard', [ClassController::class, 'index'])->name('guru.dashboard');

Route::get('/murid/dashboard', function () {
    $subjects = app(SubjectController::class)->index()->getData()->subjects;
    $pendingAssignmentsCount = app(SubmissionController::class)->countPendingAssignments();
    $notifications = auth()->user()->notifications;

    return view('murid.dashboard', compact('subjects', 'pendingAssignmentsCount', 'notifications'));
})->name('murid.dashboard');

Route::get('classes/{id}', [ClassController::class, 'show'])->name('classes.show');


Route::get('/submissions', [SubmissionController::class, 'index'])->name('submissions.index');
Route::post('/submissions/{assignment}', [SubmissionController::class, 'store'])->name('submissions.store');
Route::get('/submissions/all', [SubmissionController::class, 'indexAll'])->name('submissions.indexAll');

Route::get('/submissions/file/{filename}', function ($filename) {
    $path = 'private/public/submissions/' . $filename;

    if (!Storage::exists($path)) {
        abort(404);
    }

    return Storage::download($path);
})->name('submissions.file');

Route::get('/subjects', [SubjectController::class, 'list'])->name('subjects.index');
Route::get('/subjects/create', [SubjectController::class, 'create'])->name('subjects.create');
Route::post('/subjects', [SubjectController::class, 'store'])->name('subjects.store');
Route::get('/subjects/{id}/edit', [SubjectController::class, 'edit'])->name('subjects.edit');
Route::put('/subjects/{id}', [SubjectController::class, 'update'])->name('subjects.update');
Route::delete('/subjects/{id}', [SubjectController::class, 'destroy'])->name('subjects.destroy');

require __DIR__.'/auth.php';
