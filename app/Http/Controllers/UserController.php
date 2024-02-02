<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Post;
use App\Models\Friend;
use App\Models\Group;
use Illuminate\Support\Str;
use App\Http\Requests\UserRegisterRequest;
use App\Http\Requests\UserMyProfileRequest;


class UserController extends Controller
{
    public function showRegister()
    {
        return view('register');
    }

    public function register(UserRegisterRequest $request)
    {
        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'user_friend_id' => mt_rand(10000000, 99999999),
        ]);

        if ($request->hasFile('icon')) {
            $iconName = Str::random(20) . '.' . $request->file('icon')->getClientOriginalName();
            $iconPath = $request->file('icon')->storeAs('public/icons', $iconName);
            $user->icon = $iconName;
            $user->save();
        }

        Auth::login($user);

        return redirect()->route('home');
    }

    public function home()
    {
        $user = Auth::user();
        $friend_users = Friend::where('user_id', $user->id)->get();
        $friend_posts = Post::whereHas('user.friends', function ($query) use ($friend_users) {
            $query->whereIn('user_id', $friend_users->pluck('friend_id'));
        })->latest()->get();
        $public_groups = Group::all();

        return view('home', compact('user', 'friend_posts', 'public_groups'));
    }

    public function MyProfile()
    {
        $user = Auth::user();

        return view('myProfile', ['user' => $user]);
    }

    public function updateProfile(UserMyProfileRequest $request, User $user)
    {
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        // パスワードの変更があれば処理
        if ($request->filled('password')) {
            $user->password = Hash::make($request->input('password'));
        }

        // アイコンのアップロードがあれば処理
        if ($request->hasFile('icon')) {
            $iconName = Str::random(20) . '.' . $request->file('icon')->getClientOriginalName();
            $iconPath = $request->file('icon')->storeAs('public/icons', $iconName);
            $user->icon = $iconName;
        }
        $user->save();

        return redirect()->route('myProfile');
    }

    public function logout()
    {
        Auth::logout();

        return redirect('/');
    }

    public function showLogin()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $messages = [
            'email.required' => 'メールアドレスを入力してください',
            'email.email' => '有効なメールアドレスを入力してください',
            'password.required' => 'パスワードを入力してください',
        ];

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ], $messages);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('home');
        }

        return back();
    }
}
