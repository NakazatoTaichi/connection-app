<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Group;
use App\Models\GroupUser;
use App\Models\GroupMessage;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Events\GroupMessageSent;



class GroupChatController extends Controller
{
    public function participate(Request $request)
    {
        $user = Auth::user();

        $group_user = GroupUser::create([
            'user_id' => $user->id,
            'group_id' => $request['group_id'],
        ]);
        $group_user->save();

        return redirect()->route('groupChat.groupShow', ['group' => $request['group_id']]);
    }

    public function groupShow(Group $group)
    {
        $user = Auth::user();
        $group_users = GroupUser::where('group_id', $group->id)->get();

        $group_user_ids = $group_users->pluck('user_id');

        $messages = GroupMessage::where(function ($query) use ($group) {
            $query->where('user_id', Auth::id())->where('group_id', $group->id);
        })->orWhere(function ($query) use ($group, $group_user_ids) {
            $query->whereIn('user_id', $group_user_ids)->where('group_id', $group->id);
        })->get();

        return view('groupChat.groupShow', compact('user', 'group', 'group_users', 'messages'));
    }

    public function groupMessageSend(Request $request, Group $group)
    {
        $request->validate([
            'message' => ['required', 'string']
        ]);

        $user = Auth::user();

        $message = new GroupMessage;
        $message->message = $request->message;
        $message->user_id = $user->id;
        $message->group_id = $group->id;
        $message->save();

        event(new GroupMessageSent($message, $user));

        return back();
    }
}
