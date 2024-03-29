<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\User;
use App\Models\Friend;
use App\Models\Comment;
use App\Models\Like;
use Illuminate\Support\Str;
use App\Http\Requests\PostStoreRequest;

class PostController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        //ホームの投稿ポスト
        $posts = Post::latest()->get();
        //あなたの投稿ポスト
        $user_posts = Post::where('user_id', $user->id)->latest()->get();
        //友だちの投稿ポスト
        $friend_users = Friend::where('user_id', $user->id)->get();
        $friend_posts = Post::whereHas('user.friends', function ($query) use ($friend_users) {
            $query->whereIn('user_id', $friend_users->pluck('friend_id'));
        })->latest()->get();

        return view('posts.index', compact('user', 'posts', 'user_posts', 'friend_posts'));
    }

    public function create()
    {
        $user = Auth::user();
        $user = User::find($user->id);
        return view('posts.create', compact('user'));
    }

    public function store(PostStoreRequest $request)
    {
        $post = Post::create([
            'title' => $request['title'],
            'content' => $request['content'],
            'user_id' => $request['user_id'],
        ]);

        if ($request->hasFile('image')) {
            $imageName = Str::random(20) . '.' . $request->file('image')->getClientOriginalName();
            $imagePath = $request->file('image')->storeAs('public/images', $imageName);
            $post->image = $imageName;
            $post->save();
        }

        return redirect()->route('post.index', compact('post'));
    }

    public function show(Post $post)
    {
        $user = Auth::user();
        $comments = Comment::where('post_id', $post->id)->latest()->get();
        $likes = Like::where('post_id', $post->id)->where('user_id', $user->id)->first();

        return view('posts.show', compact('post', 'comments', 'likes'));
    }
}
