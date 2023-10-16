<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;

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

Route::match(['post', 'put'], '/registerAjax', [UserController::class, 'create']);

Route::match(['post', 'put'], '/loginAjax', [UserController::class, 'index']);

Route::match(['get'], '/profileShowAjax', [UserController::class, 'show']);

Route::match(['post', 'put'], '/profileAjax', [UserController::class, 'update']);

Route::get('/logout', [UserController::class, 'logout']);

Route::get('/allUserAjax', [UserController::class, 'all']);

Route::get('/categoryAjax', [CategoryController::class, 'index']);

Route::match(['post', 'put'], '/createEvent', [EventController::class, 'create']);

