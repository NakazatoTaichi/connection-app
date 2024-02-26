@extends('layouts.talkLayout')

@section('title','グループ作成画面')

@section('main')
<div class="container mt-5 w-75 p-3" style="margin: auto;">
    <div class="row align-items-center">
        <div class="col-md-9">
            <h1 class="mt-3" style="margin-bottom: 0;">グループ作成画面</h1>
        </div>
    </div>
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
    <div class="group-form py-4">
        <div class="row justify-content-center">
            <div class="col-md-6 p-3 border border-3 border-success rounded-5">
                <form action="{{ route('group.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mb-3" style="font-size: 1.5rem;">
                        <label for="group_name">グループ名</label>
                        <input type="text" class="form-control border-2" name="group_name" id="group_name" value="{{ old('group_name') }}" required>
                    </div>
                    <div class="form-group mb-3" style="font-size: 1.5rem;">
                        <label for="group_description">グループ情報</label>
                        <textarea type="text" class="form-control border-2" name="group_description" id="group_description" required>{{ old('group_description') }}</textarea>
                    </div>
                    <div class="form-group mb-3" style="font-size: 1.5rem;">
                        <label for="group_description">グループの公開状況</label>
                        <select name="status" class="form-control">
                            @foreach(\App\Models\Group::GROUP_STATUS as $key => $value)
                                <option value="{{ $key }}">{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-3" style="font-size: 1.5rem; height: 240px;">
                        <label for="group_icon">グループアイコン</label>
                        <input type="file" class="form-control-file" name="group_icon" id="group_icon" onchange="previewImage()">
                        <img id="preview">
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary btn-block" style="font-size: 1.5rem; width: 150px;">作成</button>
                    </div>
                </form>
            </div>
        </div>
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
