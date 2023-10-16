<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\UserController;

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


Route::match(['post', 'put'], '/registerAjax', [UserController::class, 'create']);

Route::match(['post', 'put'], '/loginAjax', [UserController::class, 'index']);

Route::match(['get'], '/profileShowAjax', [UserController::class, 'show']);

Route::match(['post', 'put'], '/profileAjax', [UserController::class, 'update']);
