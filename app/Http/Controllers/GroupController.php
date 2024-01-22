<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Group;
use App\Models\GroupMessage;
use App\Models\User;
use App\Models\GroupUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class GroupController extends Controller
{
    public function index()
    {
        $groups = Group::all();

        return view('groups.index', compact('groups'));
    }

    public function create()
    {
        return view('groups.create');
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

        return redirect()->route('group.index', compact('group'));
    }

    public function show(Group $group)
    {
        $user = Auth::user();
        $group_user_exists = GroupUser::where('group_id', $group->id)->where('user_id', $user->id)->exists();

        return view('groups.show', compact('group', 'group_user_exists'));
    }
}
