<?php

use App\Http\Controllers\ApiaryController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HiveController;
use App\Http\Controllers\InterventionController;
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

    Route::prefix('apiary')
        ->controller(ApiaryController::class)
        ->name('apiary.')
        ->group(function () {
            Route::get('index', 'index')->name('index');
            Route::get('{apiary}', 'show')->name('show');
            Route::post('store', 'store')->name('store');
            Route::post('{apiary}/hive', 'storeHive')->name('store.hive');
            Route::post('{apiary}', 'update')->name('update');
            Route::delete('{apiary}', 'destroy')->name('destroy');
        });

    Route::prefix('hive')
        ->controller(HiveController::class)
        ->name('hive.')
        ->group(function () {
            Route::get('index', 'index')->name('index');
            Route::get('{hive}', 'show')->name('show');
            Route::post('{hive}', 'update')->name('update');
            Route::delete('{hive}', 'destroy')->name('destroy');
        });

    Route::prefix('intervention')
        ->controller(InterventionController::class)
        ->name('intervention.')
        ->group(function () {
            Route::get('index', 'index')->name('index');
            Route::get('{intervention}', 'show')->name('show');
            Route::post('store', 'store')->name('store');
            Route::post('{intervention}', 'update')->name('update');
            Route::delete('{intervention}', 'destroy')->name('destroy');
        });
});
