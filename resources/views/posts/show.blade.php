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
                                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-suit-heart-fill" viewBox="0 0 16 16">
                                    <path d="M4 1c2.21 0 4 1.755 4 3.92C8 2.755 9.79 1 12 1s4 1.755 4 3.92c0 3.263-3.234 4.414-7.608 9.608a.513.513 0 0 1-.784 0C3.234 9.334 0 8.183 0 4.92 0 2.755 1.79 1 4 1z"/>
                                </svg>
                            </button>
                        </form>
                        {{$post->likes->count()}}いいね！
                    @else
                        <form action="{{ route('like', $post) }}" method="POST" class="d-inline-flex align-items-center" style="margin: 0; padding: 0;">
                            @csrf
                            <button type="submit">
                                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-suit-heart" viewBox="0 0 16 16">
                                    <path d="m8 6.236-.894-1.789c-.222-.443-.607-1.08-1.152-1.595C5.418 2.345 4.776 2 4 2 2.324 2 1 3.326 1 4.92c0 1.211.554 2.066 1.868 3.37.337.334.721.695 1.146 1.093C5.122 10.423 6.5 11.717 8 13.447c1.5-1.73 2.878-3.024 3.986-4.064.425-.398.81-.76 1.146-1.093C14.446 6.986 15 6.131 15 4.92 15 3.326 13.676 2 12 2c-.777 0-1.418.345-1.954.852-.545.515-.93 1.152-1.152 1.595L8 6.236zm.392 8.292a.513.513 0 0 1-.784 0c-1.601-1.902-3.05-3.262-4.243-4.381C1.3 8.208 0 6.989 0 4.92 0 2.755 1.79 1 4 1c1.6 0 2.719 1.05 3.404 2.008.26.365.458.716.596.992a7.55 7.55 0 0 1 .596-.992C9.281 2.049 10.4 1 12 1c2.21 0 4 1.755 4 3.92 0 2.069-1.3 3.288-3.365 5.227-1.193 1.12-2.642 2.48-4.243 4.38z"/>
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
                @if ($errors->any())
                    <ul style="margin-bottom: 0; list-style: none;">
                        @foreach ($errors->all() as $error)
                            <li>
                                <div class="alert alert-danger">
                                    {{ $error }}
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @endif
                <p style="margin:0;">コメント</p>
                <form action="{{ route('comment.store', ['post_id' => $post->id])}}" method="POST">
                    @csrf
                    <div class="input-group">
                        <input type="text" name='comment' class="form-control" style="font-size: 1.5rem;" aria-label="コメントを入力" aria-describedby="button-send" required>
                        <button class="btn btn-primary" type="submit" id="button-send">送信</button>
                    </div>
                </form>
            </div>
            <div class="text-end">
                <a href="{{ route('post.index')}}">戻る</a>
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
