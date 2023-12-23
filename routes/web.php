<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatController;

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

Route::get('/register', [\App\Http\Controllers\UserController::class, 'showRegister'])->name('register');
Route::post('/register', [\App\Http\Controllers\UserController::class, 'register']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [\App\Http\Controllers\UserController::class, 'profile'])->name('profile');

    Route::post('logout', [\App\Http\Controllers\UserController::class, 'logout'])->name('user.logout');
});

Route::get('/login', [\App\Http\Controllers\UserController::class, 'showLogin']);

Route::post('/login', [\App\Http\Controllers\UserController::class, 'login'])->name('login');

Route::middleware('auth')->group(function () {
    Route::get('/users', [ChatController::class, 'users'])->name('user.index');
    Route::get('/chat/{user}', [ChatController::class, 'show'])->name('chat.show');
    Route::post('/chat/send/{user}', [ChatController::class, 'send'])->name('chat.send');
});
