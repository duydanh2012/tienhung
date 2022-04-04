@php
  $featurePosts = featuredPost();
@endphp

<section class="featured-posts no-padding-top">
    <div class="container">
      @foreach ($featurePosts as $item)
        @if ($loop->index % 2 == 0)
          <div class="row d-flex align-items-stretch">
            <div class="text col-lg-7">
              <div class="text-inner d-flex align-items-center">
                <div class="content">
                  <header class="post-header">
                    <div class="category">
                      @if ($item->categories->count() > 0)
                        @foreach ($item->categories as $category)
                          <a href="{{ getUrl($category) }}">{{ $category->name  }}</a>
                        @endforeach
                      @endif
                    </div>

                    <a href="{{ getUrl($item) }}">
                      <h2 class="h4">{{ $item->name }}</h2>
                    </a>
                  </header>
                  <p>{{ $item->description }}</p>
                  <footer class="post-footer d-flex align-items-center"><a href="#" class="author d-flex align-items-center flex-wrap">
                      <div class="title"><span>{{ getUser($item) }}</span></div></a>
                    <div class="date"><i class="far fa-clock"></i> {{ date("d/m/Y", strtotime($item->created_at) ) }}</div>
                    <div class="comments"><i class="fas fa-comment-alt"></i> {{ countComment($item->id) }}</div>
                  </footer>
                </div>
              </div>
            </div>
            <div class="image col-lg-5"><img src="{{ asset($item->image) }}" alt="{{ $item->name }}"></div>
          </div>
        @else
          <div class="row d-flex align-items-stretch">
            <div class="image col-lg-5"><img src="{{ asset($item->image) }}" alt="{{ $item->name }}"></div>
            <div class="text col-lg-7">
              <div class="text-inner d-flex align-items-center">
                <div class="content">
                  <header class="post-header">
                    <div class="category">
                      @if ($item->categories->count() > 0)
                        @foreach ($item->categories as $category)
                          <a href="{{ getUrl($category) }}">{{ $category->name  }}</a>
                        @endforeach
                      @endif
                    </div>

                    <a href="{{ getUrl($item) }}">
                      <h2 class="h4">{{ $item->name }}</h2>
                    </a>
                  </header>
                  <p>{{ $item->description }}</p>
                  <footer class="post-footer d-flex align-items-center"><a href="#" class="author d-flex align-items-center flex-wrap">
                      <div class="title"><span>{{ getUser($item) }}</span></div></a>
                    <div class="date"><i class="far fa-clock"></i> {{ date("d/m/Y", strtotime($item->created_at) ) }}</div>
                    <div class="comments"><i class="fas fa-comment-alt"></i></i> 12</div>
                  </footer>
                </div>
              </div>
            </div>
          </div>
        @endif

      @endforeach
      <!-- Post-->
    </div>
  </section>