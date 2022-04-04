@php
    $comments = getCommentWithPost($post);
@endphp

@if ($comments->count() > 0)
    @foreach ($comments as $item)
        <div class="comment">
            <div class="comment-header d-flex justify-content-between">
                <div class="user d-flex align-items-center">
                    <div class="image"><img src="{{ asset('assets/images/app-logo.svg') }}" alt="{{ $item->user->name }}" class="img-fluid rounded-circle"></div>
                    <div class="title"><strong>{{ $item->user->name }}</strong><span class="date">{{ date("d/m/Y", strtotime($item->created_at) ) }}</span></div>
                </div>
            </div>
            <div class="comment-body">
                <p>{{ $item->comment }}</p>
            </div>
        </div>
    @endforeach
    @if ($comments->count() > 5)
        <a href="javascript:void(0);" data-value="{{ $comments->count() }}" data-current="4" class="font-weight-bold showMoreComment">Hiển thị thêm bình luận</a>
        <a href="javascript:void(0);"  class="font-weight-bold hideComment">Ẩn bớt bình luận</a>
    @endif
@else
    <p class="none-comment">Không có bình luận</p>
@endif
