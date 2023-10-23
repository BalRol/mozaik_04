<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserEventController;

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
    return view('login');
});

Route::get('/register', function () {
    return view('register');
});


Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::get('/profile', function () {
    return view('profile');
});

Route::get('/myevents', function () {
    return view('myevents');
});

Route::get('/event', function () {
    return view('event');
});


Route::match(['get'], '/login', [UserController::class, 'index']);

Route::match(['get'], '/logout', [UserController::class, 'logout']);

Route::match(['get'], '/user', [UserController::class, 'show']);

Route::match(['post'], '/user', [UserController::class, 'create']);

Route::match(['put'], '/user', [UserController::class, 'update']);

Route::match(['get'], '/allUser', [UserController::class, 'all']);



Route::match(['get'], '/event', [EventController::class, 'index']);

Route::match(['post'], '/event', [EventController::class, 'create']);

Route::match(['put'], '/event', [UserEventController::class, 'update']);

Route::match(['get'], '/myEventsAjax', [EventController::class, 'myEvents']);

Route::match(['get'], '/interestEventsAjax', [EventController::class, 'interestEvents']);

Route::match(['get'], '/editEvent', [EventController::class, 'setEvent']);

Route::match(['get'], '/editEventAjax', [EventController::class, 'getEvent']);

Route::match(['get'], '/delCookieEvent', [EventController::class, 'delCookieEvent']);

Route::match(['delete'], '/deleteEvent', [EventController::class, 'delete']);


Route::match(['get'], '/category', [CategoryController::class, 'index']);

