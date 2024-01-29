@extends('layouts.layout')

@section('title','ホーム画面')

@section('main')
<div class="container pt-3">
    <h3 class="p-2" style="width: fit-content;"><b>友だちの投稿</b></h3>
    <div class="post-list my-4">
        @forelse($friend_posts as $friend_post)
            <div class="friend-post">
                <div class="post-header d-flex align-items-center">
                    @if ($friend_post->user->icon)
                        <img src="{{ asset('storage/icons/' . $friend_post->user->icon )}}" alt="icon" class="img-fluid rounded-circle" style="width: 35px; height: 35px;">
                    @else
                        <div class="icon-placeholder rounded-circle m-1" style="width: 35px; height: 35px; background-color: #CCCCCC;"></div>
                    @endif
                    <p>{{$friend_post->user->name}}</p>
                </div>
                <div class="post-main">
                    @if ($friend_post->image)
                    <img src="{{ asset('storage/images/' . $friend_post->image )}}" alt="image" class="img-fluid">
                    @else
                    <div class="image-placeholder mx-auto" style="width: 250px; height: 150px; background-color: #CCCCCC; margin: 25px 0;"></div>
                    @endif
                    <p>{{$friend_post->title}}</p>
                </div>
                <div class="post-footer d-flex align-items-center">
                    <div class="comment-action m-2">
                        <a href="{{ route('post.show', ['post' => $friend_post->id]) }}" style="font-size: 1rem; color:black;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="38" height="38" fill="currentColor" class="bi bi-chat-dots" viewBox="0 0 16 16">
                                <path d="M5 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
                                <path d="m2.165 15.803.02-.004c1.83-.363 2.948-.842 3.468-1.105A9.06 9.06 0 0 0 8 15c4.418 0 8-3.134 8-7s-3.582-7-8-7-8 3.134-8 7c0 1.76.743 3.37 1.97 4.6a10.437 10.437 0 0 1-.524 2.318l-.003.011a10.722 10.722 0 0 1-.244.637c-.079.186.074.394.273.362a21.673 21.673 0 0 0 .693-.125zm.8-3.108a1 1 0 0 0-.287-.801C1.618 10.83 1 9.468 1 8c0-3.192 3.004-6 7-6s7 2.808 7 6c0 3.193-3.004 6-7 6a8.06 8.06 0 0 1-2.088-.272 1 1 0 0 0-.711.074c-.387.196-1.24.57-2.634.893a10.97 10.97 0 0 0 .398-2z"/>
                            </svg>
                        </a>
                    </div>
                    <div class="like-action">
                        @if ($friend_post->getExistLike($friend_post->id, $user))
                            <form action="{{ route('unlike', $friend_post) }}" method="POST" class="d-inline-flex align-items-center" style="margin: 0;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="color: #ff69b4; padding: 0;" class="m-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                                        <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"/>
                                    </svg>
                                </button>
                            </form>
                        @else
                            <form action="{{ route('like', $friend_post) }}" method="POST" class="d-inline-flex align-items-center" style="margin: 0;">
                                @csrf
                                <button type="submit" style="padding: 0;" class="m-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                                        <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"/>
                                    </svg>
                                </button>
                            </form>
                        @endif
                    </div>
                    <div class="post-detail" style="margin-left: auto;">
                        <a href="{{ route('post.show', ['post' => $friend_post->id]) }}" style="font-size: 1rem;">続きを見る</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="d-flex align-items-center" style="height: 350px;">
                <p style="margin-left: 20px;">登録されている友だちの投稿はありません</p>
            </div>
        @endforelse
    </div>
    <h3 class="p-2" style="width: fit-content;"><b>グループ一覧</b></h3>
    <div class="group-chats-list my-4 d-flex align-items-center">
        @foreach($public_groups as $public_group)
        <div class="group-chat" style="margin-right: 10px; border: 2px solid black;">
            <a href="{{ route('group.show', ['group' => $public_group->id]) }}">
                <div class="group-chat-name text-center">
                    <p class="p-3" style="margin: 0; font-size: 1.25rem;">{{$public_group->group_name}}</p>
                </div>
                <div class="group-chat-main d-flex flex-column">
                    <div class="group-icon m-auto">
                        @if ($public_group->group_icon)
                            <img src="{{ asset('storage/group_icons/' . $public_group->group_icon )}}" alt="icon" class="img-fluid rounded-circle border border-3">
                        @elseif ($public_group->group_icon->null)
                            <div class="icon-placeholder rounded-circle border border-3" style="width: 80px; height: 80px; background-color: #CCCCCC;"></div>
                        @else
                            <div class="icon-placeholder rounded-circle border border-3" style="width: 80px; height: 80px; background-color: #CCCCCC;"></div>
                        @endif
                    </div>
                    <p class="text-center" style="margin: 0; font-size: 1.25rem;">メンバー{{$public_group->groupMemberCount($public_group->id)}}人</p>
                </div>
            </a>
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
        /* height: 350px; */
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

    .post-main p {
        border-top: 2px solid black;
        border-bottom: 2px solid black;
    }

    .post-main img {
        width: 250px;
        height: 150px;
        margin: 25px 0;
    }
    .post-detail a {
        color: black;
        margin:5px 20px 0 0;
        padding: 5px 20px;
        border: 2px solid black;
        border-radius: 20px;
        background-color: #CCFFCC;
    }

    .post-detail a:hover {
        background-color: #00FFCC;
        color: white;
        border: 2px solid #00FFCC;
    }
    .comment-action a:hover {
        color:dodgerblue!important;
    }

    .like-action button {
        border: none;
        outline: none;
        background: transparent;
    }
    .group-chats-list {
    overflow-x: auto;
    white-space: nowrap;
    }

    .group-chats-list::-webkit-scrollbar {
        display: none;
    }
    .group-chat {
        height: 200px;
        width: 250px;
        border-radius: 50px;
        display: inline-block;
        white-space: normal;
        flex-shrink: 0;
    }

    .group-chat a {
        color: black;
    }

    .group-icon img {
        height: 80px;
        width: 80px;
        border-radius: 50%;
    }
    </style>
