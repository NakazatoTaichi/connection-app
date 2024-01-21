@extends('layouts.layout');

@section('title','グループチャット作成画面')

@section('main')
    <div class="container pt-3">
        <h1>グループチャット作成画面</h1>
        <div class="group-form">
            <form action="{{ route('groupChat.store') }}" method="post">
                @csrf
                <div class="form-group mb-3" style="font-size: 1.5rem; width: 500px;">
                    <label for="group_name">グループ名</label>
                    <input type="text" class="form-control" name="group_name" id="group_name">
                </div>
                <button type="submit" class="btn btn-primary btn-block mb-4" style="font-size: 1.5rem; width: 100px;">作成</button>
            </form>
        </div>
        <div class="my-3 text-end">
            <a class="btn btn-primary" href="{{route('groupChat.index')}}">戻る</a>
        </div>
    </div>
@endsection
