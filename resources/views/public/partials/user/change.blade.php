<section class="mb-3 col-lg-8">
    @if (session('alert_success'))
        <div class="alert alert-success">
            {{session('alert_success')}}
        </div>
    @endif
    <div class="row">
        <h2 class="h1-responsive font-weight-bold text-center mb-4">Thay đổi thông tin cá nhân</h2>
        <!--Grid column-->
        <div class="col-md-12 mb-md-0 mb-5">
            <form id="contact-form" name="contact-form" action="{{ route('public.update.user') }}" method="POST">
                @csrf
                <!--Grid row-->
                <div class="row mb-3">

                    <!--Grid column-->
                    <div class="col-md-12">
                        <div class="md-form mb-0">
                            <input type="text" id="name" name="name" class="form-control" value="{{ $data->name }}" maxlength="200" required>
                            <label for="name" class="">Họ và tên</label>
                        </div>
                    </div>
                    <!--Grid column-->

                </div>

                <div class="row mb-3">

                    <!--Grid column-->
                    <div class="col-md-12">
                        <div class="md-form mb-0">
                            <input type="email" id="email" name="email" class="form-control" value="{{ $data->email }}" maxlength="200" required>
                            <label for="email" class="">Email</label>
                        </div>
                    </div>
                    <!--Grid column-->

                </div>
                <!--Grid row-->

                <!--Grid row-->
                <div class="row mb-3">
                    <div class="col-md-12">
                        <div class="md-form mb-0">
                            <input id="signup-name" name="phone" type="tel" value="{{ $data->phone }}" class="form-control signup-phone" placeholder="Số điện thoại: 0123456789" pattern="[0-9]{10}">
                            <label for="phone" class="">Số điện thoại</label>
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