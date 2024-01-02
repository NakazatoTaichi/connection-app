@extends('layouts.layout');

@section('title','ユーザ一覧')

@section('main')
<div class="container">
    <h1>ユーザ一覧</h1>
    @foreach ($users as $user)
    <div class="user-wrapper mb-4 border p-3">
        <div class="user-container row align-items-center mb-4">
            <div class="col-md-1">
                @if ($user->icon)
                <img src="{{ asset('storage/icons/' . $user->icon )}}" alt="icon" class="img-fluid rounded-circle" style="width: 50px; height: 50px;">
                @else
                <div class="icon-placeholder rounded-circle" style="width: 50px; height: 50px; background-color: #CCCCCC;"></div>
                @endif
            </div>
            <div class="user-info col-md-3">
                <a href="{{ route('chat.show', ['user' => $user->id]) }}">
                    <p>{{$user->name}}</p>
                </a>
            </div>
        </div>
    </div>
    @endforeach
    <div class="text-end mb-5">
        <a href="{{ route('home')}}">戻る</a>
    </div>
</div>
@endsection

