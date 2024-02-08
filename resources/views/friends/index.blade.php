@extends('layouts.talkLayout')

@section('title','友だち一覧画面')

@section('main')
<div class="container mt-5 w-75 p-3" style="margin: auto;">
    @if (session('flash_message'))
        <div class="alert alert-success text-center py-3 my-0" role="alert">
            {{ session('flash_message') }}
        </div>
    @endif
    <div class="row align-items-end">
        <div class="col-md-9">
            <h1 class="mt-3" style="margin-bottom: 0;">友だちリスト</h1>
        </div>
        <div class="col-md-3">
            <p style="margin: 0;">(友だちの人数：{{$friends->count()}}人)</p>
        </div>
    </div>
    <div class="my-3 d-flex align-items-center">
        <a class="btn btn-primary d-flex align-items-center" style="font-size:1.5rem;" href="{{ route('friend.friendRegister') }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-person-plus-fill" viewBox="0 0 16 16">
                <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z"/>
            </svg>
            <span style="font-size: 1.5rem; margin-left: 5px;">友だち登録</span>
        </a>
    </div>
    <div class="friend-list py-3 overflow-scroll" style="height: 550px;">
        @forelse ($friends as $friend)
        @php
            $latestMessage = $latest_user_friend_messages->first(function ($message) use ($friend) {
                return $message->user_id == $friend->id || $message->recipient_id == $friend->id;
            });
        @endphp
        <div class="friend-wrapper mb-4 border border-dark-subtle rounded-5 p-3">
            <div class="friend-container row align-items-center">
                <div class="col-md-1">
                    @if ($friend->icon)
                    <img src="{{ asset('storage/icons/' . $friend->icon )}}" alt="icon" class="img-fluid rounded-circle" style="width: 50px; height: 50px;">
                    @else
                    <div class="icon-placeholder rounded-circle" style="width: 50px; height: 50px; background-color: #CCCCCC;"></div>
                    @endif
                </div>
                <div class="friend-info col-md-3">
                    <a href="{{ route('chat.show', ['user' => $friend->id]) }}">
                        <p style="margin: 0;">{{$friend->name}}</p>
                    </a>
                </div>
                @if ($latestMessage)
                    <div class="col-md-7">
                        <p class="text-overflow" style="margin: 0; opacity:0.5; max-width: 550px;">{{$latestMessage->message}}</p>
                    </div>
                @endif
            </div>
        </div>
        @empty
            <p>登録されている友だちはいません</p>
        @endforelse
    </div>
</div>
@endsection
<style>
    .text-overflow {
        text-overflow: ellipsis;
        overflow: hidden;
        white-space: nowrap;
    }
</style>
