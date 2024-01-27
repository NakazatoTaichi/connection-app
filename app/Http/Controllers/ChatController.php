<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Chat;
use App\Models\User;
use App\Events\MessageSent;

class ChatController extends Controller
{
    public function users()
    {
        $users = User::where('id', '!=', auth()->id())->get();
        return view('users', compact('users'));
    }

    public function show(User $user)
    {
        $messages = Chat::where(function ($query) use ($user) {
            $query->where('user_id', Auth::id())->where('recipient_id', $user->id);
        })->orWhere(function ($query) use ($user) {
            $query->where('user_id', $user->id)->where('recipient_id', Auth::id());
        })->get();

        return view('chat', compact('user', 'messages'));
    }

    public function send(Request $request, User $user)
    {
        $request->validate([
            'message' => ['required', 'string']
        ]);

        $self_user = User::find(Auth::id());
        $message = new Chat;
        $message->message = $request->message;
        $message->user_id = $self_user->id;
        $message->recipient_id = $user->id;
        $message->save();

        event(new MessageSent($message, $self_user));

        return back();
    }
}
