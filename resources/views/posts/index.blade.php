@extends('layouts.layout')

@section('title','投稿一覧画面')

@section('main')
<div class="container pt-3">
    <nav>
    <div class="nav nav-tabs border-bottom border-1 border-dark" id="nav-tab" role="tablist">
        <button class="nav-link active border border-1 border-dark" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true" style="font-size: 1.5rem; color:black;">ホーム</button>
        <button class="nav-link border border-1 border-dark" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false" style="font-size: 1.5rem; color:black;">あなたの投稿</button>
        <button class="nav-link border border-1 border-dark" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false" style="font-size: 1.5rem; color:black;">友だちの投稿</button>
    </div>
    </nav>
    <div class="tab-content" id="nav-tabContent">
    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab" tabindex="0">
        <div class="m-4" style="width: fit-content;">
            <a class="btn btn-primary d-flex align-items-center" href="{{route('post.create')}}">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-plus-circle-dotted" viewBox="0 0 16 16">
                    <path d="M8 0c-.176 0-.35.006-.523.017l.064.998a7.117 7.117 0 0 1 .918 0l.064-.998A8.113 8.113 0 0 0 8 0zM6.44.152c-.346.069-.684.16-1.012.27l.321.948c.287-.098.582-.177.884-.237L6.44.153zm4.132.271a7.946 7.946 0 0 0-1.011-.27l-.194.98c.302.06.597.14.884.237l.321-.947zm1.873.925a8 8 0 0 0-.906-.524l-.443.896c.275.136.54.29.793.459l.556-.831zM4.46.824c-.314.155-.616.33-.905.524l.556.83a7.07 7.07 0 0 1 .793-.458L4.46.824zM2.725 1.985c-.262.23-.51.478-.74.74l.752.66c.202-.23.418-.446.648-.648l-.66-.752zm11.29.74a8.058 8.058 0 0 0-.74-.74l-.66.752c.23.202.447.418.648.648l.752-.66zm1.161 1.735a7.98 7.98 0 0 0-.524-.905l-.83.556c.169.253.322.518.458.793l.896-.443zM1.348 3.555c-.194.289-.37.591-.524.906l.896.443c.136-.275.29-.54.459-.793l-.831-.556zM.423 5.428a7.945 7.945 0 0 0-.27 1.011l.98.194c.06-.302.14-.597.237-.884l-.947-.321zM15.848 6.44a7.943 7.943 0 0 0-.27-1.012l-.948.321c.098.287.177.582.237.884l.98-.194zM.017 7.477a8.113 8.113 0 0 0 0 1.046l.998-.064a7.117 7.117 0 0 1 0-.918l-.998-.064zM16 8a8.1 8.1 0 0 0-.017-.523l-.998.064a7.11 7.11 0 0 1 0 .918l.998.064A8.1 8.1 0 0 0 16 8zM.152 9.56c.069.346.16.684.27 1.012l.948-.321a6.944 6.944 0 0 1-.237-.884l-.98.194zm15.425 1.012c.112-.328.202-.666.27-1.011l-.98-.194c-.06.302-.14.597-.237.884l.947.321zM.824 11.54a8 8 0 0 0 .524.905l.83-.556a6.999 6.999 0 0 1-.458-.793l-.896.443zm13.828.905c.194-.289.37-.591.524-.906l-.896-.443c-.136.275-.29.54-.459.793l.831.556zm-12.667.83c.23.262.478.51.74.74l.66-.752a7.047 7.047 0 0 1-.648-.648l-.752.66zm11.29.74c.262-.23.51-.478.74-.74l-.752-.66c-.201.23-.418.447-.648.648l.66.752zm-1.735 1.161c.314-.155.616-.33.905-.524l-.556-.83a7.07 7.07 0 0 1-.793.458l.443.896zm-7.985-.524c.289.194.591.37.906.524l.443-.896a6.998 6.998 0 0 1-.793-.459l-.556.831zm1.873.925c.328.112.666.202 1.011.27l.194-.98a6.953 6.953 0 0 1-.884-.237l-.321.947zm4.132.271a7.944 7.944 0 0 0 1.012-.27l-.321-.948a6.954 6.954 0 0 1-.884.237l.194.98zm-2.083.135a8.1 8.1 0 0 0 1.046 0l-.064-.998a7.11 7.11 0 0 1-.918 0l-.064.998zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"/>
                </svg>
                <span style="font-size: 1.5rem; margin-left: 5px;">投稿</span>
            </a>
        </div>
        <div class="mb-5 post-list d-flex">
            @foreach($posts as $post)
            <div class="col-5">
                <div class="card mx-4 border border-2 border-dark" style="height: auto" id="posting-{{ $post->id }}">
                    <div class="post-header d-flex align-items-center">
                        @if ($post->user->icon)
                            <img src="{{ asset('storage/icons/' . $post->user->icon )}}" alt="icon" class="img-fluid rounded-circle m-2" style="width: 50px; height: 50px;">
                        @else
                            <div class="icon-placeholder rounded-circle m-2" style="width: 50px; height: 50px; background-color: #CCCCCC;"></div>
                        @endif
                        <p style="margin-left: 10px; margin-bottom: 0; font-size: 1.75rem;">{{$post->user->name}}</p>
                    </div>
                    @if ($post->image)
                        <img src="{{ asset('storage/images/' . $post->image )}}" alt="image" class="img-fluid card-img-top border border-1 border-dark" style="height: 30vh;">
                    @endif
                    <div class="card-body">
                        <h3 class="card-title">{{$post->title}}</h3>
                        <div class="card-text my-3" style="overflow: hidden; width: 100%; height: 50px;">
                            <p class="" style="font-size: 1rem; margin: 0;">{{$post->content}}</p>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="comment-action">
                                <a style="color:black;" href="{{ route('post.show', ['post' => $post->id]) }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-chat-dots" viewBox="0 0 16 16">
                                        <path d="M5 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
                                        <path d="m2.165 15.803.02-.004c1.83-.363 2.948-.842 3.468-1.105A9.06 9.06 0 0 0 8 15c4.418 0 8-3.134 8-7s-3.582-7-8-7-8 3.134-8 7c0 1.76.743 3.37 1.97 4.6a10.437 10.437 0 0 1-.524 2.318l-.003.011a10.722 10.722 0 0 1-.244.637c-.079.186.074.394.273.362a21.673 21.673 0 0 0 .693-.125zm.8-3.108a1 1 0 0 0-.287-.801C1.618 10.83 1 9.468 1 8c0-3.192 3.004-6 7-6s7 2.808 7 6c0 3.193-3.004 6-7 6a8.06 8.06 0 0 1-2.088-.272 1 1 0 0 0-.711.074c-.387.196-1.24.57-2.634.893a10.97 10.97 0 0 0 .398-2z"/>
                                    </svg>
                                </a>
                                {{$post->comments->count()}}件
                            </div>
                            <div class="like-action">
                                @if ($post->getExistLike($post->id, $user))
                                    <form action="{{ route('postingPostUnlike', $post) }}" method="POST" class="d-inline-flex align-items-center" style="margin: 0;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" style="color: #ff69b4">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-suit-heart-fill" viewBox="0 0 16 16">
                                                <path d="M4 1c2.21 0 4 1.755 4 3.92C8 2.755 9.79 1 12 1s4 1.755 4 3.92c0 3.263-3.234 4.414-7.608 9.608a.513.513 0 0 1-.784 0C3.234 9.334 0 8.183 0 4.92 0 2.755 1.79 1 4 1z"/>
                                            </svg>
                                        </button>
                                    </form>
                                    {{$post->likes->count()}}いいね！
                                @else
                                    <form action="{{ route('postingPostLike', $post) }}" method="POST" class="d-inline-flex align-items-center" style="margin: 0; padding: 0;">
                                        @csrf
                                        <button type="submit">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-suit-heart" viewBox="0 0 16 16">
                                                <path d="m8 6.236-.894-1.789c-.222-.443-.607-1.08-1.152-1.595C5.418 2.345 4.776 2 4 2 2.324 2 1 3.326 1 4.92c0 1.211.554 2.066 1.868 3.37.337.334.721.695 1.146 1.093C5.122 10.423 6.5 11.717 8 13.447c1.5-1.73 2.878-3.024 3.986-4.064.425-.398.81-.76 1.146-1.093C14.446 6.986 15 6.131 15 4.92 15 3.326 13.676 2 12 2c-.777 0-1.418.345-1.954.852-.545.515-.93 1.152-1.152 1.595L8 6.236zm.392 8.292a.513.513 0 0 1-.784 0c-1.601-1.902-3.05-3.262-4.243-4.381C1.3 8.208 0 6.989 0 4.92 0 2.755 1.79 1 4 1c1.6 0 2.719 1.05 3.404 2.008.26.365.458.716.596.992a7.55 7.55 0 0 1 .596-.992C9.281 2.049 10.4 1 12 1c2.21 0 4 1.755 4 3.92 0 2.069-1.3 3.288-3.365 5.227-1.193 1.12-2.642 2.48-4.243 4.38z"/>
                                            </svg>
                                        </button>
                                    </form>
                                    {{$post->likes->count()}}いいね！
                                @endif
                            </div>
                            </div>
                            <p class="card-text text-end"><small class="text-body-secondary">{{$post->created_at->format('Y/m/d H:i')}}</small></p>
                        </div>
                    </div>
            </div>
            @endforeach
        </div>
    </div>
    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab" tabindex="0">
        <div class="m-4" style="width: fit-content;">
            <a class="btn btn-primary d-flex align-items-center" href="{{route('post.create')}}">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-plus-circle-dotted" viewBox="0 0 16 16">
                    <path d="M8 0c-.176 0-.35.006-.523.017l.064.998a7.117 7.117 0 0 1 .918 0l.064-.998A8.113 8.113 0 0 0 8 0zM6.44.152c-.346.069-.684.16-1.012.27l.321.948c.287-.098.582-.177.884-.237L6.44.153zm4.132.271a7.946 7.946 0 0 0-1.011-.27l-.194.98c.302.06.597.14.884.237l.321-.947zm1.873.925a8 8 0 0 0-.906-.524l-.443.896c.275.136.54.29.793.459l.556-.831zM4.46.824c-.314.155-.616.33-.905.524l.556.83a7.07 7.07 0 0 1 .793-.458L4.46.824zM2.725 1.985c-.262.23-.51.478-.74.74l.752.66c.202-.23.418-.446.648-.648l-.66-.752zm11.29.74a8.058 8.058 0 0 0-.74-.74l-.66.752c.23.202.447.418.648.648l.752-.66zm1.161 1.735a7.98 7.98 0 0 0-.524-.905l-.83.556c.169.253.322.518.458.793l.896-.443zM1.348 3.555c-.194.289-.37.591-.524.906l.896.443c.136-.275.29-.54.459-.793l-.831-.556zM.423 5.428a7.945 7.945 0 0 0-.27 1.011l.98.194c.06-.302.14-.597.237-.884l-.947-.321zM15.848 6.44a7.943 7.943 0 0 0-.27-1.012l-.948.321c.098.287.177.582.237.884l.98-.194zM.017 7.477a8.113 8.113 0 0 0 0 1.046l.998-.064a7.117 7.117 0 0 1 0-.918l-.998-.064zM16 8a8.1 8.1 0 0 0-.017-.523l-.998.064a7.11 7.11 0 0 1 0 .918l.998.064A8.1 8.1 0 0 0 16 8zM.152 9.56c.069.346.16.684.27 1.012l.948-.321a6.944 6.944 0 0 1-.237-.884l-.98.194zm15.425 1.012c.112-.328.202-.666.27-1.011l-.98-.194c-.06.302-.14.597-.237.884l.947.321zM.824 11.54a8 8 0 0 0 .524.905l.83-.556a6.999 6.999 0 0 1-.458-.793l-.896.443zm13.828.905c.194-.289.37-.591.524-.906l-.896-.443c-.136.275-.29.54-.459.793l.831.556zm-12.667.83c.23.262.478.51.74.74l.66-.752a7.047 7.047 0 0 1-.648-.648l-.752.66zm11.29.74c.262-.23.51-.478.74-.74l-.752-.66c-.201.23-.418.447-.648.648l.66.752zm-1.735 1.161c.314-.155.616-.33.905-.524l-.556-.83a7.07 7.07 0 0 1-.793.458l.443.896zm-7.985-.524c.289.194.591.37.906.524l.443-.896a6.998 6.998 0 0 1-.793-.459l-.556.831zm1.873.925c.328.112.666.202 1.011.27l.194-.98a6.953 6.953 0 0 1-.884-.237l-.321.947zm4.132.271a7.944 7.944 0 0 0 1.012-.27l-.321-.948a6.954 6.954 0 0 1-.884.237l.194.98zm-2.083.135a8.1 8.1 0 0 0 1.046 0l-.064-.998a7.11 7.11 0 0 1-.918 0l-.064.998zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"/>
                </svg>
                <span style="font-size: 1.5rem; margin-left: 5px;">投稿</span>
            </a>
        </div>
        <div class="mb-5 post-list d-flex">
            @foreach($user_posts as $user_post)
            <div class="col-5">
                <div class="card mx-4 border border-2 border-dark" style="height: auto">
                    <div class="post-header d-flex align-items-center">
                        @if ($user_post->user->icon)
                            <img src="{{ asset('storage/icons/' . $user_post->user->icon )}}" alt="icon" class="img-fluid rounded-circle m-2" style="width: 50px; height: 50px;">
                        @else
                            <div class="icon-placeholder rounded-circle m-2" style="width: 50px; height: 50px; background-color: #CCCCCC;"></div>
                        @endif
                        <p style="margin-left: 10px; margin-bottom: 0; font-size: 1.75rem;">{{$user_post->user->name}}</p>
                    </div>
                    @if ($user_post->image)
                        <img src="{{ asset('storage/images/' . $user_post->image )}}" alt="image" class="img-fluid card-img-top border border-1 border-dark" style="height: 30vh;">
                    @endif
                    <div class="card-body">
                        <h3 class="card-title">{{$user_post->title}}</h3>
                        <div class="card-text my-3" style="overflow: hidden; width: 100%; height: 50px;">
                            <p class="" style="font-size: 1rem; margin: 0;">{{$user_post->content}}</p>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="comment-action">
                                <a style="color:black;" href="{{ route('post.show', ['post' => $user_post->id]) }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-chat-dots" viewBox="0 0 16 16">
                                        <path d="M5 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
                                        <path d="m2.165 15.803.02-.004c1.83-.363 2.948-.842 3.468-1.105A9.06 9.06 0 0 0 8 15c4.418 0 8-3.134 8-7s-3.582-7-8-7-8 3.134-8 7c0 1.76.743 3.37 1.97 4.6a10.437 10.437 0 0 1-.524 2.318l-.003.011a10.722 10.722 0 0 1-.244.637c-.079.186.074.394.273.362a21.673 21.673 0 0 0 .693-.125zm.8-3.108a1 1 0 0 0-.287-.801C1.618 10.83 1 9.468 1 8c0-3.192 3.004-6 7-6s7 2.808 7 6c0 3.193-3.004 6-7 6a8.06 8.06 0 0 1-2.088-.272 1 1 0 0 0-.711.074c-.387.196-1.24.57-2.634.893a10.97 10.97 0 0 0 .398-2z"/>
                                    </svg>
                                </a>
                                {{$user_post->comments->count()}}件
                            </div>
                            <div class="like-action">
                                @if ($user_post->getExistLike($user_post->id, $user))
                                    <form action="{{ route('postingPostUnlike', $post) }}" method="POST" class="d-inline-flex align-items-center" style="margin: 0;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" style="color: #ff69b4">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-suit-heart-fill" viewBox="0 0 16 16">
                                                <path d="M4 1c2.21 0 4 1.755 4 3.92C8 2.755 9.79 1 12 1s4 1.755 4 3.92c0 3.263-3.234 4.414-7.608 9.608a.513.513 0 0 1-.784 0C3.234 9.334 0 8.183 0 4.92 0 2.755 1.79 1 4 1z"/>
                                            </svg>
                                        </button>
                                    </form>
                                    {{$user_post->likes->count()}}いいね！
                                @else
                                    <form action="{{ route('postingPostLike', $post) }}" method="POST" class="d-inline-flex align-items-center" style="margin: 0; padding: 0;">
                                        @csrf
                                        <button type="submit">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-suit-heart" viewBox="0 0 16 16">
                                                <path d="m8 6.236-.894-1.789c-.222-.443-.607-1.08-1.152-1.595C5.418 2.345 4.776 2 4 2 2.324 2 1 3.326 1 4.92c0 1.211.554 2.066 1.868 3.37.337.334.721.695 1.146 1.093C5.122 10.423 6.5 11.717 8 13.447c1.5-1.73 2.878-3.024 3.986-4.064.425-.398.81-.76 1.146-1.093C14.446 6.986 15 6.131 15 4.92 15 3.326 13.676 2 12 2c-.777 0-1.418.345-1.954.852-.545.515-.93 1.152-1.152 1.595L8 6.236zm.392 8.292a.513.513 0 0 1-.784 0c-1.601-1.902-3.05-3.262-4.243-4.381C1.3 8.208 0 6.989 0 4.92 0 2.755 1.79 1 4 1c1.6 0 2.719 1.05 3.404 2.008.26.365.458.716.596.992a7.55 7.55 0 0 1 .596-.992C9.281 2.049 10.4 1 12 1c2.21 0 4 1.755 4 3.92 0 2.069-1.3 3.288-3.365 5.227-1.193 1.12-2.642 2.48-4.243 4.38z"/>
                                            </svg>
                                        </button>
                                    </form>
                                    {{$user_post->likes->count()}}いいね！
                                @endif
                            </div>
                            </div>
                            <p class="card-text text-end"><small class="text-body-secondary">{{$user_post->created_at->format('Y/m/d H:i')}}</small></p>
                        </div>
                    </div>
            </div>
            @endforeach
        </div>
    </div>
    <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab" tabindex="0">
        <div class="m-4" style="width: fit-content;">
            <a class="btn btn-primary d-flex align-items-center" href="{{route('post.create')}}">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-plus-circle-dotted" viewBox="0 0 16 16">
                    <path d="M8 0c-.176 0-.35.006-.523.017l.064.998a7.117 7.117 0 0 1 .918 0l.064-.998A8.113 8.113 0 0 0 8 0zM6.44.152c-.346.069-.684.16-1.012.27l.321.948c.287-.098.582-.177.884-.237L6.44.153zm4.132.271a7.946 7.946 0 0 0-1.011-.27l-.194.98c.302.06.597.14.884.237l.321-.947zm1.873.925a8 8 0 0 0-.906-.524l-.443.896c.275.136.54.29.793.459l.556-.831zM4.46.824c-.314.155-.616.33-.905.524l.556.83a7.07 7.07 0 0 1 .793-.458L4.46.824zM2.725 1.985c-.262.23-.51.478-.74.74l.752.66c.202-.23.418-.446.648-.648l-.66-.752zm11.29.74a8.058 8.058 0 0 0-.74-.74l-.66.752c.23.202.447.418.648.648l.752-.66zm1.161 1.735a7.98 7.98 0 0 0-.524-.905l-.83.556c.169.253.322.518.458.793l.896-.443zM1.348 3.555c-.194.289-.37.591-.524.906l.896.443c.136-.275.29-.54.459-.793l-.831-.556zM.423 5.428a7.945 7.945 0 0 0-.27 1.011l.98.194c.06-.302.14-.597.237-.884l-.947-.321zM15.848 6.44a7.943 7.943 0 0 0-.27-1.012l-.948.321c.098.287.177.582.237.884l.98-.194zM.017 7.477a8.113 8.113 0 0 0 0 1.046l.998-.064a7.117 7.117 0 0 1 0-.918l-.998-.064zM16 8a8.1 8.1 0 0 0-.017-.523l-.998.064a7.11 7.11 0 0 1 0 .918l.998.064A8.1 8.1 0 0 0 16 8zM.152 9.56c.069.346.16.684.27 1.012l.948-.321a6.944 6.944 0 0 1-.237-.884l-.98.194zm15.425 1.012c.112-.328.202-.666.27-1.011l-.98-.194c-.06.302-.14.597-.237.884l.947.321zM.824 11.54a8 8 0 0 0 .524.905l.83-.556a6.999 6.999 0 0 1-.458-.793l-.896.443zm13.828.905c.194-.289.37-.591.524-.906l-.896-.443c-.136.275-.29.54-.459.793l.831.556zm-12.667.83c.23.262.478.51.74.74l.66-.752a7.047 7.047 0 0 1-.648-.648l-.752.66zm11.29.74c.262-.23.51-.478.74-.74l-.752-.66c-.201.23-.418.447-.648.648l.66.752zm-1.735 1.161c.314-.155.616-.33.905-.524l-.556-.83a7.07 7.07 0 0 1-.793.458l.443.896zm-7.985-.524c.289.194.591.37.906.524l.443-.896a6.998 6.998 0 0 1-.793-.459l-.556.831zm1.873.925c.328.112.666.202 1.011.27l.194-.98a6.953 6.953 0 0 1-.884-.237l-.321.947zm4.132.271a7.944 7.944 0 0 0 1.012-.27l-.321-.948a6.954 6.954 0 0 1-.884.237l.194.98zm-2.083.135a8.1 8.1 0 0 0 1.046 0l-.064-.998a7.11 7.11 0 0 1-.918 0l-.064.998zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"/>
                </svg>
                <span style="font-size: 1.5rem; margin-left: 5px;">投稿</span>
            </a>
        </div>
        <div class="mb-5 post-list d-flex">
            @foreach($friend_posts as $friend_post)
            <div class="col-5">
                <div class="card mx-4 border border-2 border-dark" style="height: auto">
                    <div class="post-header d-flex align-items-center">
                        @if ($friend_post->user->icon)
                            <img src="{{ asset('storage/icons/' . $friend_post->user->icon )}}" alt="icon" class="img-fluid rounded-circle m-2" style="width: 50px; height: 50px;">
                        @else
                            <div class="icon-placeholder rounded-circle m-2" style="width: 50px; height: 50px; background-color: #CCCCCC;"></div>
                        @endif
                        <p style="margin-left: 10px; margin-bottom: 0; font-size: 1.75rem;">{{$friend_post->user->name}}</p>
                    </div>
                    @if ($friend_post->image)
                        <img src="{{ asset('storage/images/' . $friend_post->image )}}" alt="image" class="img-fluid card-img-top border border-1 border-dark" style="height: 30vh;">
                    @endif
                    <div class="card-body">
                        <h3 class="card-title">{{$friend_post->title}}</h3>
                        <div class="card-text my-3" style="overflow: hidden; width: 100%; height: 50px;">
                            <p class="" style="font-size: 1rem; margin: 0;">{{$friend_post->content}}</p>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="comment-action">
                                <a style="color:black;" href="{{ route('post.show', ['post' => $friend_post->id]) }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-chat-dots" viewBox="0 0 16 16">
                                        <path d="M5 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
                                        <path d="m2.165 15.803.02-.004c1.83-.363 2.948-.842 3.468-1.105A9.06 9.06 0 0 0 8 15c4.418 0 8-3.134 8-7s-3.582-7-8-7-8 3.134-8 7c0 1.76.743 3.37 1.97 4.6a10.437 10.437 0 0 1-.524 2.318l-.003.011a10.722 10.722 0 0 1-.244.637c-.079.186.074.394.273.362a21.673 21.673 0 0 0 .693-.125zm.8-3.108a1 1 0 0 0-.287-.801C1.618 10.83 1 9.468 1 8c0-3.192 3.004-6 7-6s7 2.808 7 6c0 3.193-3.004 6-7 6a8.06 8.06 0 0 1-2.088-.272 1 1 0 0 0-.711.074c-.387.196-1.24.57-2.634.893a10.97 10.97 0 0 0 .398-2z"/>
                                    </svg>
                                </a>
                                {{$friend_post->comments->count()}}件
                            </div>
                            <div class="like-action">
                                @if ($friend_post->getExistLike($friend_post->id, $user))
                                    <form action="{{ route('postingPostUnlike', $post) }}" method="POST" class="d-inline-flex align-items-center" style="margin: 0;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" style="color: #ff69b4">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-suit-heart-fill" viewBox="0 0 16 16">
                                                <path d="M4 1c2.21 0 4 1.755 4 3.92C8 2.755 9.79 1 12 1s4 1.755 4 3.92c0 3.263-3.234 4.414-7.608 9.608a.513.513 0 0 1-.784 0C3.234 9.334 0 8.183 0 4.92 0 2.755 1.79 1 4 1z"/>
                                            </svg>
                                        </button>
                                    </form>
                                    {{$friend_post->likes->count()}}いいね！
                                @else
                                    <form action="{{ route('postingPostLike', $post) }}" method="POST" class="d-inline-flex align-items-center" style="margin: 0; padding: 0;">
                                        @csrf
                                        <button type="submit">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-suit-heart" viewBox="0 0 16 16">
                                                <path d="m8 6.236-.894-1.789c-.222-.443-.607-1.08-1.152-1.595C5.418 2.345 4.776 2 4 2 2.324 2 1 3.326 1 4.92c0 1.211.554 2.066 1.868 3.37.337.334.721.695 1.146 1.093C5.122 10.423 6.5 11.717 8 13.447c1.5-1.73 2.878-3.024 3.986-4.064.425-.398.81-.76 1.146-1.093C14.446 6.986 15 6.131 15 4.92 15 3.326 13.676 2 12 2c-.777 0-1.418.345-1.954.852-.545.515-.93 1.152-1.152 1.595L8 6.236zm.392 8.292a.513.513 0 0 1-.784 0c-1.601-1.902-3.05-3.262-4.243-4.381C1.3 8.208 0 6.989 0 4.92 0 2.755 1.79 1 4 1c1.6 0 2.719 1.05 3.404 2.008.26.365.458.716.596.992a7.55 7.55 0 0 1 .596-.992C9.281 2.049 10.4 1 12 1c2.21 0 4 1.755 4 3.92 0 2.069-1.3 3.288-3.365 5.227-1.193 1.12-2.642 2.48-4.243 4.38z"/>
                                            </svg>
                                        </button>
                                    </form>
                                    {{$friend_post->likes->count()}}いいね！
                                @endif
                            </div>
                            </div>
                            <p class="card-text text-end"><small class="text-body-secondary">{{$friend_post->created_at->format('Y/m/d H:i')}}</small></p>
                        </div>
                    </div>
            </div>
            @endforeach
        </div>
    </div>
    </div>
</div>
@endsection
<style>
    .nav-tabs button:hover {
        background-color:darkgray;
        border: 2px solid darkgray;
    }
    .post-list::-webkit-scrollbar {
        display: none;
    }
    .post-list {
        overflow-x: auto;
    }
    .card {
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.5);
    }
    .card-text p {
        display: -webkit-box;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 2;
    }
    .comment-action a:hover {
        color:dodgerblue!important;
    }
    .like-action button {
        border: none;
        outline: none;
        background: transparent;
    }
</style>
<script>
    window.addEventListener('load', function() {
        const params = new URLSearchParams(window.location.search);
        const postId = params.get('post');
        if (postId) {
            const element = document.getElementById('posting-' + postId);
            if (element) {
                element.scrollIntoView({ behavior: 'smooth', inline: 'start' });
            }
        }
    });
</script>
