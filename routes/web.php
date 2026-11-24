<?php

use App\Http\Controllers\Admin\BukuController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


// ===== POV USER =====

Route::get('/', [HomeController::class, 'beranda'])
    ->name('user.beranda');

Route::get('/katalog-buku', [HomeController::class, 'katalogBuku'])
    ->name('user.katalog-buku');


// ===== BAWAAN BREEZE =====

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

});


// ===== POV ADMIN =====

Route::prefix('admin')->name('admin.')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::resource('buku', BukuController::class);

});


// ===== AUTHENTICATION =====

require __DIR__.'/auth.php';
