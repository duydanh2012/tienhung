@extends('admin.layouts.index')
@section('title', 'Thêm danh mục')
@section('content')
    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">

            <h1 class="app-page-title">Danh mục</h1>
            <hr class="mb-4">

            <div class="row g-4 settings-section">
                <div class="col-12 col-md-12">
                    <div class="app-card app-card-settings shadow-sm p-4">

                        <div class="app-card-body">
                            <form class="settings-form" action="{{ isset($data) ? route('categories.update', $data->id) : route('categories.store') }}" method="POST">
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
                                    <textarea class="form-control" name="description" id="setting-input-2" rows="3" style="height: 100px">
                                        {{ isset($data) ? $data->description :  old('description') }}
                                    </textarea>
                                    {{-- <input type="text"  name="description" class="form-control" id="setting-input-2" value="{{ isset($data) ? $data->description :  old('description') }}" placeholder="Mô tả" > --}}
                                </div>
                                <div class="mb-3">
                                    <label for="setting-input-3" class="form-label">Danh mục cha</label>
                                    <select name="parent_id" id="parent_id" class="form-control">
                                        <option value="0">Không</option>
                                        @foreach ($categories as $key => $value)
                                            <option value="{{ $key }}" {{ isset($data) ? (($data->parent->id == $key) ? 'selected' : null ) : null }}>{{ $value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-check form-switch mb-3">
                                    <input class="form-check-input" name="menu" type="checkbox" id="settings-switch-1" @if((isset($data->menu) && $data->menu == 1) || (old('menu') == 1)) checked @endif>
                                    <label class="form-check-label" for="settings-switch-1">Thêm vào menu</label>
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
@endsection