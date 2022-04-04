@include('layouts.head')
<title>Đăng ký</title>
</head>
<body class="app app-signup p-0">    	
    <div class="row g-0 app-auth-wrapper">
	    <div class="col-12 col-md-7 col-lg-6 auth-main-col text-center p-5">
		    <div class="d-flex flex-column align-content-end">
			    <div class="app-auth-body mx-auto">	
				    <div class="app-auth-branding mb-4"><a class="app-logo" href="/"><img class="logo-icon me-2" src="assets/images/app-logo.svg" alt="logo"></a></div>
					<h2 class="auth-heading text-center mb-4">Đăng Ký</h2>					
	
					<div class="auth-form-container text-start mx-auto">
						<form class="auth-form auth-signup-form" action="{{ route('public.registration.post') }}" method="POST"> 
                            @if (count($errors) >0)
                                @foreach($errors->all() as $error)
                                    <div class="alert alert-danger alert-dismissible mt-2">
                                        <a class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                        {{ $error }}
                                    </div>
                                @endforeach
                            @endif
                            @if(session('alert_error'))
                                <div class="alert alert-danger alert-dismissible mt-2">
                                    <a class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    {{ session('alert_error') }}
                                </div>
                            @endif   
                            @csrf     
							<div class="email mb-3">
								<label class="sr-only" for="signup-email">Họ và tên</label>
								<input id="signup-name" name="name" type="text" class="form-control signup-name" placeholder="Họ và tên" required="required">
							</div>
							<div class="email mb-3">
								<label class="sr-only" for="signup-email">Email</label>
								<input id="signup-email" name="email" type="email" class="form-control signup-email" placeholder="Email" required="required">
							</div>
							<div class="password mb-3">
								<label class="sr-only" for="signup-password">Mật khẩu</label>
								<input id="signup-password" name="password" type="password" class="form-control signup-password" placeholder="Mật khẩu" required="required">
							</div>
                            <div class="password mb-3">
								<label class="sr-only" for="signup-password-confirmation">Nhập lại mật khẩu</label>
								<input id="signup-password-confirmation" name="password_confirmation" type="password" class="form-control signup-password" placeholder="Nhập lại mật khẩu" required="required">
							</div>
                            <div class="email mb-3">
								<label class="sr-only" for="signup-phone">Số điện thoại</label>
								<input id="signup-name" name="phone" type="tel" class="form-control signup-phone" placeholder="Số điện thoại: 0123456789" pattern="[0-9]{10}">
							</div>
                            <div class="extra mb-3">
								<div class="form-check">
									<input class="form-check-input" name="agree" type="checkbox" id="RememberPassword">
									<label class="form-check-label" for="RememberPassword">
                                        Tôi đồng ý với tất cả <a href="#" class="app-link">điều khoản and điều kiện</a>.
									</label>
								</div>
							</div>
							<div class="text-center">
								<button type="submit" class="btn app-btn-primary w-100 theme-btn mx-auto">Sign Up</button>
							</div>
						</form><!--//auth-form-->
						
						<div class="auth-option text-center pt-5">Bạn đã có tài khoản? <a class="text-link" href="{{ route('public.login') }}" >Đăng nhập</a></div>
					</div><!--//auth-form-container-->	
					
					
				    
			    </div><!--//auth-body-->
		    
			    <footer class="app-auth-footer">
				    <div class="container text-center py-3">
				         <!--/* This template is free as long as you keep the footer attribution link. If you'd like to use the template without the attribution link, you can buy the commercial license via our website: themes.3rdwavemedia.com Thank you for your support. :) */-->
			        <small class="copyright">Designed with <i class="fas fa-heart" style="color: #fb866a;"></i> by <a class="app-link" href="#" target="_blank">Duy Danh</a> for developers</small>
				       
				    </div>
			    </footer><!--//app-auth-footer-->	
		    </div><!--//flex-column-->   
	    </div><!--//auth-main-col-->
	    <div class="col-12 col-md-5 col-lg-6 h-100 auth-background-col">
		    <div class="auth-background-holder">			    
		    </div>
		    <div class="auth-background-mask"></div>
		    <div class="auth-background-overlay p-3 p-lg-5">
			    <div class="d-flex flex-column align-content-end h-100">
				    <div class="h-100"></div>
				</div>
		    </div><!--//auth-background-overlay-->
	    </div><!--//auth-background-col-->
    
    </div><!--//row-->


</body>