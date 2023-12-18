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

Route::get('/home', function () {
    return view('home');
});

Route::get('/register', [\App\Http\Controllers\UserController::class, 'showRegister']);
Route::post('/register', [\App\Http\Controllers\UserController::class, 'register']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [\App\Http\Controllers\UserController::class, 'profile'])->name('profile');

    Route::post('logout', [\App\Http\Controllers\UserController::class, 'logout'])->name('user.logout');
});
