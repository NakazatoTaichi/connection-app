@extends('layouts.layout');

@section('title','友だち一覧画面')

@section('main')
    <div class="container mt-5">
        <h1>友だち一覧</h1>
        <div class="mt-3">
            <a class="btn btn-primary" href="{{route('friend.friendRegister')}}">友だち登録</a>
        </div>
    </div>
@endsection
