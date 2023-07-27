<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\SuperAdminController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});


// Authentication Routes
//Route::post('register', [AuthController::class, 'register']);
//Route::post('login', [AuthController::class, 'login']);
//Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:api');

// Other API routes for Grounds and Time Slots can be added here

Route::group(['prefix'=>'super-admin','middleware'=>['auth:api']],function (){
    // Add your SuperAdmin-specific routes here
    // All routes in this group will be prefixed with '/super-admin' and require authentication for SuperAdmin role.

// Define your SuperAdmin-specific endpoints here
// For example, if you want to manage users, you can add routes like:

// Get all users
    Route::get('/users', [SuperAdminController::class,'indexAdmins']); //done

// Get a specific user by ID
    Route::get('/users/{id}', [SuperAdminController::class,'showAdmin']); //done

// Update a user by ID
    Route::post('/users/{id}',[SuperAdminController::class,'update']); //milako xina

// Delete a user by ID
    Route::delete('/users/{id}', [SuperAdminController::class,'destroy']);

});
// Routes for Admin
Route::group(['prefix' => 'admin', 'middleware' => ['auth:api']], function () {
    // Grounds CRUD routes
    Route::apiResource('grounds', AdminController::class);

    // Add other Admin-specific routes here
    // All routes in this group will be prefixed with '/admin' and require authentication for Admin role.

// Grounds CRUD routes

//// Get all grounds
//    Route::get('/grounds', 'AdminController@index');
//
//// Create a new ground
//    Route::post('/grounds', 'AdminController@store');
//
//// Get a specific ground by ID
//    Route::get('/grounds/{id}', 'AdminController@show');
//
//// Update a ground by ID
//    Route::put('/grounds/{id}', 'AdminController@update');
//
//// Delete a ground by ID
//    Route::delete('/grounds/{id}', 'AdminController@destroy');
//
//// Add other Admin-specific routes here if needed

});

// Routes for Customer
Route::group(['prefix' => 'customer', 'middleware' => ['auth:api']], function () {
    // Booking routes
    Route::apiResource('bookings', CustomerController::class);

    // Add other Customer-specific routes here

    // All routes in this group will be prefixed with '/customer' and require authentication for Customer role.

// Booking routes

// Get all bookings
    Route::get('/bookings', 'CustomerController@index');

// Create a new booking
    Route::post('/bookings', 'CustomerController@store');

// Get a specific booking by ID
    Route::get('/bookings/{id}', 'CustomerController@show');

// Update a booking by ID
    Route::put('/bookings/{id}', 'CustomerController@update');

// Delete a booking by ID
    Route::delete('/bookings/{id}', 'CustomerController@destroy');

// Add other Customer-specific routes here if needed

});



// SuperAdmin Registration
Route::post('/register', [AuthController::class,'registerSuperAdmin']);
// User Authentication
Route::post('/login', [AuthController::class,'login']);
//php artisan make:controller AuthController

