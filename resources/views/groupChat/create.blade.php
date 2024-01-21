@extends('layouts.layout');

@section('title','グループチャット作成画面')

@section('main')
    <div class="container pt-3">
        <h1 class="mb-4">グループチャット作成画面</h1>
        <div class="group-form">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <form action="{{ route('groupChat.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-3" style="font-size: 1.5rem;">
                            <label for="group_name">グループ名</label>
                            <input type="text" class="form-control" name="group_name" id="group_name">
                        </div>
                        <div class="form-group mb-3" style="font-size: 1.5rem;">
                            <label for="group_description">グループ情報</label>
                            <textarea type="text" class="form-control" name="group_description" id="group_description"></textarea>
                        </div>
                        <div class="form-group mb-3" style="font-size: 1.5rem; height: 240px;">
                            <label for="group_icon">イメージ画像</label>
                            <input type="file" class="form-control-file" name="group_icon" id="group_icon" onchange="previewImage()">
                            <img id="preview">
                        </div>
                        <div class="mb-4 text-center">
                            <button type="submit" class="btn btn-primary btn-block" style="font-size: 1.5rem; width: 150px;">作成</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="my-3 text-end">
            <a class="btn btn-primary" href="{{route('groupChat.index')}}">戻る</a>
        </div>
    </div>
@endsection

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
        var fileInput = document.getElementById('group_icon');
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
