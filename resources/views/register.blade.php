@extends('layouts.subLayout')

@section('title','新規登録画面')

@section('main')
<div class="container">
    <div class="row justify-content-center align-items-center" style="height: 100vh;">
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
        <div class="col-md-6 px-5 border border-3 border-secondary-subtle rounded-5">
            <h1 class="text-center my-4" style="font-weight: bold;">新規登録</h1>
            <hr style="border: 3px solid #8c8b8b;">
            <form action="{{ route('register') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group mb-3" style="font-size: 1.5rem;">
                    <label for="name">名前</label>
                    <input type="text" class="form-control border border-2" name="name" id="name" value="{{ old('name') }}" required>
                </div>
                <div class="form-group mb-3" style="font-size: 1.5rem;">
                    <label for="email">メールアドレス</label>
                    <input type="email" class="form-control border border-2" name="email" id="email" value="{{ old('email') }}" required>
                </div>
                <div class="form-group mb-3" style="font-size: 1.5rem;">
                    <label for="password">パスワード</label>
                    <input type="password" class="form-control border border-2" name="password" id="password" value="{{ old('password') }}" required>
                </div>
                <div class="form-group mb-3" style="font-size: 1.5rem; height: 250px;">
                    <label for="icon">アイコン画像</label>
                    <input type="file" class="form-control-file" name="icon" id="icon" onchange="previewImage()">
                    <img id="preview">
                </div>
                <div class="mb-4 text-center">
                    <button type="submit" class="btn btn-primary btn-block" style="font-size: 1.5rem; width: 150px;">登録</button>
                </div>
            </form>
        </div>
    </div>
</div>
    <style>
    #preview {
        max-width: 100%;
        height: auto;
        margin-top: 10px;
        max-height: 150px;
    }
    </style>
    <script>
        function previewImage() {
            var preview = document.getElementById('preview');
            var fileInput = document.getElementById('icon');
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
