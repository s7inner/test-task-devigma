<?php

use App\Http\Controllers\Api\CancelBookingController;
use App\Http\Controllers\Api\CreateBookingController;
use App\Http\Controllers\Api\GetUserBookingsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('bookings')
    ->middleware('auth:sanctum')
    ->group(function () {
        Route::get('/', GetUserBookingsController::class)->name('bookings.index');
        Route::post('/', CreateBookingController::class)->name('bookings.store');
        Route::patch('/{id}/cancel', CancelBookingController::class)->name('bookings.cancel');
    });
