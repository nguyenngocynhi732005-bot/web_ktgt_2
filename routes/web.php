<?php

use App\Http\Controllers\HomeController;


use App\Http\Controllers\ProductController;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SanPhamController;



use App\Http\Controllers\ProfileController;

use App\Http\Controllers\ManagementTreesController;



Route::get('/', [HomeController::class, 'index']);



//PANH

Route::get('/timkiem', [HomeController::class, 'search'])->name('timkiem');

Route::get('/sanpham', 'App\Http\Controllers\SanPhamController@create')->name('quanlysanpham');
Route::get('/sanpham/create','App\Http\Controllers\SanPhamController@create')->name("sanpham.create");
Route::post('/sanpham/save/{action}','App\Http\Controllers\SanPhamController@save')->name("sanpham.save");


Route::get('/dashboard', function () {
    //return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


//Ngân
Route::middleware('auth')->group(function () {
    Route::get('/caycanh_list', [ManagementTreesController::class, 'index'])->name('caycanh.index');
    Route::get('/caycanh_list/{id}', [ManagementTreesController::class, 'show'])->name('caycanh.show');
    Route::delete('/caycanh_list/{id}', [ManagementTreesController::class, 'destroy'])->name('caycanh.destroy');
});

    //Nhi
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get('/gio-hang', [ProductController::class, 'order'])->name('cart.order');
Route::post('/cart/delete', [ProductController::class, 'cartdelete'])->name('cartdelete');
Route::post('/order/create', [ProductController::class, 'ordercreate'])
->middleware('auth')->name('ordercreate');

Route::get('/testemail','App\Http\Controllers\ProfileController@testemail');



// Ngọc An - Product routes

Route::get('/', [HomeController::class, 'index']);
Route::get('/loaicay', [HomeController::class, 'index']);
Route::get('/loaicay/{id}', [HomeController::class, 'product']);
Route::get('/loaicay/{id}/{sort}', [HomeController::class, 'product']);

// Quỳnh Anh - Product detail routes
Route::get('/sanpham/{id}', [ProductController::class, 'detail']);
Route::post('/gio-hang/them', [ProductController::class, 'addToCart']);

require __DIR__ . '/auth.php';
