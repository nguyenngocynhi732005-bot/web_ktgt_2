<?php

use App\Http\Controllers\HomeController;

use App\Http\Controllers\ProfileController;

use App\Http\Controllers\ManagementTreesController;

use Illuminate\Support\Facades\Route;


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



require __DIR__ . '/auth.php';

//Ngọc An
Route::get('/', [HomeController::class, 'index']);
Route::get('/loaicay', [HomeController::class, 'index']);
Route::get('/loaicay/{id}', [HomeController::class, 'product']);
Route::get('/loaicay/{id}/{sort}', [HomeController::class, 'product']);
