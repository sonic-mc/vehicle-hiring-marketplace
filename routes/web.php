<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VehicleController;

Route::resource('vehicles', VehicleController::class);
Route::get('/', [VehicleController::class, 'index']);
Route::get('/vehicles/{vehicle}', [VehicleController::class, 'show'])->name('vehicles.show');


Route::get('/', function () {
    return redirect()->route('vehicles.index');
})->name('home');

