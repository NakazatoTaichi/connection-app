<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\FriendController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\GroupChatController;
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

    //コメント機能
    Route::post('/comments', [CommentController::class, 'store'])->name('comment.store');

    //いいね機能
    Route::post('/likes/{post}', [LikeController::class, 'like'])->name('like');
    Route::delete('/likes/{post}', [LikeController::class, 'unlike'])->name('unlike');
    //ホーム画面のいいね機能
    Route::post('/likes/home/{post}', [LikeController::class, 'homePostLike'])->name('homePostLike');
    Route::delete('/likes/home/{post}', [LikeController::class, 'homePostUnlike'])->name('homePostUnlike');
    //投稿画面のいいね機能
    Route::post('/likes/posting/{post}', [LikeController::class, 'postingPostLike'])->name('postingPostLike');
    Route::delete('/likes/posting/{post}', [LikeController::class, 'postingPostUnlike'])->name('postingPostUnlike');

    //グループチャット画面関係
    Route::get('/groups', [GroupController::class, 'index'])->name('group.index');
    Route::get('/groups/create', [GroupController::class, 'create'])->name('group.create');
    Route::post('groups', [GroupController::class, 'store'])->name('group.store');
    Route::get('/groups/{group}', [GroupController::class, 'show'])->name('group.show');

    Route::post('/groupChat/participate', [GroupChatController::class, 'participate'])->name('groupChat.participate');
    Route::get('/groupChat/{group}', [GroupChatController::class, 'groupShow'])->name('groupChat.groupShow');
    Route::post('/groupChat/groupMessageSend/{group}', [GroupChatController::class, 'groupMessageSend'])->name('groupChat.groupMessageSend');
});
