@extends('admin.layouts.index')
@section('title', 'Thêm bài viết')
@section('content')
<script src="https://cdn.ckeditor.com/4.12.1/standard/ckeditor.js"></script>
    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">

            <h1 class="app-page-title">Thêm bài viết</h1>
            <hr class="mb-4">

            <div class="row g-4 settings-section">
                <div class="col-12 col-md-12">
                    <div class="app-card app-card-settings shadow-sm p-4">
                        @if (count($errors) >0)
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li class="text-danger"> {{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                        <div class="app-card-body">
                            <form class="settings-form" action="{{ isset($data) ? route('posts.update', $data->id) : route('posts.store') }}" method="POST" enctype="multipart/form-data">
                                @if (isset($data))
                                    @method('PUT')
                                @endif
                                @csrf
                                <div class="mb-3">
                                    <label for="setting-input-1" class="form-label">Tên:</label>
                                    <input type="text" name="name" class="form-control" id="setting-input-1"
                                        value="{{ isset($data) ? $data->name :  old('name') }}" placeholder="Tên danh mục" required>
                                </div>
                                <div class="mb-3">
                                    <label for="setting-input-2" class="form-label">Mô tả:</label>
                                    <textarea class="form-control" name="description" id="setting-input-2" rows="3" style="height: 100px">{{ isset($data) ? $data->description :  old('description') }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="content" class="form-label">Nội dung bài viết:</label>
                                    <textarea class="form-control ckeditor" name="content" id="content">{!! isset($data) ? $data->content :  old('content') !!}</textarea>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="image" class="form-label">Hình ảnh</label>
                                            @if (isset($data))
                                                <p>
                                                    <img src="{{ asset($data->image) }}" alt="{{ $data->image }}" style="max-width: 200px; max-height: 200px;">
                                                </p>
                                            @endif
                                            
                                            <input type="file" name="image" id="image" class="form-control" accept="image/*" >
                                        </div>
                                        <div class="form-check form-switch mb-3">
                                            <input class="form-check-input" name="is_featured" type="checkbox" id="settings-switch-1" @if((isset($data->is_featured) && $data->is_featured == 1)  || (old('is_featured') == 1)) checked @endif>
                                            <label class="form-check-label" for="settings-switch-1">Bài viết nổi bật</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Danh mục</label>
                                        @php
                                            $value = [];
                                            if(isset($data)){
                                                $value = $data->categories->toArray();
                                            }
                                        @endphp
                                        @if (count($categories) > 0)
                                            @include('admin.posts.checkbox', ['data' => $categories, 'value' => $value])
                                        @endif
                                    </div>
                                </div>

                                <button type="submit" class="btn app-btn-primary">Save Changes</button>
                            </form>
                        </div>
                        <!--//app-card-body-->

                    </div>
                    <!--//app-card-->
                </div>
            </div>


        </div>
        <!--//container-fluid-->
    </div>
    <script type="text/javascript">
        CKEDITOR.replace('content', {
            filebrowserUploadUrl: "{{route('ckeditor.upload', ['_token' => csrf_token() ])}}",
            filebrowserUploadMethod: 'form'
        });
    </script>
@endsection