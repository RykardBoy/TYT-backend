<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\VisitedCountryController;
use App\Http\Controllers\StatisticsController;
use App\Http\Controllers\AdministratorController;
use App\Http\Controllers\AdminController; // used for permission and roles
use App\Http\Controllers\AuthController; // used for login and receive a token
use App\Models\Administrators;

// Routage pour le login
Route::post('/login', [AuthController::class, 'login']);

// Routage pour le logout (Dans middleware parce que seul un user logé peut se déco)
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);
// TEST
Route::group(['middleware' => ['can:add user']], function () {
    Route::post('/addUser', [UserController::class, 'store']);

});


Route::middleware('auth:sanctum')->group(function(){

    // Routage des users
    Route::get('/users', [UserController::class, 'index']);
    Route::get('/users/{id}', [UserController::class, 'show']);
    Route::delete('/users/{id}', [UserController::class, 'destroy']);
    Route::put('/updateUser/{id}', [UserController::class, 'update']);

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
    Route::get('/administrators/{id}', [AdministratorController::class, 'show']);
    Route::post('/addAdministrators', [AdministratorController::class, 'store']);
    Route::delete('/deleteAdministrators/{id}', [AdministratorController::class, 'destroy']);

    // Routage admin et permission (A CHANGER LORSQUE L'ASSIGNEMENT EST OK)
    Route::get('/admin/init', [AdminController::class, 'createRolesAndPermissions']);
    Route::post('admin/assignRole/{id}', [AdminController::class, 'assignRole']); 
    Route::post('/admin/assignPermission/{id}', [AdminController::class, 'assignPermission']);
});


