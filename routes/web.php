<?php

use App\http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\http\Controllers\ProductController;
use App\http\Controllers\CategoryController;
use App\http\Controllers\CategoryAjaxController;
use App\Http\Controllers\frontend\FrontendController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/',[FrontendController::class,'index']);

Route::get('/dashboard', function () {
    return view('backend.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



Route::prefix('admin')->middleware('auth')->group(function () {
    
    Route::resource('product',ProductController::class);
    Route::resource('category',CategoryController::class);
    Route::resource('category-ajax-crud', CategoryAjaxController::class);



});





require __DIR__.'/auth.php';
