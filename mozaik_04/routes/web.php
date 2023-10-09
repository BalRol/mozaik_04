<?php

use Illuminate\Support\Facades\Route;

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
<<<<<<< Updated upstream
=======

Route::get('/register', function () {
    return view('register');
});


Route::match(['post', 'put'], '/registerAjax', [UserController::class, 'create']);

Route::match(['post', 'put'], '/loginAjax', [UserController::class, 'index']);
>>>>>>> Stashed changes
