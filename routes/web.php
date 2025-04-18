<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\VisitedCountryController;
use App\Http\Controllers\StatisticsController;
use App\Http\Controllers\AdministratorController;
use Illuminate\Support\Facades\Route;

/* NO USAGE ANYMORE DO NOT TAKE INTO CONSIDERATION PLS */



Route::get('/', function () {
    return view('welcome');
});
// Routage users
Route::get('/users', [UserController::class, 'index']);
Route::get('/users/{id}', [UserController::class, 'show']);
Route::delete('/usersDel/{id}', [UserController::class], 'destroy');


// Routage country
Route::get('/countries', [CountryController::class, 'index']);
Route::get('/countries/{id}', [CountryController::class, 'show']);

// Routage visited country
Route::get('/visitedCountry', [VisitedCountryController::class, 'index']);

// Routage statistics
Route::get('/statistics', [StatisticsController::class, 'index']);

// Routage Administrators
Route::get('/administrators', [AdministratorController::class, 'index']);