<section class="mb-3 col-lg-8">
    @if (count($errors) >0)
        <ul>
            @foreach($errors->all() as $error)
                <li class="text-danger"> {{ $error }}</li>
            @endforeach
        </ul>
    @endif

    @if (session('alert_error'))
        <div class="alert alert-danger">
            {{session('alert_error')}}
        </div>
    @endif

    @if (session('alert_success'))
        <div class="alert alert-success">
            {{session('alert_success')}}
        </div>
    @endif

    <div class="row">
        <h2 class="h1-responsive font-weight-bold text-center mb-4">Thay đổi mật khẩu</h2>
        <!--Grid column-->
        <div class="col-md-12 mb-md-0 mb-5">
            <form id="contact-form" name="contact-form" action="{{ route('public.update.pass') }}" method="POST">
                @csrf
                <!--Grid row-->
                <div class="row mb-3">

                    <!--Grid column-->
                    <div class="col-md-12">
                        <div class="md-form mb-0">
                            <input type="password" id="name" name="password" class="form-control" maxlength="200" required>
                            <label for="name" class="">Mật khẩu cũ</label>
                        </div>
                    </div>
                    <!--Grid column-->

                </div>

                <div class="row mb-3">

                    <!--Grid column-->
                    <div class="col-md-12">
                        <div class="md-form mb-0">
                            <input type="password" id="passwordNew" name="passwordNew" class="form-control"  maxlength="200" required>
                            <label for="passwordNew" class="">Mật khẩu mới</label>
                        </div>
                    </div>
                    <!--Grid column-->

                </div>
                <!--Grid row-->

                <!--Grid row-->
                <div class="row mb-3">
                    <div class="col-md-12">
                        <div class="md-form mb-0">
                            <input id="passwordConfirm" name="passwordConfirm" type="password"  class="form-control signup-phone"  maxlength="200" required>
                            <label for="passwordConfirm" class="">Nhập lại mật khẩu</label>
                        </div>
                    </div>
                </div>
                <!--Grid row-->
                <!--Grid row-->
                <div class="text-center text-md-left">
                    <button type="submit" class="btn btn-primary">Thay đổi</button>
                </div>
            </form>
        </div>
        <!--Grid column-->


    </div>

</section>