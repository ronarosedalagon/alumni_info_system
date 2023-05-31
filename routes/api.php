<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use  App\Http\Controllers\UserController;
use  App\Http\Controllers\JobController;
use  App\Http\Controllers\AlumniController;



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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register',[UserController::class,'register']);


Route::post('/login',[UserController::class,'login']);

Route::post('/logout',[UserController::class,'logout']);

Route::post('/dashboard',[UserController::class,'dashboard']);
Route::post('/alumnidashboard',[UserController::class,'alumnidashboard']);
Route::post('/dashboardprofile',[UserController::class,'dashboard_profile']);
Route::post('/data',[UserController::class,'getUserData']);
// Route::get('/show', [UserController::class,'show']);
Route::get('/show', 'YourController@show');

//add a job
Route::post('/addjob',[UserController::class,'addjob']);



//view jobs
Route::get('/job-listings', [JobController::class,'index']);
Route::get('/view-job-listings', [JobController::class,'userIndex']);
//view alumni
Route::get('/alumni-listings', [AlumniController::class,'index']);
//view gallery
Route::get('/images', [AlumniController::class,'index']);


//update user details
Route::post('/updateUser', [UserController::class, 'updateUserDetails']);
// Route::post('/updateUser',[UserController::class,'updateUser'])
// Route::put('/updateUser/{id}', [UserController::class,'updateUser']);






//admin
//jobs status requests
Route::put('/job-listings/approve/{id}', [JobController::class, 'approveJob']);
Route::put('/job-listings/decline/{id}', [JobController::class, 'declineJob']);











