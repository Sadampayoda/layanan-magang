<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::controller(AuthenticationController::class)->group(function(){
    Route::get('/','loginPage')->name('login');
    Route::get('/register','RegisterPage')->name('register');
    Route::post('/','loginAuthentication')->name('login.authentication');
    Route::post('/regiter','registerAuthentication')->name('login.authentication');
});


Route::controller(DashboardController::class)->group(function(){
    Route::get('/dashboard','index')->name('dashboard');
});
Route::controller(UserController::class)->group(function(){
    Route::get('/profile/form','form')->name('profile.form');
});
