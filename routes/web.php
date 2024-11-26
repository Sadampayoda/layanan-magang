<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\BiodataController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MagangController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserMagangController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::middleware('guest')->group( function () {
    Route::controller(AuthenticationController::class)->group(function(){
        Route::get('/login','loginPage')->name('login');
        Route::get('/register','RegisterPage')->name('register');
        Route::post('/login','loginAuthentication')->name('login.authentication');
        Route::post('/register','registerAuthentication')->name('register.authentication');
    });
});


Route::middleware('auth')->group(function(){
    Route::controller(DashboardController::class)->group(function(){
        Route::get('/','index')->name('dashboard');
        Route::put('/magang/{id}/status','updateStatus')->name('magang.status');
        Route::post('/logout','logout')->name('logout');
    });
    Route::resource('users',UserController::class)
    ->except(['create','show','edit']);
    Route::resource('magang',MagangController::class)
    ->except(['create','show','edit']);
    Route::resource('kegiatan',UserMagangController::class)
    ->except(['create','show','edit']);
    Route::resource('biodata',BiodataController::class)
    ->except(['create','show','edit']);


});
