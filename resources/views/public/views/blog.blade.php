@extends('public.index')
@section('title', isset($category) ? $category->name : 'Tin tức')
@section('content')
    <div class="container">
        <div class="row">
            @if (isset($category))
                @include('public.partials.blog.list-post', ['category' => $category, 'data' => $data])
            @else
                @include('public.partials.blog.list-post')
            @endif

            @include('public.partials.blog.widget')
        </div>
    </div>
@endsection