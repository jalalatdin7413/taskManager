<?php

namespace App\Routes\v1;

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Task\TaskController;
use Illuminate\Support\Facades\Route;

Route::pattern('id', '\d+');

Route::prefix('auth')->middleware('guest:sanctum')->group(function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('tasks')->group(function () {
        Route::post('create', [TaskController::class, 'create']);
        Route::get('/', [TaskController::class, 'index']);
        Route::get('show/{id}', [TaskController::class, 'show']);
        Route::put('update/{id}', [TaskController::class, 'update']);
        Route::delete('delete/{id}', [TaskController::class, 'delete']);
    });

    Route::prefix('auth')->group(function () {
        Route::post('logout', [AuthController::class, 'logout']);
    });
});
// Route::prefix('tasks')->group(function () {
//     Route::post('create', [TaskController::class, 'create']);
//     Route::get('/', [TaskController::class, 'index']);
//     Route::get('show/{id}', [TaskController::class, 'show']);
//     Route::put('update/{id}', [TaskController::class, 'update']);
//     Route::delete('delete/{id}', [TaskController::class, 'delete']);
// });