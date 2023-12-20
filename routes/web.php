<?php

use Illuminate\Support\Facades\Route;
use App\Models\City;
use App\Http\Controllers\CityController;

Route::get('/', [CityController::class, 'index']);

Route::get('cities', [CityController::class,'cities']);

Route::get('/cities/{city}', [CityController::class,'city']);

