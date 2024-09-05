<?php

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TransportPriceController;

Route::post('/transport-price', [TransportPriceController::class, 'getVehicleTypeAndPriceList'])->middleware('auth.basic')->name('transport.price');
