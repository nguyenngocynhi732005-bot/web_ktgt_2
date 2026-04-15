<?php

use App\Http\Controllers\HomeController;
<<<<<<< HEAD

=======
use App\Http\Controllers\ProductController;
>>>>>>> remotes/origin/NgocAn
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SanPhamController;


use App\Http\Controllers\ProfileController;

use App\Http\Controllers\ManagementTreesController;


//PANH
// Trang quản lý sản phẩm tạm thời trỏ về trang thêm sản phẩm cho đến khi có trang danh sách riêng
Route::get('/sanpham', 'App\Http\Controllers\SanPhamController@create')->name('quanlysanpham');
// Route mở trang thêm sản phẩm
Route::get('/sanpham/create','App\Http\Controllers\SanPhamController@create')->name("sanpham.create");
// Route xử lý lưu sản phẩm vào database (truyền tham số action để biết là add hay edit)
Route::post('/sanpham/save/{action}','App\Http\Controllers\SanPhamController@save')->name("sanpham.save");




Route::get('/dashboard', function () {
    //return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

<<<<<<< HEAD
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



require __DIR__ . '/auth.php';

//Ngọc An
=======
// Ngọc An - Product routes
>>>>>>> remotes/origin/NgocAn
Route::get('/', [HomeController::class, 'index']);
Route::get('/loaicay', [HomeController::class, 'index']);
Route::get('/loaicay/{id}', [HomeController::class, 'product']);
Route::get('/loaicay/{id}/{sort}', [HomeController::class, 'product']);

// Quỳnh Anh - Product detail routes
Route::get('/sanpham/{id}', [ProductController::class, 'detail']);

require __DIR__ . '/auth.php';
