@php
  $posts = lastPost();
@endphp

<section class="latest-posts"> 
  <div class="container">
    <header> 
      <h2>Bài viết mới nhất</h2>
      <p class="text-big">Cùng nhau cập nhật những tin tức mới nhất!</p>
    </header>
    <div class="row">
      @foreach ($posts as $item)
        <div class="post col-md-4">
          <div class="post-thumbnail"><a href="{{ getUrl($item) }}"><img src="{{ asset($item->image) }}" alt="{{ $item->name }}" class="img-fluid"></a></div>
          <div class="post-details">
            <div class="post-meta d-flex justify-content-between">
              <div class="date">{{ date("d/m/Y", strtotime($item->created_at)) }}</div>
              <div class="category">{{ getUser($item) }}</div>
            </div><a href="{{ getUrl($item) }}">
              <h3 class="h4">{{ $item->name }}</h3></a>
            <p class="text-muted">{{ $item->description }}</p>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</section>