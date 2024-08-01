<?php

use App\Http\Controllers\WebAuthController;
use App\Http\Controllers\WebToDoController;
use Illuminate\Support\Facades\Route;

Route::get('/', [WebAuthController::class, 'login']);
Route::post('/ceklogin', [WebAuthController::class, 'ceklogin']);
Route::get('/logout', [WebAuthController::class, 'logout']);
Route::get('/register', [WebAuthController::class, 'register']);
Route::post('/registered', [WebAuthController::class, 'registered']);

Route::prefix("todo")->group(function () {
    Route::get('create', [WebToDoController::class, 'create'])->name('todo.create');
    Route::post('store', [WebToDoController::class, 'store'])->name('todo.store');
    Route::get('/', [WebToDoController::class, 'index'])->name('todo.index');
    Route::get('edit/{id}', [WebToDoController::class, 'edit'])->name('todo.edit');
    Route::post('update/{id}', [WebToDoController::class, 'update'])->name('todo.update');
    Route::delete('destroy/{id}', [WebToDoController::class, 'destroy'])->name('todo.destroy');
});
