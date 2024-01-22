<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Group;
use App\Models\GroupMessage;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;



class GroupChatController extends Controller
{


    // public function show(Group $group)
    // {

    // }

    // public function show(Group $group)
    // {
    //     $user = Auth::user();
    //     $user = User::find($user->id);

    //     $messages = GroupMessage::where(function ($query) use ($user) {
    //         $query->where('user_id', Auth::id())->where('recipient_id', $user->id);
    //     })->orWhere(function ($query) use ($user) {
    //         $query->where('user_id', $user->id)->where('recipient_id', Auth::id());
    //     })->get();

    //     return view('chat', compact('user', 'messages'));
    // }
}
