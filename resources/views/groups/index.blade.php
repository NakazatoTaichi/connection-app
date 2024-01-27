@extends('layouts.talkLayout')

@section('title', 'グループリスト画面')

@section('main')
<div class="container mt-5 w-75 p-3" style="margin: auto;">
    <div class="row align-items-end">
        <div class="col-md-9">
            <h1 class="mt-3" style="margin-bottom: 0;">グループリスト</h1>
        </div>
        <div class="col-md-3">
            <p style="margin: 0;">(グループ数：{{$participated_groups->count()}} )</p>
        </div>
    </div>
    <div class="my-3 d-flex align-items-center">
        <a class="btn btn-primary d-flex align-items-center" style="font-size:1.5rem;" href="{{route('group.create')}}">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
            </svg>
            <span style="font-size: 1.5rem; margin-left: 5px;">グループを作成</span>
        </a>
    </div>
    <div class="group-list py-3 overflow-scroll" style="height: 550px;">
        @forelse ($participated_groups as $participated_group)
        <div class="group-wrapper mb-4 border border-dark-subtle rounded-5 p-3">
            <div class="friend-container row align-items-center">
                <div class="col-md-1">
                    @if ($participated_group->group_icon)
                    <img src="{{ asset('storage/group_icons/' . $participated_group->group_icon )}}" alt="group_icon" class="img-fluid rounded-circle" style="width: 50px; height: 50px;">
                    @else
                    <div class="group_icon-placeholder rounded-circle" style="width: 50px; height: 50px; background-color: #CCCCCC;"></div>
                    @endif
                </div>
                <div class="group col-md-3">
                    <a href="{{ route('groupChat.groupShow',['group' => $participated_group->id]) }}">
                        <p style="margin: 0;">{{$participated_group->group_name}}</p>
                    </a>
                </div>
            </div>
        </div>
        @empty
            <p>参加しているグループはありません</p>
        @endforelse
    </div>
</div>
@endsection
