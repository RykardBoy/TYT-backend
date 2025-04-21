<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\VisitedCountryController;
use App\Http\Controllers\StatisticsController;
use App\Http\Controllers\AdministratorController;
use App\Services\VisitedCountryService;

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
Route::delete('deleteCountry/{id}', [CountryController::class, 'destroy']);

// Routage visited country
Route::get('/visitedCountry', [VisitedCountryController::class, 'index']);
Route::get('/visitedCountry/{id}', [VisitedCountryController::class, 'show']);
// Route::post('/addSouvenir', [VisitedCountryController::class, 'store']); --> REVOIR LORSQUE TOUTES LES FONCTIONS SANS AUTH FINI.

// Routage statistics
Route::get('/statistics', [StatisticsController::class, 'index']);
Route::post('/addStatistics', [StatisticsController::class, 'store']);
Route::delete('/deleteStatistics/{id}',[StatisticsController::class, 'destroy']);
Route::put('/updateStatistics/{id}', [StatisticsController::class, 'update']);
// Routage Administrators
Route::get('/administrators', [AdministratorController::class, 'index']);
