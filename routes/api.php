<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProdukController;
use App\Http\Controllers\Api\LokasiController;
use App\Http\Controllers\Api\MutasiController;
use App\Http\Controllers\Api\ProdukLokasiController;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Public authentication routes
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/register', [AuthController::class, 'register'])->name('register');
// Authenticated routes

Route::get('/test-token', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function () {



    Route::post('/me', [AuthController::class, 'me'])->name('me');
    Route::get('/produk', [AuthController::class, 'produk'])->name('produk.index');


    // Authentication routes
    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);

    // Product routes
    Route::apiResource('produk', ProdukController::class);

    // Route::post('/addProduk', [ProdukController::class, 'store']);
    Route::get('produk/{produk}/mutasi', [ProdukController::class, 'mutasiHistory']);

    // Location routes
    Route::apiResource('lokasi', LokasiController::class);

    // Stock movement routes
    Route::apiResource('mutasi', MutasiController::class);
    Route::get('mutasi/user/history', [MutasiController::class, 'userHistory']);

    // Product-Location relationship routes
    Route::apiResource('produk-lokasi', ProdukLokasiController::class);
});
