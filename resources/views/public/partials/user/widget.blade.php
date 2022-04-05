<aside class="col-lg-4">
    <div class="widget categories">
        <header>
          <h3 class="h6">Quản lý người dùng</h3>
        </header>
        <div class="item d-flex justify-content-between">
            <a  href="{{ route('public.user') }}">Thay đổi thông tin cá nhân</a>
        </div>
        <div class="item d-flex justify-content-between">
            <a href="{{ route('public.user.pass') }}">Thay đổi mật khẩu</a>
        </div>
        <div class="item d-flex justify-content-between">
            <a href="{{ route('public.getBookmark') }}">Bài viết đã lưu</a>
        </div>
      </div>
</aside>    