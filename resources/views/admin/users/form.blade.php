@extends('admin.layouts.index')
@section('title', 'Thêm danh mục')
@section('content')
    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">

            <h1 class="app-page-title">Thay đổi thông tin người dùng</h1>
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
                        @if (session('alert_error'))
                            <div class="alert alert-danger">
                                {{session('alert_error')}}
                            </div>
                        @elseif (session('alert_success'))
                            <div class="alert alert-success">
                                {{session('alert_success')}}
                            </div>
                        @endif
                        <div class="app-card-body">
                            <form class="settings-form" action="{{ isset($data) ? route('users.update', $data->id) : route('users.store') }}" method="POST">
                                @if (isset($data))
                                    @method('PUT')
                                @endif
                                @csrf
                                <div class="mb-3">
                                    <label for="setting-input-1" class="form-label">Tên:</label>
                                    <input type="text" name="name" class="form-control" id="setting-input-1"
                                        value="{{ isset($data) ? $data->name :  old('name') }}" placeholder="Họ và tên" required>
                                </div>
                                <div class="mb-3">
                                    <label for="setting-input-2" class="form-label">Email:</label>
                                    <input type="email" name="email" class="form-control" id="setting-input-2"
                                        value="{{ isset($data) ? $data->email :  old('email') }}" placeholder="Email" required>
                                </div>
                                <div class="mb-3">
                                    <label for="setting-input-3" class="form-label">Số điện thoại</label>
                                    <div class="row">
                                        <div class="col-1">
                                            <p class="form-control">
                                                +84
                                            </p>
                                        </div>
                                        <div class="col-11">
                                            <input type="text" name="phone" class="form-control" id="setting-input-3"
                                                value="{{ isset($data) ? $data->phone :  old('phone') }}" placeholder="Số điện thoại" maxlength="9">
                                        </div>
                                    </div>
                                    
                                </div>

                                @if (!isset($data))
                                    <div class="mb-3">
                                        <label for="setting-input-4" class="form-label">Password:</label>
                                        <input type="password" name="password" class="form-control" id="setting-input-4"
                                            value="{{ isset($data) ? $data->password :  old('password') }}" placeholder="Nhập mật khẩu">
                                    </div>                               
                                @endif

                                <div class="mb-3">
                                    <label for="admin" class="form-label">Quyền quản trị viên</label>
                                    <select name="admin" id="admin" class="form-control">
                                        <option value="0">Không</option>
                                        <option value="1" @if(isset($data) && ($data->admin == 1)) selected @endif>Quản trị viên</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn app-btn-primary">Save Changes</button>
                                @if (isset($data))
                                    <a href="{{ route('users.forget', $data->id) }}" class="btn app-btn-secondary">Reset Mật khẩu</a>
                                @endif
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
    <script>
        $(document).ready(function(){
            $('input[name="phone"]').keyup(function(e)
            {
                if (/\D/g.test(this.value))
                {

                    this.value = this.value.replace(/\D/g, '');
                }
            });
        })

    </script>
@endsection