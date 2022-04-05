@extends('admin.layouts.index')
@section('title', 'Trả lời')
@section('content')
    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">

            <h1 class="app-page-title">Trả lời</h1>
            <hr class="mb-4">

            <div class="row g-4 settings-section">
                <div class="col-12 col-md-12">
                    <div class="app-card app-card-settings shadow-sm p-4">
                        @if (session('alert_success'))
                            <div class="alert alert-success">
                                {{session('alert_success')}}
                            </div>
                        @endif
                        <div class="app-card-body">
                            <form class="settings-form" action="{{ route('contact.update', $data->id) }}" method="POST">
                                @method('PUT')
                                 @csrf
                                <div class="mb-3">
                                    <label for="setting-input-1" class="form-label">Tên: <span>{{ $data->name }}</span></label>
                                </div>
                                <div class="mb-3">
                                    <label for="setting-input-2" class="form-label">Tiêu đề: <span>{{ $data->subject }}</span></label>
                                </div>
                                <div class="mb-3">
                                    <label for="setting-input-2" class="form-label">Nội dung: </label>
                                    <p>{{ $data->message }}</p>
                                </div>
                                <div class="mb-3">
                                    <label for="setting-input-2" class="form-label">Trả lời: </label>
                                    <textarea class="form-control" name="reply" id="setting-input-2" rows="3" style="height: 100px">{{ isset($data) ? $data->reply :  old('reply') }}</textarea>
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