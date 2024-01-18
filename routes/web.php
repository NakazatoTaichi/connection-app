<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\FriendController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;

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

Route::get('/register', [UserController::class, 'showRegister'])->name('register');
Route::post('/register', [UserController::class, 'register']);

Route::get('/login', [UserController::class, 'showLogin']);
Route::post('/login', [UserController::class, 'login'])->name('login');

Route::middleware('auth')->group(function () {
    Route::get('/home', [UserController::class, 'home'])->name('home');

    Route::get('/myProfile', [UserController::class, 'myProfile'])->name('myProfile');
    Route::post('/myProfile/{user}', [UserController::class, 'updateProfile'])->name('updateProfile');

    Route::post('logout', [UserController::class, 'logout'])->name('user.logout');

    //チャット画面関係
    Route::get('/users', [ChatController::class, 'users'])->name('user.index');
    Route::get('/chat/{user}', [ChatController::class, 'show'])->name('chat.show');
    Route::post('/chat/send/{user}', [ChatController::class, 'send'])->name('chat.send');

    //友だち登録関係
    Route::get('/friends', [FriendController::class, 'index'])->name('friend.index');
    Route::get('/friends/friendRegister', [FriendController::class, 'friendRegister'])->name('friend.friendRegister');
    Route::post('/friends', [FriendController::class, 'store'])->name('friend.store');
    Route::post('/friends/register', [FriendController::class, 'register'])->name('friend.register');

    //投稿機能関係
    Route::get('/posts', [PostController::class, 'index'])->name('post.index');
    Route::get('/posts/create', [PostController::class, 'create'])->name('post.create');
    Route::post('/posts', [PostController::class, 'store'])->name('post.store');
    Route::get('/posts/{post}', [PostController::class, 'show'])->name('post.show');

    Route::post('/comments', [CommentController::class, 'store'])->name('comment.store');
});
