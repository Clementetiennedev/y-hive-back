<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('user', [AuthController::class, 'me']);
    Route::post('logout', [AuthController::class, 'logout']);
});

// Route::prefix('user')
//         ->controller(UserController::class)
//         ->name('user.')
//         ->group(function () {
//             Route::post('register', 'register')->name('register');
//             Route::post('edit', 'update')->name('update');
//             Route::get('me', 'show')->name('show');
//             Route::get('logout', 'logout')->name('logout');
//             Route::post('login', 'login')->name('login');
//         });
