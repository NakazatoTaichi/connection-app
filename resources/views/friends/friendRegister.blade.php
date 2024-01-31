@extends('layouts.talkLayout')

@section('title','友だち登録画面')

@section('main')
<div class="container mt-5 w-75 p-3" style="margin: auto;">
    <div class="row align-items-center">
        <div class="col-md-9">
            <h1 class="mt-3" style="margin-bottom: 0;">友だち登録画面</h1>
        </div>
    </div>
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
    <div class="group-form py-4">
        <div class="row justify-content-center">
            <div class="col-md-6 p-3 border border-3 border-success rounded-5 text-center">
                <h3 class="mt-3">あなたのフレンドID</h3>
                <div class="my-4 border border-dark-subtle border-2 rounded-2 p-2">
                    <h2 style="font-weight: bold; margin-bottom: 0;">{{ $user->user_friend_id }}</h2>
                </div>
                <div class="friend-search mt-3">
                    <form action="{{ route('friend.store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="friend_id" style="font-size: 1.5rem;">友だちのフレンドIDを入力してください</label>
                            <input type="number" name="friend_id" id="friend_id" class="form-control border-2" placeholder="IDを入力" required>
                        </div>
                        <div class="mt-3">
                            <button class="btn btn-outline-success" style="font-size: 1.5rem; width: 120px;" type="submit" id="button-addon2"><i class="fas fa-search"></i> 検索</button>
                        </div>
                    </form>
                </div>
                <div class="my-4">
                    <h3 class="p-3" style="border-top: 1px solid black">ユーザー情報</h3>
                    @if (isset($friend_info))
                        <div class="row">
                            <div class="col-6 mt-2 d-flex justify-content-center align-items-center">
                                @if ($friend_info->icon)
                                    <img src="{{ asset('storage/icons/' . $friend_info->icon )}}" alt="icon" class="img-fluid rounded-circle" style="width: 50px; height: 50px;">
                                @else
                                    <div class="icon-placeholder rounded-circle" style="width: 50px; height: 50px; background-color: #CCCCCC;"></div>
                                @endif
                                <span style="font-size: 1.5rem; margin-left: 10px;">{{ $friend_info->name }}</span>
                            </div>
                            <div class="col-6 mt-2">
                                <form action="{{route('friend.register', ['friend_id' => $friend_info->id])}}" method="post">
                                    @csrf
                                    <button class="btn btn-primary">登録</button>
                                </form>
                            </div>
                        </div>
                    @else
                        <p>{{ $friend_info_message }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="my-3 text-end">
        <a class="btn btn-primary" href="{{route('friend.index')}}">戻る</a>
    </div>
</div>
@endsection
