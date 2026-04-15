<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);


Route::get('/dashboard', function () {
    //return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');



require __DIR__.'/auth.php';

//Quỳnh Anh - chi tiết

Route::get('/san-pham/{id}', [HomeController::class, 'chiTietSanPham'])->name('sanpham.show');


