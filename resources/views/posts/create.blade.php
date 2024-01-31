@extends('layouts.layout')

@section('title','投稿作成画面')

@section('main')
<div class="container pt-3">
    <h1 style="margin-bottom: 0;">投稿作成画面</h1>
    @if ($errors->any())
        <ul style="margin-bottom: 0; list-style: none;">
            @foreach ($errors->all() as $error)
                <li>
                    <div class="alert alert-danger">
                        {{ $error }}
                    </div>
                </li>
            @endforeach
        </ul>
    @endif
    <div class="post-form">
        <div class="row d-flex justify-content-center">
            <div class="my-3 col-md-10 border border-3 border-info rounded-5">
                <div class="post-form p-4">
                    <form action="{{ route('post.store', ['user_id' => $user->id ]) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="form-group mb-3 col-12" style="font-size: 1.5rem; width: 500px;">
                                <label for="title"><b>タイトル</b></label>
                                <input type="text" class="form-control border border-2" style="font-size: 1.5rem;" name="title" id="title" value="{{ old('title') }}" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group mb-3 col-6 p-3" style="height: 240px; font-size: 1.25rem;">
                                <label for="image" style="font-size: 1.5rem;"><b>投稿する写真</b></label>
                                <input type="file" class="form-control-file border border-2" name="image" id="image" onchange="previewImage()">
                                <img id="preview">
                            </div>
                            <div class="form-group mb-3 col-6 p-3" style="font-size: 1.5rem;">
                                <label for="content"><b>内容</b></label>
                                <textarea type="text" rows="8" class="form-control border border-2" name="content" id="content" style="font-size: 1.5rem;" required>{{ old('content') }}</textarea>
                            </div>
                        </div>
                        <div class="mb-3 text-center">
                            <button type="submit" class="btn btn-primary btn-block" style="font-size: 1.5rem; width: 200px;">投稿する</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="text-end">
        <a class="btn btn-primary" href="{{route('post.index')}}">戻る</a>
    </div>
</div>
<style>
    #preview {
        max-width: 100%;
        height: auto;
        margin-top: 10px;
        max-height: 250px;
    }
    </style>
    <script>
        function previewImage() {
            var preview = document.getElementById('preview');
            var fileInput = document.getElementById('image');
            var file = fileInput.files[0];
            var reader = new FileReader();

            reader.onloadend = function () {
                preview.src = reader.result;
            };

            if (file) {
                reader.readAsDataURL(file);
            } else {
                preview.src = "#";
            }
        }
    </script>
@endsection
