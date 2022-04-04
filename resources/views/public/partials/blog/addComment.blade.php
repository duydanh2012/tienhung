<div class="comment-header d-flex justify-content-between">
    <div class="user d-flex align-items-center">
        <div class="image"><img src="{{ asset('assets/images/app-logo.svg') }}" alt="{{ $comment->user }}" class="img-fluid rounded-circle"></div>
        <div class="title"><strong>{{ $comment->user }}</strong><span class="date">{{ date("d/m/Y", strtotime($comment->created_at) ) }}</span></div>
    </div>
</div>
<div class="comment-body">
    <p>{{ $comment->comment }}</p>
</div>