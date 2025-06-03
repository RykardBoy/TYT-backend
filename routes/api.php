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
use App\Http\Controllers\TestController;
use App\Models\VisitedCountry;

// Routage pour le login et register
Route::post('/login', [AuthController::class, 'login']);
Route::post('/registerUser', [UserController::class, 'registerUser']);

// Routage pour le logout (Dans middleware parce que seul un user logé peut se déco)
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);

// TEST du routage selon permission et role (Voir encore à quel point je décortique)
Route::group(['middleware' => ['can:add user']], function () {
    
    // Routage des users (POUR ADMIN)
    

    // Routage des countries (POUR ADMIN)

    // Routage des statistiques (POUR ADMIN)
    Route::delete('/deleteStatistics/{id}',[StatisticsController::class, 'destroy']);
    Route::put('/updateStatistics/{id}', [StatisticsController::class, 'update']);

    // Routage des administrators (POUR ADMIN)
    Route::get('/administrators', [AdministratorController::class, 'index']);
    Route::get('/administrators/{id}', [AdministratorController::class, 'show']);
    Route::post('/addAdministrators', [AdministratorController::class, 'store']);
    
    Route::delete('/deleteAdministrators/{id}', [AdministratorController::class, 'destroy']);

    // Routage admin et permission (A CHANGER LORSQUE L'ASSIGNEMENT EST OK)
    Route::get('/admin/init', [AdminController::class, 'createRolesAndPermissions']);
    Route::post('admin/assignRole/{id}', [AdminController::class, 'assignRole']); 
    Route::post('/admin/assignPermission/{id}', [AdminController::class, 'assignPermission']);
});


// Routage pour tous les utilisateurs (normaux ou admin)
Route::middleware('auth:sanctum')->group(function(){

    Route::post('/addStatistics', [StatisticsController::class, 'store']);


    // Routage des users
    Route::get('/users', [UserController::class, 'index']);
    Route::get('/users/{id}', [UserController::class, 'show']);

    // Routage country
    Route::get('/countries', [CountryController::class, 'index']);
    Route::get('/countries/{id}', [CountryController::class, 'show']);    

    // Routage statistics
    // Route::get('/statistics', [StatisticsController::class, 'index']);
    Route::get('/statistics', [StatisticsController::class, 'showStatistics']);

    
    // Routage des souvenirs
    Route::get('/souvenirs', [VisitedCountryController::class, 'index']);
    Route::get('/souvenirs/{id}', [VisitedCountryController::class, 'show']);
    Route::post('/addSouvenir', [VisitedCountryController::class, 'addSouvenir']);
    Route::get('/getImages', [VisitedCountryController::class, 'getImages']);
    
    Route::get('/test', [TestController::class, 'test']);

    Route::delete('/users/{id}', [UserController::class, 'destroy']);
    Route::post('/addUser', [UserController::class, 'store']);
    Route::get('/countUsers', [UserController::class, 'countUsers']);
    Route::put('/updateUser/{id}', [UserController::class, 'update']);

    Route::get('searchUsers', [UserController::class, 'search']);


    Route::post('/addCountry', [CountryController::class, 'store']);

    Route::put('/updateCountry/{id}', [CountryController::class, 'update']);
    Route::delete('/deleteCountry/{id}', [CountryController::class, 'destroy']);

    Route::get('/sumDays', [StatisticsController::class, 'sumDays']);
    Route::get('/frequent-country', [StatisticsController::class, 'frequentCountry']);
    Route::get('/frequentUserCountry', [StatisticsController::class, 'mostFrequentUserCountry']);
    Route::get('/favorite-country/{id}', [StatisticsController::class, 'favoriteCountryByUser']);
    Route::get('/countryKmTravelled/{id}', [StatisticsController::class, 'countriesKmTravelled']);
    Route::get('/countUserPhotos/{id}', [StatisticsController::class, 'countUserPhotos']);

    
});
 

