@php
  $featurePosts = featuredPost();
@endphp

<footer class="main-footer">
    <div class="container">
      <div class="row">
        <div class="col-md-4">
          <div class="logo">
            <h6 class="text-white">Portal</h6>
          </div>
          <div class="contact-details">
            <p>Trường ĐH Thông Tin Liên Lạc</p>
            <p>Phone: (+84) 123 456 789</p>
            <p>Email: <a href="javascript:void(0);">TienHung@gmail.com</a></p>
            <ul class="social-menu">
              <li class="list-inline-item"><a href="javascript:void(0);"><i class="fab fa-facebook-f"></i></a></li>
              <li class="list-inline-item"><a href="javascript:void(0);"><i class="fab fa-instagram"></i></a></li>
              <li class="list-inline-item"><a href="javascript:void(0);"><i class="fab fa-twitter"></i></a></li>
              <li class="list-inline-item"><a href="javascript:void(0);"><i class="fab fa-pinterest"></i></a></li>
            </ul>
          </div>
        </div>
        <div class="col-md-4">
          <div class="menus d-flex">
            <ul class="list-unstyled">
              <li> <a href="javascript:void(0);">My Account</a></li>
              <li> <a href="javascript:void(0);">Add Listing</a></li>
              <li> <a href="javascript:void(0);">Pricing</a></li>
              <li> <a href="javascript:void(0);">Privacy &amp; Policy</a></li>
            </ul>
            <ul class="list-unstyled">
              <li> <a href="javascript:void(0);">Our Partners</a></li>
              <li> <a href="javascript:void(0);">FAQ</a></li>
              <li> <a href="javascript:void(0);">How It Works</a></li>
              <li> <a href="javascript:void(0);">Contact</a></li>
            </ul>
          </div>
        </div>
        <div class="col-md-4">
          <div class="latest-posts">
              @foreach ($featurePosts as $item)
                <a href="{{ getUrl($item) }}">
                  <div class="post d-flex align-items-center">
                    <div class="image"><img src="{{ asset($item->image) }}" alt="{{ $item->name }}" class="img-fluid"></div>
                    <div class="title"><strong>{{ $item->name }}</strong><span class="date last-meta">{{ date("d/m/Y", strtotime($item->created_at) ) }}</span></div>
                  </div>
                </a>
              @endforeach
            </div>
        </div>
      </div>
    </div>
    <div class="copyrights">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <p>&copy; 2022. All rights reserved.</p>
          </div>
          <div class="col-md-6 text-right">
            <p>Design By <a href="/" class="text-white">Tiến Hưng</a>
              <!-- Please do not remove the backlink to Bootstrap Temple unless you purchase an attribution-free license @ Bootstrap Temple or support us at http://bootstrapious.com/donate. It is part of the license conditions. Thanks for understanding :)                         -->
            </p>
          </div>
        </div>
      </div>
    </div>
  </footer>