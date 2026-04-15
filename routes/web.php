<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ManagementTreesController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);


Route::get('/dashboard', function () {
    //return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
Route::middleware('auth')->group(function () {
    Route::get('/caycanh_list', [ManagementTreesController::class, 'index'])->name('caycanh.index');
    Route::get('/caycanh_list/{id}', [ManagementTreesController::class, 'show'])->name('caycanh.show');
    Route::delete('/caycanh_list/{id}', [ManagementTreesController::class, 'destroy'])->name('caycanh.destroy');
});



require __DIR__.'/auth.php';
