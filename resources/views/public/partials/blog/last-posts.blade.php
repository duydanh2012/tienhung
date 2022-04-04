@php
  $posts = lastPost();
@endphp

<div class="widget latest-posts">
    <header>
      <h3 class="h6">Bài viết mới nhất</h3>
    </header>
    <div class="blog-posts">
      @foreach ($posts as $item)
        <a href="{{ getUrl($item) }}">
          <div class="item d-flex align-items-center">
            <div class="image"><img src="{{ asset($item->image) }}" alt="{{ $item->name }}" class="img-fluid"></div>
            <div class="title"><strong>{{ $item->name }}</strong>
              <div class="d-flex align-items-center">
                <div class="views"><i class="far fa-eye"></i> {{ $item->views }}</div>
                <div class="comments"><i class="fas fa-comment-alt"></i> {{ countComment($item->id) }}</div>
              </div>
            </div>
          </div>
        </a>
      @endforeach
    </div>
  </div>