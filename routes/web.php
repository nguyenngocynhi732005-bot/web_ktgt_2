<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;


Route::get('/dashboard', function () {
    //return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Ngọc An - Product routes
Route::get('/', [HomeController::class, 'index']);
Route::get('/loaicay', [HomeController::class, 'index']);
Route::get('/loaicay/{id}', [HomeController::class, 'product']);
Route::get('/loaicay/{id}/{sort}', [HomeController::class, 'product']);

// Quỳnh Anh - Product detail routes
Route::get('/sanpham/{id}', [ProductController::class, 'detail']);
Route::post('/gio-hang/them', [ProductController::class, 'addToCart']);

require __DIR__ . '/auth.php';
