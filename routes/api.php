<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\VisitedCountryController;
use App\Http\Controllers\StatisticsController;
use App\Http\Controllers\AdministratorController;

// Routage des users
Route::get('/users', [UserController::class, 'index']);
Route::get('/users/{id}', [UserController::class, 'show']);
Route::delete('/users/{id}', [UserController::class, 'destroy']);
Route::put('/updateUser/{id}', [UserController::class, 'update']);
Route::post('/addUser', [UserController::class, 'store']);

// Routage country
Route::get('/countries', [CountryController::class, 'index']);
Route::get('/countries/{id}', [CountryController::class, 'show']);
Route::post('/addCountry', [CountryController::class, 'store']);
Route::put('/updateCountry/{id}', [CountryController::class, 'update']);

// Routage visited country
Route::get('/visitedCountry', [VisitedCountryController::class, 'index']);

// Routage statistics
Route::get('/statistics', [StatisticsController::class, 'index']);

// Routage Administrators
Route::get('/administrators', [AdministratorController::class, 'index']);
