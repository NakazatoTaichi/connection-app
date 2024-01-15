@extends('layouts.layout')

@section('title','投稿作成画面')

@section('main')
<div class="container pt-3">
    <h1>投稿作成画面</h1>
    <div class="post-form">
        <div class="row justify-content-center">
            <div class="col-md-8 bg-info-subtle">
                <form action="{{ route('post.store', ['user_id' => $user->id ]) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mb-3" style="font-size: 1.5rem; width: 500px;">
                        <label for="title">タイトル</label>
                        <input type="text" class="form-control" name="title" id="title">
                    </div>
                    <div class="form-group mb-3" style="font-size: 1.5rem; height: 240px;">
                        <label for="image">イメージ画像</label>
                        <input type="file" class="form-control-file" name="image" id="image" onchange="previewImage()">
                        <img id="preview">
                    </div>
                    <div class="form-group mb-3" style="font-size: 1.5rem;">
                        <label for="content">内容</label>
                        <textarea type="text" class="form-control" name="content" id="content"  style="height: 150px;"></textarea>
                    </div>
                    <div class="mb-4 text-center">
                        <button type="submit" class="btn btn-primary btn-block" style="font-size: 1.5rem; width: 150px;">投稿する</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="my-3 text-end">
        <a class="btn btn-primary" href="{{route('post.index')}}">戻る</a>
    </div>
</div>
<style>
    #preview {
        max-width: 100%;
        height: auto;
        margin-top: 10px;
        max-height: 160px;
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
