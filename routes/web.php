<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\cms\ChoiceController;
use App\Http\Controllers\cms\MessageController;
use App\Http\Controllers\cms\DashboardController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



Route::prefix('auth')->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/check', [LoginController::class, 'check'])->name('auth.check');
});

Route::middleware('auth')->group(function () {
    Route::group(['middleware' => ['role:super_admin']], function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::prefix('message')->group(function () {
            Route::get('/', [MessageController::class, 'index'])->name('message.index');
            Route::get('/getById/{id}', [MessageController::class, 'edit'])->name('message.edit');
            Route::post('/create', [MessageController::class, 'create'])->name('message.create');
            Route::post('/update/{id}', [MessageController::class, 'update'])->name('message.update');
            Route::delete('/delete/{id}', [MessageController::class, 'delete']);
        });
        
        Route::prefix('choice')->group(function () {
            Route::get('/', [ChoiceController::class, 'index'])->name('choice.index');
        });

    });
});

