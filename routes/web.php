<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SanPhamController;



Route::get('/', [HomeController::class, 'index']);


//PANH

Route::get('/timkiem', [HomeController::class, 'search'])->name('timkiem');

Route::get('/sanpham', 'App\Http\Controllers\SanPhamController@create')->name('quanlysanpham');
Route::get('/sanpham/create','App\Http\Controllers\SanPhamController@create')->name("sanpham.create");
Route::post('/sanpham/save/{action}','App\Http\Controllers\SanPhamController@save')->name("sanpham.save");



Route::get('/dashboard', function () {
    //return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');



require __DIR__ . '/auth.php';

//Ngọc An
Route::get('/', [HomeController::class, 'index']);
Route::get('/loaicay', [HomeController::class, 'index']);
Route::get('/loaicay/{id}', [HomeController::class, 'product']);
Route::get('/loaicay/{id}/{sort}', [HomeController::class, 'product']);
