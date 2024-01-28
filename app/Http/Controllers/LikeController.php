<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Like;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function like(Request $request, Post $post)
    {
        $user = Auth::user();

        $like = new Like;
        $like->post_id = $post->id;
        $like->user_id = $user->id;
        $like->save();

        return back();
    }

    public function unlike(Request $request, Post $post)
    {
        $user=Auth::user()->id;

        $like=like::where('post_id', $post->id)->where('user_id', $user)->first();
        $like->delete();

        return back();
    }
}
