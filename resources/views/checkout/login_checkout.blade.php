@extends('layout')
@section('content')

{{-- <section id="form"><!--form-->
	<div class="container">
		<div class="row">
			<div class="col-sm-4 col-sm-offset-1">
				<div class="login-form"><!--login form-->
					<h2>Đăng nhập vào tài khoản</h2>
					<form action="{{ URL::to('login-customer') }}" method="post">
						@csrf
															<input type="email" placeholder="Email" name="email_account"/>
															<input type="password" placeholder="Password" name="password_account"/>
															<span>
							<input type="checkbox" class="checkbox">
							Ghi nhớ đăng nhập
						</span>
						<button type="submit" class="btn btn-default">Đăng nhập</button>
					</form>
				</div><!--/login form-->
			</div>
			<div class="col-sm-1">
				<h2 class="or">Hoặc</h2>
			</div>
			<div class="col-sm-4">
				<div class="signup-form"><!--sign up form-->
					<h2>Đăng ký</h2>
											<form action="{{ URL::to('add-customer') }}" method="post">
											@csrf
													<input type="text" placeholder="Họ và tên" name="customer_name"/>
													<input type="email" placeholder="Email" name="customer_email"/>
													<input type="password" placeholder="Password" name="customer_password"/>
													<input type="text" placeholder="Phone" name="customer_phone"/>
													<button type="submit" class="btn btn-default">Đăng ký</button>
											</form>
				</div><!--/sign up form-->
			</div>
		</div>
	</div>
</section><!--/form--> --}}

<!-- Section: Design Block -->
{{-- <section class=" text-center text-lg-start">
  <style>
    .rounded-t-5 {
      border-top-left-radius: 0.5rem;
      border-top-right-radius: 0.5rem;
    }

    @media (min-width: 992px) {
      .rounded-tr-lg-0 {
        border-top-right-radius: 0;
      }

      .rounded-bl-lg-5 {
        border-bottom-left-radius: 0.5rem;
      }
    }
  </style>
  <div class="card mb-3">
    <div class="row g-0 d-flex align-items-center">
      <div class="col-lg-4 d-none d-lg-flex">
        <img src="https://mdbootstrap.com/img/new/ecommerce/vertical/004.jpg" alt="Trendy Pants and Shoes"
					class="w-100 rounded-t-5 rounded-tr-lg-0 rounded-bl-lg-5" />
					<img src="https://vnreview.vn/image/79/21/79213.jpg" alt="Trendy Pants and Shoes"
					class="w-100 rounded-t-5 rounded-tr-lg-0 rounded-bl-lg-5" />
					<img src="https://hieuapple.com/uploads/news/tin-tuc/steve-jobs-mac.jpg" alt="Trendy Pants and Shoes"
					class="w-100 rounded-t-5 rounded-tr-lg-0 rounded-bl-lg-5" />

      </div>
      <div class="col-lg-8">
        <div class="card-body py-5 px-md-5">

          <form>
            <!-- Email input -->
            <div class="form-outline mb-4">
              <input type="email" id="form2Example1" class="form-control" />
              <label class="form-label" for="form2Example1">Email address</label>
            </div>

            <!-- Password input -->
            <div class="form-outline mb-4">
              <input type="password" id="form2Example2" class="form-control" />
              <label class="form-label" for="form2Example2">Password</label>
            </div>

            <!-- 2 column grid layout for inline styling -->
            <div class="row mb-4">
              <div class="col d-flex justify-content-center">
                <!-- Checkbox -->
								<div class="form-check">
									<input class="" type="checkbox" value="" id="form2Example31" checked />
                  <label class="form-check-label" for="form2Example31"> Remember me </label>
                </div>
              </div>

              <div class="col">
                <!-- Simple link -->
                <a href="#!">Forgot password?</a>
              </div>
            </div>

            <!-- Submit button -->
            <button type="button" class="btn btn-primary btn-block mb-4">Sign in</button>

          </form>

        </div>
      </div>
    </div>
  </div>
</section> --}}
<!-- Section: Design Block -->

<section class="vh-100" style="background-color: white;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col col-xl-10">
        <div class="card" style="border-radius: 1rem;">
          <span class="text-login">
          <?php
              $message = Session::get('message');
              if ($message) {
                  echo '<div class="alert alert-success">'.$message.'</div>';
                  Session::put('message', null);
              }
          ?>
          @if (session('error'))
            <div class="alert alert-danger">
                {{session('error')}}
            </div>
          @endif
          </span>
          <div class="row g-0">
            <div class="col-md-6 col-lg-5 d-none d-md-block">
              {{-- <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/img1.webp"
                alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem; border-radius: 20px; margin: 30px;" /> --}}
              <img src="https://upload.wikimedia.org/wikipedia/vi/thumb/c/c7/Logo_Real_Madrid.svg/1200px-Logo_Real_Madrid.svg.png"
                alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem; border-radius: 20px; margin: 30px;" />
              {{-- <img src="https://upload.wikimedia.org/wikipedia/commons/a/a8/Bill_Gates_2017_%28cropped%29.jpg"
                alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem; border-radius: 20px; margin: 30px;" /> --}}
            </div>
            <div class="col-md-6 col-lg-7 d-flex align-items-center">
              <div class="card-body p-4 p-lg-5 text-black">
                <form action="{{ route('customer.login_customer') }}" method="POST">
                  @csrf
                  <div class="d-flex align-items-center mb-3 pb-1">
                    {{-- <i class="fas fa-cubes fa-2x me-3" style="color: #ff6219;"></i> --}}
                    <span class="h1 fw-bold mb-0">Chào mừng đến với Limupa shop</span>
                  </div>

                  <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Đăng nhập vào tài khoản của bạn</h5>

                  <div class="form-outline mb-4">
                    <label class="form-label" for="form2Example17" style="margin-top: 10px; color: red">Địa chỉ email*</label>
                    <input type="email" id="form2Example17" name="customer-email" class="form-control form-control-lg" placeholder="Vui lòng nhập email của bạn"/>
                    @error('customer-email')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                  </div>

                  <div class="form-outline mb-4">
                    <label class="form-label" for="form2Example27" style="margin-top: 10px; color: red">Mật khẩu*</label>
                    <input type="password" id="form2Example27" name="customer-password" class="form-control form-control-lg" placeholder="Vui lòng nhập mật khẩu của bạn"/>
                    @error('customer-password')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                  </div>

                  <div class="pt-1 mb-4">
                    <button class="btn btn-outline-warning btn-lg btn-block" type="submit">Đăng nhập</button>
                  </div>

                  <a class="small text-muted" href="#!">Quên mật khẩu?</a>
                  <p class="mb-5 pb-lg-2" style="color: #393f81;">Bạn mới biết đến Limupa shop?
                    <a href="{{ route('customer.register') }}" style="color: #f80202;">Đăng ký ngay</a>
                  </p>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection


