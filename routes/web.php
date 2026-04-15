<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SanPhamController;


Route::get('/', [HomeController::class, 'index']);

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



require __DIR__.'/auth.php';
