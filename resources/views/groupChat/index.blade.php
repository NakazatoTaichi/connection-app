@extends('layouts.layout')

@section('title', 'グループ一覧')

@section('main')
<div class="container pt-3">
    <h1>グループ一覧画面</h1>
    <div class="my-4">
        <a class="btn btn-primary" href="{{route('groupChat.create')}}">グループを作成</a>
    </div>
    <div class="group-list mt-2">
        @forelse ($groups as $group)
        <div class="group-wrapper mb-4 border border-dark-subtle rounded-3 p-3">
            <div class="friend-container row align-items-center">
                <div class="col-md-1">
                    @if ($group->group_icon)
                    <img src="{{ asset('storage/group_icons/' . $group->group_icon )}}" alt="group_icon" class="img-fluid rounded-circle" style="width: 50px; height: 50px;">
                    @else
                    <div class="group_icon-placeholder rounded-circle" style="width: 50px; height: 50px; background-color: #CCCCCC;"></div>
                    @endif
                </div>
                <div class="group col-md-3">
                    <a href="">{{-- {{ route('chat.show', ['user' => $friend->id]) }}--}}
                        <p style="margin: 0;">{{$group->group_name}}</p>
                    </a>
                </div>
            </div>
        </div>
        @empty
            <p>作成されたグループはありません</p>
        @endforelse
    </div>
</div>
@endsection
