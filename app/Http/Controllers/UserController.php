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

        return redirect()->route('profile');
    }

    public function profile()
    {
        return view('profile');
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

            return redirect()->intended('profile');
        }

        return back();
    }
}
