<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Friend;


class FriendController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $user = User::find($user->id);

        // $friends = $user->friends->get();
        $friends = $user->friends()->get();
        // dd($user);
        // dd($friends);
        return view('friends.index', compact('friends'));
    }

    public function friendRegister()
    {
        $user = Auth::user();

        $friend_info_message = '入力されている情報はありません';

        return view('friends.friendRegister', compact('user', 'friend_info_message'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $friend_id = $request->input('friend_id');
        $friend_info = User::where('user_friend_id', $friend_id)->first();
        if ($friend_info) {
            // ユーザが見つかった場合の処理
            return view('friends.friendRegister', compact('user', 'friend_info'));
        } else {
            // ユーザが見つからなかった場合の処理
            $friend_info_message = 'そのフレンドIDの人は存在しません';
            return view('friends.friendRegister', compact('user', 'friend_info_message'));
        }
    }

    public function register(Request $request)
    {
        $user = Auth::user();

        $friend = Friend::create([
            'user_id' => $user->id,
            'friend_id' => $request['friend_id'],
        ]);
        $friend->save();

        return redirect()->route('friend.index');
    }
}
