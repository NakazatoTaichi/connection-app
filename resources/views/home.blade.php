@extends('layouts.layout');

@section('title','ホーム画面')

@section('main')
    <div class="container mt-5">
        <h1>Home</h1>
        <div class="my-4">
            @if ($user->icon)
                <img src="{{ asset('storage/icons/' . $user->icon )}}" alt="icon" class="img-fluid rounded-circle" style="width: 50px; height: 50px;">
            @else
                <div class="icon-placeholder rounded-circle" style="width: 50px; height: 50px; background-color: #CCCCCC;"></div>
            @endif
            {{\Illuminate\Support\Facades\Auth::user()->name}}でログインしています。
        </div>
        <form action="{{route('user.logout')}}" method="post">
            @csrf
            <button>ログアウト</button>
        </form>
        <div class="row mt-3">
            <div class="col-md-3">
                <a href="{{ route('user.index') }}">ユーザ一覧</a>
            </div>
            <div class="col-md-3">
                <a href="{{ route('friend.index') }}">フレンド一覧</a>
            </div>
            <div class="col-md-3">
                <a href="{{ route('myProfile') }}">プロフィール編集</a>
            </div>
        </div>
    </div>
@endsection
