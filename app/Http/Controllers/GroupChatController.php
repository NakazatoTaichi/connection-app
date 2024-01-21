<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GroupChatController extends Controller
{
    public function index()
    {
        return view('groupChat.index');
    }

    
}
