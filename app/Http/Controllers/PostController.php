<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class PostController extends Controller
{
    public function index()
    {
        return view('posts.index');
    }

    public function create()
    {
        $user = Auth::user();
        $user = User::find($user->id);
        return view('posts.create', compact('user'));
    }

    // public function ()
    // {
    //     $user = Auth::user();
    //     $user = User::find($user->id);
    //     return view('posts.create', compact('user'));
    // }
}
