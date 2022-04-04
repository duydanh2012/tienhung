@extends('public.index')
@section('title', $data->name)
@section('content')
    <div class="container">
        <div class="row">
            @include('public.partials.blog.post', ['data' => $data])

            @include('public.partials.blog.widget')
        </div>
    </div>
@endsection