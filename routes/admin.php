<?php

use DirectsoftRo\LaravelBootstrapAdmin\Http\Controllers\Auth\LoginController;
use DirectsoftRo\LaravelBootstrapAdmin\Http\Controllers\Auth\PasswordController;
use DirectsoftRo\LaravelBootstrapAdmin\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'admin.guest'], function () {
    Route::get('auth/login', [LoginController::class, 'login'])->name('auth.login');
    Route::post('auth/login', [LoginController::class, 'store']);

    // Auth password
    Route::get('auth/forgot-password', [PasswordController::class, 'request'])->name('auth.password.request');
    Route::post('auth/forgot-password', [PasswordController::class, 'email'])->name('auth.password.email');
    Route::get('auth/reset-password/{token}', [PasswordController::class, 'reset'])->name('auth.password.reset');
    Route::post('auth/reset-password', [PasswordController::class, 'update'])->name('auth.password.update');
});

Route::group(['middleware' => 'admin.auth'], function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::post('auth/logout', [LoginController::class, 'logout'])->name('auth.logout');

    // Admin API
    Route::group(['prefix' => 'api', 'as' => 'api.'], function () {
        //
    });
});
