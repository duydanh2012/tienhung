@php
  $data = countPostWithCategory();
@endphp

<div class="widget categories">
    <header>
      <h3 class="h6">Danh mục</h3>
    </header>
    @foreach ($data as $item)
      <div class="item d-flex justify-content-between">
          <a href="{{ getUrl($item) }}">{{ $item->name }}</a><span>{{ $item->count }}</span>
      </div>
    @endforeach
  </div>