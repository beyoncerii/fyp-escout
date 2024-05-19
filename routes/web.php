<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\ProfileController;
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

//---------------------------------------------------------

/**
 * HOME ROUTES
 */

Route::get('/home', function(){
    return view('home');
})->name('home');

Route::get('/homeathlete', function(){
    return view('homeathlete');
})->name('homeathlete')
->middleware('auth:athlete');


Route::get('/homeadmin', function(){
    return view('homeadmin');
});

//---------------------------------------------------------

/**
 * AUTHENTICATION ROUTES
 */

 Route::get('/register', [RegisterController::class, 'index'])->name('register');
 Route::post('/register', [RegisterController::class, 'store'])->name('register-store');

 Route::get('/login', [LoginController::class, 'index'])->name('login');
 Route::post('/login', [LoginController::class, 'store'])->name('login-store');

 Route::post('/logout', [LogoutController::class, 'store'])->name('logout');

//  -------------------------------------------------------------------

/**
 * PROFILE ROUTES
 */

 Route::get('editprofile', [ProfileController::class, 'editprofile'])
 ->name('editprofile')
 ->middleware('auth:athlete');

Route::post('/editprofile/{id}', [ProfileController::class, 'updateprofile'])
 ->name('editprofile-store')
 ->middleware('auth:athlete');

//--------------------------------------------------------------------

/**
 * ATHLETE PROFILE ROUTES
 */

Route::get('createathlete', [ProfileController::class, 'createathlete'])
->name('createathlete')
->middleware('auth:athlete');

Route::get('/athleteprofile', [ProfileController::class, 'index'])
->name('athleteprofile')
->middleware('auth:athlete');

Route::post('storeathlete', [ProfileController::class, 'storeathlete'])
->name('store-athlete')
->middleware('auth:athlete');



//--------------------------------------------------------------------
