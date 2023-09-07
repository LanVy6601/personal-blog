<?php

use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\TagController;
use Illuminate\Support\Facades\Route;

Route::get('login', [LoginController::class, 'loginForm'])->middleware('guest:admin')->name('admin.login.get');
Route::post('login', [LoginController::class, 'login'])->name('admin.login.post');
Route::post('logout', [LoginController::class, 'logout'])->name('admin.logout');

Route::middleware('auth:admin')->as('admin.')->group(function () {
    
    Route::resource('article', ArticleController::class);
    Route::resource('category', CategoryController::class);
    Route::resource('tag', TagController::class);
});
