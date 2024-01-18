<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return view('posts.index', compact('posts'));
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
        return view('posts.show', compact('post'));
    }

}
