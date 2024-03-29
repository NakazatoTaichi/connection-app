<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Comment;
use App\Models\Post;
use App\Http\Requests\CommentStoreRequest;

class CommentController extends Controller
{
    public function store(CommentStoreRequest $request)
    {
        $user = Auth::user();

        $comment = Comment::create([
            'post_id' => $request['post_id'],
            'user_id' =>  $user->id,
            'comment' => $request->input('comment'),
        ]);

        return redirect()->back();
    }
}
