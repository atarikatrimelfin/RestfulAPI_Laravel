<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ToDoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::group([
    "middleware" => ["auth:sanctum"]
], function(){
    Route::get("index", [ToDoController::class, 'index']);
    Route::post("create", [ToDoController::class, 'create']);
    Route::put("update/{id}", [ToDoController::class, 'update']);
    Route::delete("destroy/{id}", [ToDoController::class, 'destroy']);
});