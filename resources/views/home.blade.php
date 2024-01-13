@extends('layouts.layout')

@section('title','ホーム画面')

@section('main')
    <div class="container pt-5">
        <h1>Home</h1>
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
