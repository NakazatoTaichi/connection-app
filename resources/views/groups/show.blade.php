@extends('layouts.talkLayout')

@section('title', 'グループ詳細画面')

@section('main')
<div class="container mt-5 w-75 p-3" style="margin: auto;">
    <div class="d-flex justify-content-center">
        <h1 class="mt-3" style="margin-bottom: 0;">グループ詳細</h1>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-6 my-3">
            <div class="group-detail mt-2">
                <div class="group-wrapper mb-4 border border-2 border-dark rounded-5 p-3">
                    <div class="row d-flex justify-content-center align-items-center">
                        <div class="col-md-12 text-center">
                            @if ($group->group_icon)
                            <img src="{{ asset('storage/group_icons/' . $group->group_icon )}}" alt="group_icon" class="img-fluid rounded-circle border border-3" style="width: 120px; height: 120px;">
                            @else
                            <div class="group_icon-placeholder rounded-circle" style="width: 120px; height: 120px; background-color: #CCCCCC;"></div>
                            @endif
                        </div>
                        <div class="col-md-12 text-center">
                            <p class="mt-2">{{$group->group_name}}</p>
                            <div class="p-4" style="border-top: 1px solid black">
                                <p>{{$group->group_description}}</p>
                            </div>
                        </div>
                        @if ($group_user_exists)
                            <div class="col-md-6 text-center">
                                {{-- <a class="btn btn-success" href="{{route('groupChat.groupShow',['group' => $group->id])}}">トーク</a> --}}
                                <a href="{{ route('groupChat.groupShow',['group' => $group->id]) }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-wechat" viewBox="0 0 16 16">
                                        <path d="M11.176 14.429c-2.665 0-4.826-1.8-4.826-4.018 0-2.22 2.159-4.02 4.824-4.02S16 8.191 16 10.411c0 1.21-.65 2.301-1.666 3.036a.324.324 0 0 0-.12.366l.218.81a.616.616 0 0 1 .029.117.166.166 0 0 1-.162.162.177.177 0 0 1-.092-.03l-1.057-.61a.519.519 0 0 0-.256-.074.509.509 0 0 0-.142.021 5.668 5.668 0 0 1-1.576.22ZM9.064 9.542a.647.647 0 1 0 .557-1 .645.645 0 0 0-.646.647.615.615 0 0 0 .09.353Zm3.232.001a.646.646 0 1 0 .546-1 .645.645 0 0 0-.644.644.627.627 0 0 0 .098.356Z"/>
                                        <path d="M0 6.826c0 1.455.781 2.765 2.001 3.656a.385.385 0 0 1 .143.439l-.161.6-.1.373a.499.499 0 0 0-.032.14.192.192 0 0 0 .193.193c.039 0 .077-.01.111-.029l1.268-.733a.622.622 0 0 1 .308-.088c.058 0 .116.009.171.025a6.83 6.83 0 0 0 1.625.26 4.45 4.45 0 0 1-.177-1.251c0-2.936 2.785-5.02 5.824-5.02.05 0 .1 0 .15.002C10.587 3.429 8.392 2 5.796 2 2.596 2 0 4.16 0 6.826Zm4.632-1.555a.77.77 0 1 1-1.54 0 .77.77 0 0 1 1.54 0Zm3.875 0a.77.77 0 1 1-1.54 0 .77.77 0 0 1 1.54 0Z"/>
                                    </svg>
                                    <p style="font-size: 1.5rem;">トーク</p>
                                </a>
                            </div>
                            <div class="col-md-6 text-center">
                                <a href="#">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                                        <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0Zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4Zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10Z"/>
                                    </svg>
                                    <p style="font-size: 1.5rem;">メンバー</p>
                                </a>
                            </div>
                        @else
                            <div class="col-md-6 text-center">
                                <form action="{{route('groupChat.participate', ['group_id' => $group->id])}}" method="post">
                                    @csrf
                                    {{-- <button class="btn btn-success">参加する</button> --}}
                                    <button class="btn btn-success">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-person-fill-up" viewBox="0 0 16 16">
                                            <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7Zm.354-5.854 1.5 1.5a.5.5 0 0 1-.708.708L13 11.707V14.5a.5.5 0 0 1-1 0v-2.793l-.646.647a.5.5 0 0 1-.708-.708l1.5-1.5a.5.5 0 0 1 .708 0ZM11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                                            <path d="M2 13c0 1 1 1 1 1h5.256A4.493 4.493 0 0 1 8 12.5a4.49 4.49 0 0 1 1.544-3.393C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4Z"/>
                                        </svg>
                                        <p style="font-size: 1.5rem; margin-bottom: 0;">参加する</p>
                                    </button>
                                </form>
                            </div>
                            <div class="col-md-6 text-center">
                                <a href="#">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                                        <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0Zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4Zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10Z"/>
                                    </svg>
                                    <p style="font-size: 1.5rem; margin-bottom: 0;">メンバー</p>
                                </a>
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
