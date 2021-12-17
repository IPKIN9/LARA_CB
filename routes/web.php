<?php

use App\Http\Controllers\cms\ChoiceController;
use App\Http\Controllers\cms\MessageController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('cms/dashboard');
});

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
