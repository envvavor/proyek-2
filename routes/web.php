<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

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

require __DIR__.'/auth.php';
