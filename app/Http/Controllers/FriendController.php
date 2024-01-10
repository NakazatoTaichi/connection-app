<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FriendController extends Controller
{
    public function index()
    {
        return view('friends.index');
    }

    public function friendRegister()
    {
        return view('friends.friendRegister');
    }
}
