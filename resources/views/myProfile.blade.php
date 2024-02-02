@extends('layouts.layout')

@section('title','プロフィール画面')

@section('main')
<div class="container mt-5">
    <div class="row justify-content-center align-items-center">
        @if ($errors->any())
            <ul class="mt-2" style="margin-bottom: 0; list-style: none;">
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
            <h1 class="text-center my-4" style="font-weight: bold;">プロフィール画面</h1>
            <hr style="border: 3px solid #8c8b8b;">
            <form action="{{ route('updateProfile', ['user' => $user->id]) }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group mb-3" style="font-size: 1.5rem;">
                    <label for="name">名前</label>
                    <input type="text" class="form-control border border-2" name="name" id="name" value="{{$user->name}}" required>
                </div>
                <div class="form-group mb-3" style="font-size: 1.5rem;">
                    <label for="email">メールアドレス</label>
                    <input type="email" class="form-control border border-2" name="email" id="email" value="{{$user->email}}" required>
                </div>
                <div class="form-group mb-3" style="font-size: 1.5rem;">
                    <label for="password">パスワード</label>
                    <input type="password" class="form-control border border-2" name="password" id="password" value="{{$user->password}}" required>
                </div>
                <div class="form-group mb-3" style="font-size: 1.5rem; height: 250px;">
                    <label for="icon">アイコン画像</label>
                    <input type="file" class="form-control-file" name="icon" id="icon" onchange="previewImage()" value="{{$user->icon}}">
                    <div class="d-flex justify-content-center align-items-center">
                        @if ($user->icon)
                            <div style="margin-top: 10px">
                                <img src="{{ asset('storage/icons/' . $user->icon )}}" alt="icon" class="img-fluid rounded-circle" style="width: 150px; height: 150px;">
                            </div>
                            <div class="mx-4">
                                <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-forward" viewBox="0 0 16 16">
                                    <path d="M9.502 5.513a.144.144 0 0 0-.202.134V6.65a.5.5 0 0 1-.5.5H2.5v2.9h6.3a.5.5 0 0 1 .5.5v1.003c0 .108.11.176.202.134l3.984-2.933a.51.51 0 0 1 .042-.028.147.147 0 0 0 0-.252.51.51 0 0 1-.042-.028L9.502 5.513zM8.3 5.647a1.144 1.144 0 0 1 1.767-.96l3.994 2.94a1.147 1.147 0 0 1 0 1.946l-3.994 2.94a1.144 1.144 0 0 1-1.767-.96v-.503H2a.5.5 0 0 1-.5-.5v-3.9a.5.5 0 0 1 .5-.5h6.3v-.503z"/>
                                </svg>
                            </div>
                            <img id="preview">
                        @else
                            <img id="preview">
                        @endif
                    </div>
                </div>
                <div class="mb-4 text-center">
                    <button type="submit" class="btn btn-primary btn-block" style="font-size: 1.5rem; width: 150px;">更新</button>
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
