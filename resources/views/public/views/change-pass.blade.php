@extends('public.index')
@section('title', 'Thay đổi mật khẩu')
@section('content')
    <div class="container">
        <div class="row">
            @include('public.partials.user.change-pass')

            @include('public.partials.user.widget')
        </div>
    </div>
@endsection