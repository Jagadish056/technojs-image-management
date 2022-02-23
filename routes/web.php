<?php

use App\Http\Controllers\Auth\UserAuthenticateController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\User\ImageController;
use Illuminate\Support\Facades\Route;

Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index')->name('home');
    Route::get('/optimize', 'optimize')->name('optimize');
    Route::get('/optimize/clear', 'optimize_clear')->name('optimize_clear');
});

Route::middleware(['guest'])->group(function () {
    Route::view('/login', 'auth.login')->name('login');
    Route::post('/login', [UserAuthenticateController::class, 'login']);
});

Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [UserAuthenticateController::class, 'logout'])->name('logout');
    Route::middleware(['must_verify_email', 'can:create,App\Models\Image'])->group(function () {
        Route::resource('/image', ImageController::class)->except(['show', 'edit', 'update']);
    });
});
