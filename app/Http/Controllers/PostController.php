<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use App\Models\Like;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $posts = Post::latest()->get();

        return view('posts.index', compact('user', 'posts'));
    }

    public function create()
    {
        $user = Auth::user();
        $user = User::find($user->id);
        return view('posts.create', compact('user'));
    }

    public function store(Request $request)
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
        $comments = Comment::where('post_id', $post->id)->latest()->get();

        $user = Auth::user();
        $likes = Like::where('post_id', $post->id)->where('user_id', $user->id)->first();

        return view('posts.show', compact('post', 'comments', 'likes'));
    }
}
