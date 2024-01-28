@extends('layouts.layout')

@section('title','投稿詳細画面')

@section('main')
<div class="container pt-3">
    <h1>投稿詳細画面</h1>
    <div class="row post-detail">
        <div class="col-6 post d-flex flex-column">
            <div class="post-writer">
                <p>投稿日：{{$post->created_at->format('Y/m/d')}}</p>
                <p>投稿者：{{$post->user->name}}</p>
            </div>
            <div class="posted_screen p-3">
                @if ($post->image)
                    <img src="{{ asset('storage/images/' . $post->image )}}" class="mx-auto" style="width: 500px; height: 300px;" alt="image" class="img-fluid">
                @else
                    <div class="image-placeholder mx-auto" style="background-color: #CCCCCC; width: 500px; height: 300px;"></div>
                @endif
            </div>
            <div class="post-content m-3">
                <p>タイトル：{{$post->title}}</p>
                <p>内容：{{$post->content}}</p>
            </div>
        </div>
        <div class="col-6 comment">
            <h3>コメント一覧</h3>
            <div class="d-flex align-items-center">
                <div class="comment-action">
                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-chat-dots" viewBox="0 0 16 16">
                        <path d="M5 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
                        <path d="m2.165 15.803.02-.004c1.83-.363 2.948-.842 3.468-1.105A9.06 9.06 0 0 0 8 15c4.418 0 8-3.134 8-7s-3.582-7-8-7-8 3.134-8 7c0 1.76.743 3.37 1.97 4.6a10.437 10.437 0 0 1-.524 2.318l-.003.011a10.722 10.722 0 0 1-.244.637c-.079.186.074.394.273.362a21.673 21.673 0 0 0 .693-.125zm.8-3.108a1 1 0 0 0-.287-.801C1.618 10.83 1 9.468 1 8c0-3.192 3.004-6 7-6s7 2.808 7 6c0 3.193-3.004 6-7 6a8.06 8.06 0 0 1-2.088-.272 1 1 0 0 0-.711.074c-.387.196-1.24.57-2.634.893a10.97 10.97 0 0 0 .398-2z"/>
                    </svg>
                    {{$post->comments->count()}}件
                </div>
                <div class="like-action">
                    @if ($likes)
                        <form action="{{ route('unlike', $post) }}" method="POST" class="d-inline-flex align-items-center" style="margin: 0;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="color: #ff69b4">
                                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                                    <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"/>
                                </svg>
                            </button>
                        </form>
                        {{$post->likes->count()}}いいね！
                    @else
                        <form action="{{ route('like', $post) }}" method="POST" class="d-inline-flex align-items-center" style="margin: 0; padding: 0;">
                            @csrf
                            <button type="submit">
                                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                                    <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"/>
                                </svg>
                            </button>
                        </form>
                        {{$post->likes->count()}}いいね！
                    @endif
                </div>
            </div>
            <hr>
            <div class="comment-list overflow-scroll" style="height: 360px;">
                @forelse($comments as $comment)
                    <div class="comment-content d-flex align-items-center">
                        @if ($comment->user->icon)
                            <img src="{{ asset('storage/icons/' . $comment->user->icon)}}" alt="icon" class="img-fluid rounded-circle" style="width: 40px; height: 40px; margin-right: 5px;">
                        @else
                            <div class="image-placeholder rounded-circle" style="width: 40px; height: 40px; background-color: #CCCCCC;"></div>
                        @endif
                        <p style="margin:0;">{{$comment->user->name}}<span style="margin-left: 20px; font-size: 1rem;">{{$comment->created_at->format('Y/m/d H:i')}}</span></p>
                    </div>
                    <p>{{$comment->comment}}</p>
                @empty
                    <p>コメントはありません</p>
                @endforelse
            </div>
            <div class="commnet-form">
                <hr>
                <p style="margin:0;">コメント</p>
                <form action="{{ route('comment.store', ['post_id' => $post->id])}}" method="POST">
                    @csrf
                    <div class="input-group">
                        <input type="text" name='comment' class="form-control" style="font-size: 1.5rem;" aria-label="コメントを入力" aria-describedby="button-send">
                        <button class="btn btn-primary" type="submit" id="button-send">送信</button>
                    </div>
                </form>
            </div>
            <div class="text-end">
                <a href="{{ route('home')}}">戻る</a>
            </div>
        </div>
    </div>
</div>
@endsection
<style>
    .posted_screen {
        border: 2px solid black;
        display: block;
        margin-left: auto;
        margin-right: auto;
    }

    .like-action button {
        border: none;
        outline: none;
        background: transparent;
    }
</style>
