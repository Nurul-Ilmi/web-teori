<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/products', [ProductController::class, 'index']);       // 1. Tampilkan semua data
Route::post('/products', [ProductController::class, 'store']);     // 2. Tambah data (ada validasi & service)
Route::put('/products/{id}', [ProductController::class, 'update']); // 3. Ubah data berdasarkan ID
Route::delete('/products/{id}', [ProductController::class, 'destroy']); // 4. Hapus data berdasarkan ID
Route::get('/products/{id}', [ProductController::class, 'show']);
