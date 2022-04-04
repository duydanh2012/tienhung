@php
  $menus = getCategoryHeader(3);
@endphp

<header class="header">
    <!-- Main Navbar-->
    <nav class="navbar navbar-expand-lg">
      <div class="search-area">
        <div class="search-area-inner d-flex align-items-center justify-content-center">
          <div class="close-btn"><i class="fas fa-times"></i></div>
          <div class="row d-flex justify-content-center">
            <div class="col-md-8">
              <form action="{{ route('public.search') }}" method="POST">
                @csrf
                <div class="form-group">
                  <input type="search" name="search" id="search" placeholder="Bạn muốn tìm kiếm điều gì?">
                  <button type="submit" class="submit"><i class="fas fa-search"></i></button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="container">
        <!-- Navbar Brand -->
        <div class="navbar-header d-flex align-items-center justify-content-between">
          <!-- Navbar Brand --><a href="{{ route('public.index') }}" class="navbar-brand">Portal</a>
          <!-- Toggle Button-->
          <button type="button" data-toggle="collapse" data-target="#navbarcollapse" aria-controls="navbarcollapse" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler"><span></span><span></span><span></span></button>
        </div>
        <!-- Navbar Menu -->
        <div id="navbarcollapse" class="collapse navbar-collapse">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item"><a href="{{ route('public.index') }}" class="nav-link active ">Trang Chủ</a>
            </li>
            <li class="nav-item">
              <a href="{{ route('public.blog') }}" class="nav-link  ">Tin tức</a>
            </li>
            @foreach ($menus as $item)
              @php
                $url = getUrl($item);
              @endphp
              <li class="nav-item">
                <a href="{{ $url }}" class="nav-link ">{{ $item->name }}</a>
              </li>
            @endforeach

            <li class="nav-item"><a href="#" class="nav-link ">Liên Hệ</a>
            </li>
          </ul>
          <div class="navbar-text"><a href="#" class="search-btn"><i class="fas fa-search"></i></a></div>
          <ul class="langs navbar-text">
            <a href="#" class="active">{{ Auth::user()->name }}</a>
            <a href="{{ route('public.logout') }}" class="active"><i class="fas fa-sign-out-alt"></i></a></ul>
        </div>
      </div>
    </nav>
  </header>