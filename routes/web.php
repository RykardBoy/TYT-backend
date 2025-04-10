<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\VisitedCountryController;
use App\Http\Controllers\StatisticsController;

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});
// Routage users
Route::get('/users', [UserController::class, 'index']);

// Routage country
Route::get('/countries', [CountryController::class, 'index']);
Route::get('/countries/{id}', [CountryController::class, 'show']);

// Routage visited country
Route::get('/visitedCountry', [VisitedCountryController::class, 'index']);

// Routage statistics
Route::get('/statistics', [StatisticsController::class, 'index']);