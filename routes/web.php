<?php

use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Backend\PostCategoryController;
use App\Http\Controllers\Backend\PostController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Add additional routes as needed

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


    // Post Category
    Route::resource('/post-category', PostCategoryController::class);
    Route::post('upload', [PostCategoryController::class, 'upload'])->name('upload');
    Route::delete('revert', [PostCategoryController::class, 'revert'])->name('revert');
    Route::get('/load/{filename}', [PostCatgeoryController::class, 'load'])->name('load');
    Route::get('/fetch/{filename}', [PostCategoryController::class, 'fetch'])->name('fetch');
    Route::patch('/post-category/update-status/{id}', [PostCategoryController::class, 'updateStatus'])->name('post-category.update-status');
    // post
    Route::patch('/post/update-status/{id}', [PostController::class, 'updateStatus'])->name('post.update-status');
    Route::resource('/post', PostController::class);
    Route::resource('/users', AdminUserController::class);
    Route::get('/admin/users/export-pdf', [AdminUserController::class, 'exportPDF'])->name('users.export.pdf');

});

require __DIR__.'/auth.php';
