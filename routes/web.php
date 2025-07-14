<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Web\DashboardController;
use App\Http\Controllers\Web\ProdukController;
use App\Http\Controllers\Web\LokasiController;
use App\Http\Controllers\Web\MutasiController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
})->name('login');
route::get('/register', function () {
    return view('auth.register');
})->name('register');
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Produk routes
    Route::resource('produk', ProdukController::class);

    // Lokasi routes
    Route::resource('lokasi', LokasiController::class);

    // Mutasi routes
    Route::resource('mutasi', MutasiController::class);


});

// require __DIR__.'/auth.php';
