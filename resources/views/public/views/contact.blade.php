@extends('public.index')
@section('title', 'Liên hệ')
@section('content')
    <div class="container d-flex justify-content-center">
        <div class="row">
            <section class="mb-4">
                <!--Section heading-->
                <h2 class="h1-responsive font-weight-bold text-center mb-4">Liên hệ</h2>
                <!--Section description-->
                <p class="text-center w-responsive mx-auto mb-5">Nếu bạn có câu hỏi bất kỳ nào. Xin đừng ngần ngại liên hệ trực tiếp với chúng tôi. Chúng tôi sẽ trả lời bạn trong vòng vài giờ.</p>
            
                <div class="row">
            
                    <!--Grid column-->
                    <div class="col-md-9 mb-md-0 mb-5">
                        <form id="contact-form" name="contact-form" action="{{ route('public.postContact') }}" method="POST">
                            @csrf
                            <!--Grid row-->
                            <div class="row">
            
                                <!--Grid column-->
                                <div class="col-md-6">
                                    <div class="md-form mb-0">
                                        <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}" maxlength="200" required>
                                        <label for="name" class="">Họ và tên</label>
                                    </div>
                                </div>
                                <!--Grid column-->
            
                                <!--Grid column-->
                                <div class="col-md-6">
                                    <div class="md-form mb-0">
                                        <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" maxlength="200" required>
                                        <label for="email" class="">Email</label>
                                    </div>
                                </div>
                                <!--Grid column-->
            
                            </div>
                            <!--Grid row-->
            
                            <!--Grid row-->
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="md-form mb-0">
                                        <input type="text" id="subject" name="subject" class="form-control" value="{{ old('subject') }}" maxlength="400" required>
                                        <label for="subject" class="">Tiêu đề</label>
                                    </div>
                                </div>
                            </div>
                            <!--Grid row-->
            
                            <!--Grid row-->
                            <div class="row">
            
                                <!--Grid column-->
                                <div class="col-md-12">
            
                                    <div class="md-form">
                                        <textarea type="text" id="message" name="message" rows="2" class="form-control md-textarea" value="{{ old('message') }}" required></textarea>
                                        <label for="message">Tin nhắn</label>
                                    </div>
            
                                </div>
                            </div>
                            <!--Grid row-->
                            <div class="text-center text-md-left">
                                <button type="submit" class="btn btn-primary">Gửi</button>
                            </div>
                        </form>
            

                        <div class="status">
                            @if (count($errors) >0)
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li class="text-danger"> {{ $error }}</li>
                                    @endforeach
                                </ul>
                            @endif
                            @if (session('alert_success'))
                                <div class="alert alert-success">
                                    {{session('alert_success')}}
                                </div>
                            @endif
                        </div>
                    </div>
                    <!--Grid column-->
            
                    <!--Grid column-->
                    <div class="col-md-3 text-center">
                        <ul class="list-unstyled mb-0">
                            <li><i class="fas fa-map-marker-alt fa-2x"></i>
                                <p>Nha Trang, Khánh Hòa</p>
                            </li>
            
                            <li><i class="fas fa-phone mt-4 fa-2x"></i>
                                <p>+84 123 456 789</p>
                            </li>
            
                            <li><i class="fas fa-envelope mt-4 fa-2x"></i>
                                <p>tienhung@gmail.com</p>
                            </li>
                        </ul>
                    </div>
                    <!--Grid column-->
            
                </div>
            
            </section>
        </div>
    </div>
@endsection