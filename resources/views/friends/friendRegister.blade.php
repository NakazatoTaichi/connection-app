@extends('layouts.layout');

@section('title','友だち登録画面')

@section('main')
    <div class="container mt-5">
        <h1>友だち登録画面</h1>
        <h3>あなたのフレンドID:{{ $user->user_friend_id }}</h3>
        <div class="mt-3">
            <form action="{{ route('friend.store') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="friend_id">友だちのフレンドID</label>
                    <input  type="number" name="friend_id" id="friend_id" class="form-control" style="width: 300px;" required>
                </div>
                <div class="mt-3">
                    <button type="submit" class="btn btn-primary btn-block">検索</button>
                </div>
            </form>
        </div>
        <div class="mt-3">
            <h2>ユーザ情報</h2>
            @if (isset($friend_info))
                <div class="row">
                    <div class="col-3 mt-2">
                        @if ($friend_info->icon)
                            <img src="{{ asset('storage/icons/' . $friend_info->icon )}}" alt="icon" class="img-fluid rounded-circle" style="width: 50px; height: 50px;">
                        @else
                            <div class="icon-placeholder rounded-circle" style="width: 50px; height: 50px; background-color: #CCCCCC;"></div>
                        @endif
                        フレンド名:{{ $friend_info->name }}
                    </div>
                    <div class="col-3 mt-2">
                        <form action="{{route('friend.register', ['friend_id' => $friend_info->id])}}" method="post">
                            @csrf
                            <button>登録</button>
                        </form>
                    </div>
                </div>
            @else
                <p>{{ $friend_info_message }}</p>
            @endif
        </div>
        <div class="text-end">
            <a href="{{ route('friend.index')}}">戻る</a>
        </div>
    </div>
@endsection
