<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;

//Modified
use App\Http\Controllers\DriverController;
use App\Http\Controllers\RentController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function () {
    Route::resource('drivers', DriverController::class);
});

//React Native Application(Driver Side)
Route::post('driver/login', [DriverController::class, 'login']);
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/driver/profile', [DriverController::class, 'profile']); // Get the authenticated driver's profile
    Route::get('/drivers', [DriverController::class, 'index']); // Get all drivers (for the mobile application)
    Route::get('/drivers/{driver}', [DriverController::class, 'show']); // Get a specific driver's profile
    Route::post('/driver/logout', [DriverController::class, 'logout']); // Logout the driver
    Route::put('/driver/update-location/{id}', [DriverController::class, 'updateLocation']); // Update driver's location
});

Route::post('/rents/update-location/{id}', [RentController::class, 'updateLocation']);
Route::post('/rents/emergency/{id}', [RentController::class, 'emergency']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/rents/fetch', [RentController::class, 'fetchRents']);
});

// Route::middleware('auth:api')->get('/driver/show', [DriverController::class, 'show']);
Route::middleware('auth:sanctum')->get('/driver/profile', [DriverController::class, 'profile']);
