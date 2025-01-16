<?php

use App\Http\Controllers\WeatherDeviceController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:api')->group(function ($route) {
    $route->get('/user', function () {
        return auth()->user();
    });

    $route->post('/weather/device/store', [WeatherDeviceController::class, 'store'])->name('device.store');
    $route->get('/weather/device/show/{id}', [WeatherDeviceController::class, 'show'])->name('device.show');
});
