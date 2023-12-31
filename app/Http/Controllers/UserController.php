<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Str;


class UserController extends Controller
{
    public function showRegister()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $user = User::query()->create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
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

        return view('home', ['user' => $user]);
    }

    public function MyProfile()
    {
        $user = Auth::user();

        return view('myProfile', ['user' => $user]);
    }

    public function updateProfile(Request $request, User $user)
    {
        // $user = Auth::user();

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
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('home');
        }

        return back();
    }
}
