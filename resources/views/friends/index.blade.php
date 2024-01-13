@extends('layouts.layout');

@section('title','友だち一覧画面')

@section('main')
    <div class="container mt-5">
        <h1>友だち一覧</h1>
        <div class="mt-3">
            <a class="btn btn-primary" href="{{route('friend.friendRegister')}}">友だち登録</a>
        </div>
        <div class="friend-list mt-2">
            @forelse ($friends as $friend)
            <div class="friend-wrapper mb-4 border p-3">
                <div class="friend-container row align-items-center mb-4">
                    <div class="col-md-1">
                        @if ($friend->icon)
                        <img src="{{ asset('storage/icons/' . $friend->icon )}}" alt="icon" class="img-fluid rounded-circle" style="width: 50px; height: 50px;">
                        @else
                        <div class="icon-placeholder rounded-circle" style="width: 50px; height: 50px; background-color: #CCCCCC;"></div>
                        @endif
                    </div>
                    <div class="friend-info col-md-3">
                        <a href="{{ route('chat.show', ['user' => $friend->id]) }}">
                            <p>{{$friend->name}}</p>
                        </a>
                    </div>
                </div>
            </div>
            @empty
                <p>友だちはいません</p>
            @endforelse
        </div>
        <div class="text-end">
            <a href="{{ route('home')}}">戻る</a>
        </div>
    </div>
@endsection
