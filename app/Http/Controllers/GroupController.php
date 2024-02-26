<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Group;
use App\Models\GroupMessage;
use App\Models\User;
use App\Models\GroupUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Http\Requests\GroupStoreRequest;

class GroupController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $participated_groups = Group::whereHas('users', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->get();
        $participated_groupsId = $participated_groups->pluck('id');

        $latest_group_messages = collect();
        foreach ($participated_groupsId as $participated_groupId) {
            $group_user = GroupUser::where('group_id', $participated_groupId)->get();
            $group_user_ids = $group_user->pluck('user_id');
            $latest_group_message = GroupMessage::where(function ($query) use ($user, $participated_groupId) {
                $query->where('user_id', $user->id)->where('group_id', $participated_groupId);
            })->orWhere(function ($query) use ($group_user_ids, $participated_groupId) {
                $query->whereIn('user_id', $group_user_ids)->where('group_id', $participated_groupId);
            })->latest()->first();

            if ($latest_group_message) {
                $latest_group_messages->push($latest_group_message);
            }
        }

        return view('groups.index', compact('participated_groups', 'latest_group_messages'));
    }

    public function create()
    {
        return view('groups.create');
    }

    public function store(GroupStoreRequest $request)
    {
        $user = Auth::user();
        $group = Group::create([
            'group_name' => $request['group_name'],
            'group_description' => $request['group_description'],
            'status' => $request['status'],
        ]);

        if ($request->hasFile('group_icon')) {
            $group_iconName = Str::random(20) . '.' . $request->file('group_icon')->getClientOriginalName();
            $group_iconPath = $request->file('group_icon')->storeAs('public/group_icons', $group_iconName);
            $group->group_icon = $group_iconName;
            $group->save();
        }

        $group_user = GroupUser::create([
            'group_id' => $group->id,
            'user_id' => $user->id,
        ]);

        return redirect()->route('group.index', compact('group'))->with('flash_message', '新しいグループを作成しました');
    }

    public function show(Group $group)
    {
        $user = Auth::user();
        $group_user_exists = GroupUser::where('group_id', $group->id)->where('user_id', $user->id)->exists();

        return view('groups.show', compact('group', 'group_user_exists'));
    }
}
