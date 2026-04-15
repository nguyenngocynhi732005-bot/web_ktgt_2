<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;


Route::get('/dashboard', function () {
    //return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');



require __DIR__ . '/auth.php';

//Ngọc An
Route::get('/', [HomeController::class, 'index']);
Route::get('/loaicay', [HomeController::class, 'index']);
Route::get('/loaicay/{id}', [HomeController::class, 'product']);
Route::get('/loaicay/{id}/{sort}', [HomeController::class, 'product']);
