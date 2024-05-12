<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/applayout', function () {
    return view('applayout');
});

Route::get('/home', function(){
    return view('home');
});

Route::get('/homeathlete', function(){
    return view('homeathlete');
});

Route::get('/homeadmin', function(){
    return view('homeadmin');
});

Route::get('/editprofile', function(){
    return view('editprofile');
});

/**
 * AUTHENTICATION ROUTES
 */

 Route::get('/register', [RegisterController::class, 'index'])->name('register');
 Route::post('/register', [RegisterController::class, 'store'])->name('register-store');

 Route::get('/login', [LoginController::class, 'index'])->name('login');
 Route::post('/login', [LoginController::class, 'store'])->name('login-store');

    Route::post('/logout', [LogoutController::class, 'store'])->name('logout');

//  -------------------------------------------------------------------
