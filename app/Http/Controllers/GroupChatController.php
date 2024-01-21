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
    public function index()
    {
        $groups = Group::all();

        return view('groupChat.index', compact('groups'));
    }

    public function create()
    {
        return view('groupChat.create');
    }

    public function store(Request $request)
    {
        $group = Group::create([
            'group_name' => $request['group_name'],
            'group_description' => $request['group_description'],
        ]);

        if ($request->hasFile('group_icon')) {
            $group_iconName = Str::random(20) . '.' . $request->file('group_icon')->getClientOriginalName();
            $group_iconPath = $request->file('group_icon')->storeAs('public/group_icons', $group_iconName);
            $group->group_icon = $group_iconName;
            $group->save();
        }

        return redirect()->route('groupChat.index', compact('group'));
    }

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
