<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\RentController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\TrackController;

Route::get('/', function () {
    return view('auth.login');
});

Route::resource('vehicles', VehicleController::class);

Auth::routes();
Route::middleware(['auth'])->group(function () {
    Route::resource('vehicles', VehicleController::class);
});
Route::prefix('drivers')->middleware('auth')->group(function () {
    Route::get('/', [DriverController::class, 'index'])->name('drivers.index');
    Route::get('create', [DriverController::class, 'create'])->name('drivers.create');
    Route::get('{driver}', [DriverController::class, 'show'])->name('drivers.show');
    Route::post('store', [DriverController::class, 'store'])->name('drivers.store');
    Route::get('{driver}/edit', [DriverController::class, 'edit'])->name('drivers.edit');
    Route::put('{driver}', [DriverController::class, 'update'])->name('drivers.update');
    Route::put('{driver}/toggle', [DriverController::class, 'toggleStatus'])->name('drivers.toggleStatus');
    Route::get('/drivers/longest-routes', [DriverController::class, 'longestRoutes'])->name('drivers.longestroutes');
});

Route::prefix('rents')->middleware('auth')->group(function () {
    Route::get('/', [RentController::class, 'index'])->name('rents.index');
    Route::get('create', [RentController::class, 'create'])->name('rents.create');
    Route::post('store', [RentController::class, 'store'])->name('rents.store');
    Route::get('{rent}', [RentController::class, 'show'])->name('rents.show'); // Show route
    Route::get('{rent}/edit', [RentController::class, 'edit'])->name('rents.edit');
    Route::put('{rent}', [RentController::class, 'update'])->name('rents.update');
    Route::put('{rent}/complete', [RentController::class, 'complete'])->name('rents.complete'); // Complete rent route
    Route::put('{rent}/cancel', [RentController::class, 'cancel'])->name('rents.cancel');
    Route::get('rents/history', [RentController::class, 'history'])->name('rents.history');
    //Challenges
    Route::get('driver/history/{driver}', [RentController::class, 'driverHistory'])->name('rents.driverhistory');
    Route::get('driver/driverport', [RentController::class, 'driverReport'])->name('rents.driverport');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// web.php

Route::prefix('track')->middleware('auth')->group(function () {
    Route::get('/', [TrackController::class, 'index'])->name('track.index');
    Route::get('{rent}', [TrackController::class, 'show'])->name('track.show'); // Show route
});

Route::post('/drivers/{id}/location', [DriverController::class, 'updateLocation']);
Route::get('/drivers/locations', [DriverController::class, 'getLocations']);

Route::get('/track/coordinates/{rent}', [TrackController::class, 'fetchCoordinates']);

// Challenges 
Route::get('/emergency', [RentController::class, 'emergencyIndex'])->name('rents.emergency');


