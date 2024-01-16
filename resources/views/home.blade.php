@extends('layouts.layout')

@section('title','ホーム画面')

@section('main')
<div class="container pt-3">
    <h3 class="p-2" style="width: fit-content;"><b>友だちの投稿</b></h3>
    <div class="post-list my-4">
        @foreach($friend_posts as $friend_post)
            <div class="friend-post">
                <div class="post-header d-flex align-items-center">
                    @if ($friend_post->user->icon)
                        <img src="{{ asset('storage/icons/' . $friend_post->user->icon )}}" alt="icon" class="img-fluid rounded-circle" style="width: 35px; height: 35px;">
                    @elseif ($friend_post->user->icon->null)
                        <div class="icon-placeholder rounded-circle" style="width: 50px; height: 50px; background-color: #CCCCCC;"></div>
                    @else
                        <div class="icon-placeholder rounded-circle" style="width: 50px; height: 50px; background-color: #CCCCCC;"></div>
                    @endif
                    <p>{{$friend_post->user->name}}</p>
                </div>
                <div class="post-main">
                    @if ($friend_post->image)
                    <img src="{{ asset('storage/images/' . $friend_post->image )}}" alt="image" class="img-fluid">
                    @else
                    <div class="image-placeholder" style="width: 50px; height: 50px; background-color: #CCCCCC;"></div>
                    @endif
                    <p>{{$friend_post->title}}</p>
                </div>
                <div class="post-footer">
                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-chat-dots" viewBox="0 0 16 16">
                        <path d="M5 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
                        <path d="m2.165 15.803.02-.004c1.83-.363 2.948-.842 3.468-1.105A9.06 9.06 0 0 0 8 15c4.418 0 8-3.134 8-7s-3.582-7-8-7-8 3.134-8 7c0 1.76.743 3.37 1.97 4.6a10.437 10.437 0 0 1-.524 2.318l-.003.011a10.722 10.722 0 0 1-.244.637c-.079.186.074.394.273.362a21.673 21.673 0 0 0 .693-.125zm.8-3.108a1 1 0 0 0-.287-.801C1.618 10.83 1 9.468 1 8c0-3.192 3.004-6 7-6s7 2.808 7 6c0 3.193-3.004 6-7 6a8.06 8.06 0 0 1-2.088-.272 1 1 0 0 0-.711.074c-.387.196-1.24.57-2.634.893a10.97 10.97 0 0 0 .398-2z"/>
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                        <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"/>
                    </svg>
                    <a href="#" style="font-size: 1rem;">続きを見る</a>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection

<style>
    .container h3 {
        border: 2px solid black;
        border-radius: 15px;
    }
    .post-list {
    margin: 20px 0;
    display: flex;
    align-items: center;
    overflow-x: auto;
    white-space: nowrap;
    }

    .post-list::-webkit-scrollbar {
        display: none;
    }
    .friend-post {
        height: 350px;
        width: 286px;
        margin-right: 50px;
        border: 2px solid black;
        text-align: center;
        display: inline-block;
        white-space: normal;
        flex-shrink: 0;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.5);
    }

    .friend-post p {
        margin: 0;
        padding: 5px 0;
    }
    .post-header {
        border-bottom: 2px solid black;
    }
    .post-header img {
        margin: 0 5px;
    }

    .post-header span {
    }

    .post-main p {
        border-top: 2px solid black;
        border-bottom: 2px solid black;
    }

    .post-main img {
        width: 250px;
        height: 150px;
        margin: 25px 0;
    }

    .post-footer {
        display: flex;
        align-items: center;
    }

    .post-footer svg {
        margin: 6px 6px 0 6px;

    }
    .post-footer img {
        width: 50px;
        height: 50px;
    }

    .post-footer a {
        color: black;
        margin:5px 20px 0 0;
        margin-left: auto;
        padding: 5px 20px;
        border: 2px solid black;
        border-radius: 20px;
        background-color: #CCFFCC;
    }

    .post-footer a:hover {
        background-color: #00FFCC;
        color: white;
        border: 2px solid #00FFCC;
    }
    </style>
