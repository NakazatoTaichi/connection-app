@extends('layouts.layout')

@section('title','投稿一覧画面')

@section('main')
<div class="container pt-3">
    <h1>投稿一覧画面</h1>
    <div class="my-4">
        <a class="btn btn-primary" href="{{route('post.create')}}">投稿</a>
    </div>
</div>
@endsection
