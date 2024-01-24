@extends('layouts.talkLayout')

@section('title', 'グループ詳細画面')

@section('main')
<div class="container mt-5 w-75 p-3" style="margin: auto;">
    <div class="d-flex justify-content-center">
        <h1 class="mt-3" style="margin-bottom: 0;">グループ詳細</h1>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="group-detail mt-2">
                <div class="group-wrapper mb-4 border border-dark-subtle rounded-3 p-3">
                    <div class="row d-flex justify-content-center align-items-center">
                        <div class="col-md-12 text-center">
                            @if ($group->group_icon)
                            <img src="{{ asset('storage/group_icons/' . $group->group_icon )}}" alt="group_icon" class="img-fluid rounded-circle" style="width: 120px; height: 120px;">
                            @else
                            <div class="group_icon-placeholder rounded-circle" style="width: 120px; height: 120px; background-color: #CCCCCC;"></div>
                            @endif
                        </div>
                        <div class="col-md-12 text-center">
                            <p>{{$group->group_name}}</p>
                            <hr>
                            <div class="mx-4">
                                <p>{{$group->group_description}}</p>
                            </div>
                        </div>
                        @if ($group_user_exists)
                        <div class="col-md-6 mt-3 text-center">
                            <a class="btn btn-success" href="{{route('groupChat.groupShow',['group' => $group->id])}}">トーク</a>
                        </div>
                        @else
                            <div class="col-md-6 mt-3 text-center">
                                <form action="{{route('groupChat.participate', ['group_id' => $group->id])}}" method="post">
                                    @csrf
                                    <button class="btn btn-success">参加する</button>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="my-3 text-end">
        <a class="btn btn-primary" href="{{route('group.index')}}">戻る</a>
    </div>
</div>
@endsection
