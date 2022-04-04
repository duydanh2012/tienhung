@php
  if(isset($category)){
    $posts = $data;
  }else{
    $posts = getAllPosts();
  }
@endphp

<main class="posts-listing col-lg-8">
  <div class="container">
    @if (isset($category))
    <h1>{{ $category->name }}</h1>
    @endif
    
      <div class="row">
          <!-- post -->
          @foreach ($posts as $item)
            <div class="post col-xl-6">
                <div class="post-thumbnail"><a href="{{ getUrl($item) }}"><img src="{{ asset($item->image) }}" alt="{{ $item->name }}"
                            class="img-fluid"></a></div>
                <div class="post-details mt-2">
                    <a href="{{ getUrl($item) }}">
                        <h3 class="h4">{{ $item->name }}</h3>
                    </a>
                    <p class="text-muted">{{ $item->description }}</p>
                    <footer class="post-footer d-flex align-items-center">
                        <div class="title"><span>{{ getUser($item) }}</span></div>
                        <div class="date"><i class="far fa-clock"></i> {{ date("d/m/Y", strtotime($item->created_at) ) }}</div>
                        <div class="comments meta-last"><i class="fas fa-comment-alt"></i> {{ countComment($item->id) }}</div>
                    </footer>
                </div>
            </div>
          @endforeach
      </div>
      <!-- Pagination -->
      {{ $posts->links('public.layouts.pagination') }}
  </div>
</main>