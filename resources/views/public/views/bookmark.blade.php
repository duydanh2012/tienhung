@extends('public.index')
@section('title', 'Các bài viết đã lưu')
@section('content')
    <div class="container">
        <div class="row">
            @include('public.partials.user.bookmark', ['posts' => $posts])

            @include('public.partials.user.widget')
        </div>
    </div>
@endsection