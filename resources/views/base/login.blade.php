@include('layouts.head')
<title>Login</title>
</head>
<body class="app app-login p-0">    	
    <div class="row g-0 app-auth-wrapper">
	    <div class="col-12 col-md-7 col-lg-6 auth-main-col text-center p-5">
		    <div class="d-flex flex-column align-content-end">
			    <div class="app-auth-body mx-auto">	
				    <div class="app-auth-branding mb-4"><a class="app-logo" href="index.html"><img class="logo-icon me-2" src="assets/images/app-logo.svg" alt="logo"></a></div>
					<h2 class="auth-heading text-center mb-5">Đăng nhập</h2>
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
                    @elseif (session('alert_success'))
                        <div class="alert alert-success">
                            {{session('alert_success')}}
                        </div>
                    @endif
			        <div class="auth-form-container text-start">
						<form method="POST" action="{{ route('public.login.post') }}" class="auth-form login-form">   
							@csrf      
							<div class="email mb-3">
								<label class="sr-only" for="signin-email">Email</label>
								<input id="signin-email" name="email" type="email" class="form-control signin-email" value="{{ old('email') }}" placeholder="Email address" required="required">
							</div><!--//form-group-->
							<div class="password mb-3">
								<label class="sr-only" for="signin-password">Password</label>
								<input id="signin-password" name="password" type="password" value="{{ old('password') }}" class="form-control signin-password" placeholder="Password" required="required">
								<div class="extra mt-3 row justify-content-between">
									<div class="col-6">
										<div class="form-check">
											<input class="form-check-input" type="checkbox" name="remember" id="RememberPassword">
											<label class="form-check-label" for="RememberPassword">
											Ghi nhớ tôi
											</label>
										</div>
									</div><!--//col-6-->
									<div class="col-6">
										<div class="forgot-password text-end">
											<a href="{{ route('public.forget') }}">Quên mật khẩu?</a>
										</div>
									</div><!--//col-6-->
								</div><!--//extra-->
							</div><!--//form-group-->
							<div class="text-center">
								<button type="submit" class="btn app-btn-primary w-100 theme-btn mx-auto">Đăng nhập</button>
							</div>
						</form>
						
						<div class="auth-option text-center pt-5">Bạn chưa có tài khoản? Đăng ký <a class="text-link" href="{{ route('public.registration') }}" >Tại đây</a>.</div>
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
</html> 

