<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VehicleController;
use Illuminate\Support\Facades\Notification;
use App\Notifications\SlackAlert;

Route::resource('vehicles', VehicleController::class);
Route::get('/', [VehicleController::class, 'index']);
Route::get('/vehicles/{vehicle}', [VehicleController::class, 'show'])->name('vehicles.show');
Route::get('/vehicles', [VehicleController::class, 'index'])->name('vehicles.index');



Route::get('/', function () {
    return redirect()->route('vehicles.index');
})->name('home');




Route::get('/test-slack', function () {
    Notification::route('slack', config('services.slack.webhook_url'))
        ->notify(new SlackAlert('🚨 Slack test from Laravel!'));

    return 'Slack notification sent!';
});
