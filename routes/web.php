<?php

use App\Mail\AthleteApproved;
use App\Mail\AthleteRejected;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ScoutController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\SmsTwilioController;
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
    return view('home');
})->name('home');

Route::get('/applayout', function () {
    return view('applayout');
})->middleware(['auth']);

Route::get('test', function () {
    return view('test');
})->name('test');


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
})->name('homeadmin')
->middleware('auth:staff');

Route::get('/homecoach', function(){
    return view('homecoach');
})->name('homecoach')
->middleware('auth:staff');

Route::get('listathletes', [ProfileController::class, 'viewAthletes'])
->name('listathletes');

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
 ->name('editprofileathlete-store')
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

Route::get('editathlete', [ProfileController::class, 'editathlete'])
->name('editathlete')
->middleware('auth:athlete');

Route::post('/athlete/update/{id}', [ProfileController::class, 'updateathlete'])
->name('update-athlete')
->middleware('auth:athlete');



//--------------------------------------------------------------------


/**
 * COACH PROFILE ROUTES
 */


Route::get('/listscouted', [ScoutController::class, 'listscouted'])
->name('listscouted')
->middleware('auth:staff');

Route::post('/coach/scout', [ScoutController::class, 'store'])
->name('coach-scout');

Route::get('editstaff', [ProfileController::class, 'editstaff'])
->name('editstaff')
->middleware('auth:staff');

Route::post('/staff/update/{id}', [ProfileController::class, 'updateStaff'])
->name('editprofile-store')
->middleware('auth:staff');




//--------------------------------------------------------------------

/**
 * ADMIN ROUTES
 */

 Route::get('/viewrequest', [ProfileController::class, 'viewrequest'])
->name('viewrequest')
->middleware('auth:staff');

Route::post('/acceptathlete/{id}', [ProfileController::class, 'acceptAthlete'])
->name('acceptathlete')
->middleware('auth:staff');

Route::post('/rejectathlete/{id}', [ProfileController::class, 'rejectAthlete'])
->name('rejectathlete')
->middleware('auth:staff');

Route::delete('/athlete/{id}', [ProfileController::class, 'destroy'])->name('delete-athlete');

Route::get('dashboard', function(){
    return view('dashboard');
})->name('dashboard');


//--------------------------------------------------------------------


Route::group(['middleware' => ['checkrole']], function () {
    Route::get('demo/{id}', [ProfileController::class, 'athleteprofiledemo'])
->name('demo');
});


Route::get('test', [ProfileController::class, 'testCreate'])
->name('test')
->middleware('auth:athlete');


Route::get('test2', function(){
    return view('test2');
})->name('test2');

Route::get('/calendar', function () {
    return view('calendar');
})->name('calendar');

Route::get('/createevent', function () {
    return view('createevent');
})->name('createevent');

//--------------------------------------------------------------------


/**
 * SCHEDULE ROUTES
 */

 Route::get('schedule/create', [ScheduleController::class, 'create'])
 ->name('schedule.create')
 ->middleware('auth:athlete');

 Route::post('schedule', [ScheduleController::class, 'store'])
 ->name('schedule.store')
 ->middleware('auth:athlete');

 Route::get('viewschedule', [ScheduleController::class, 'show'])
 ->name('schedule.show')
 ->middleware('auth:athlete');

  Route::get('athlete/{id}/viewschedule', [ScheduleController::class, 'showSchedule'])
  ->name('viewschedule');


//--------------------------------------------------------------------


/**
 * EVENT ROUTES
 */

//  Route::get('events/create', [EventController::class, 'create'])->name('createeevent');

 Route::get('createevent', [EventController::class, 'create'])->name('event.create');

 Route::post('/events', [EventController::class, 'store'])->name('events.store');

 Route::get('viewevent', [EventController::class, 'index'])
 ->name('viewevent');

 Route::get('events/{id}/editevent', [EventController::class, 'edit'])
 ->name('events.edit');

 Route::put('events/{id}', [EventController::class, 'update'])
 ->name('events.update');

 Route::get('viewevents', [EventController::class, 'index'])->name('viewevents');

 Route::get('events/{event}/view', [EventController::class, 'view'])->name('events.view');

 Route::post('/events/{event}/pickAthletes', [EventController::class, 'pickAthletes'])->name('events.pickAthletes');



//--------------------------------------------------------------------

 Route::get('/activities', [ActivityController::class, 'index'])->name('activities.index');

 Route::post('/activities/{id}/accept', [ActivityController::class, 'accept'])->name('activities.accept');

 Route::post('/activities/{id}/reject', [ActivityController::class, 'reject'])->name('activities.reject');


