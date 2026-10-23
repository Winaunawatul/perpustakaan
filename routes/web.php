<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BukuController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// Halaman utama
Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

// Dashboard
Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    // Menampilkan daftar buku dan pencarian
    Route::get('/buku', [BukuController::class, 'index'])
        ->name('buku');

    // Form tambah buku
    Route::get('/buku/create', [BukuController::class, 'create'])
        ->name('buku.create');

    // Menyimpan buku baru
    Route::post('/buku', [BukuController::class, 'store'])
        ->name('buku.store');

    // Form edit buku
    Route::get('/buku/{book}/edit', [BukuController::class, 'edit'])
        ->name('buku.edit');

    // Memperbarui data buku
    Route::put('/buku/{book}', [BukuController::class, 'update'])
        ->name('buku.update');

    // Menghapus buku
    Route::delete('/buku/{book}', [BukuController::class, 'destroy'])
        ->name('buku.destroy');

    // Profil pengguna
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

// Route autentikasi
require __DIR__.'/auth.php';
