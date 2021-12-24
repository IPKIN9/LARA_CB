<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\cms\ChoiceController;
use App\Http\Controllers\cms\MessageController;
use App\Http\Controllers\cms\DashboardController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\cms\RoutingController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('bot.BodyChat');
})->name('chatbot.index');

Route::prefix('auth')->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/check', [LoginController::class, 'check'])->name('auth.check');
});

Route::middleware('auth')->group(function () {
    Route::group(['middleware' => ['role:super_admin']], function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

        Route::prefix('message')->group(function () {
            Route::get('/', [MessageController::class, 'index'])->name('message.index');
            Route::get('/getById/{id}', [MessageController::class, 'edit'])->name('message.edit');
            Route::post('/create', [MessageController::class, 'create'])->name('message.create');
            Route::post('/update/{id}', [MessageController::class, 'update'])->name('message.update');
            Route::delete('/delete/{id}', [MessageController::class, 'delete']);
        });
        
        Route::prefix('choice')->group(function () {
            Route::get('/', [ChoiceController::class, 'index'])->name('choice.index');
            Route::post('/create', [ChoiceController::class, 'create'])->name('choice.create');
            Route::get('/edit/{id}',  [ChoiceController::class, 'getChoice'])->name('choice.edit');
            Route::delete('/deletedetail/{id}', [ChoiceController::class, 'deleteDetail']);
            Route::post('/update/{id}', [ChoiceController::class, 'updateChoice'])->name('choice.update');
            Route::delete('/delete/{id}', [ChoiceController::class, 'delete']);
        });
        
        Route::prefix('routing')->group(function () {
            Route::get('/', [RoutingController::class, 'index'])->name('routing.index');
            Route::post('/create', [RoutingController::class, 'create'])->name('routing.create');
            Route::delete('/delete/{id}', [RoutingController::class, 'delete']);
        });

    });

});

