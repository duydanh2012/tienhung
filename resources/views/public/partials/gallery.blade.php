@php
  $posts = lastPost(4);
@endphp

<section class="gallery no-padding">    
      <div class="row">
        @foreach ($posts as $item)
          <div class="mix col-lg-3 col-md-3 col-sm-6">
            <div class="item"><a href="{{ asset($item->image) }}" data-fancybox="gallery" class="image"><img src="{{ asset($item->image) }}" alt="{{ $item->name }}" class="img-fluid">
                <div class="overlay d-flex align-items-center justify-content-center"><i class="fas fa-search"></i></div></a></div>
          </div>
        @endforeach
      </div>
    </section>