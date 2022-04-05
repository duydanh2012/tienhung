@extends('public.index')
@section('title', 'Thay đổi thông tin cá nhân')
@section('content')
    <div class="container">
        <div class="row">
            @include('public.partials.user.change')

            @include('public.partials.user.widget')
        </div>
    </div>
@endsection