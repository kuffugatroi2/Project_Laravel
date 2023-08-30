@extends('layout')
@section('content')

<section class="vh-100" style="background-color: white;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col col-xl-10">
        <div class="card" style="border-radius: 1rem;">
          <div class="row g-0">
            <div class="col-md-6 col-lg-5 d-none d-md-block">
              {{-- <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/img1.webp"
                alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem; border-radius: 20px; margin: 30px;" /> --}}
                {{-- <img src="https://cdn.vox-cdn.com/thumbor/Rc9TE_qpgAmtXWSyjUINycIVLC4=/0x0:700x393/1400x1400/filters:focal(350x196:351x197)/cdn.vox-cdn.com/uploads/chorus_asset/file/14559205/billgates-books.1419980165.jpg"
                alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem; border-radius: 20px; margin: 30px;" /> --}}
                <img src="https://upload.wikimedia.org/wikipedia/vi/thumb/c/c7/Logo_Real_Madrid.svg/1200px-Logo_Real_Madrid.svg.png"
                alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem; border-radius: 20px; margin: 30px;" />
                {{-- <img src="https://upload.wikimedia.org/wikipedia/commons/a/a8/Bill_Gates_2017_%28cropped%29.jpg"
                alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem; border-radius: 20px; margin: 30px;" /> --}}
            </div>
            <div class="col-md-6 col-lg-7 d-flex align-items-center">
              <div class="card-body p-4 p-lg-5 text-black">
                <div class="d-flex align-items-center mb-3 pb-1">
                  {{-- <i class="fa fa-cubes fa-2x me-3" style="color: #ff6219;"></i> --}}
                  <span class="h1 fw-bold mb-0">Chào mừng đến với Limupa shop</span>
                </div>
                <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Tạo tài khoản Limupa shop</h5>

                <form action="{{ route('customer.add_customer') }}" method="POST">
                  @csrf
                  <div class="form-outline mb-4">
                    <label class="form-label text-danger" for="form2Example17" >Họ tên*</label>
                    <input type="text" id="form2Example17" name="customer-name" class="form-control form-control-lg" placeholder="Vui lòng nhập tên của bạn"/>
                    @error('customer-name')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="form-outline mb-4">
                    <label class="form-label text-danger" for="form2Example17" >Địa chỉ email*</label>
                    <input type="email" id="form2Example17" name="customer-email" class="form-control form-control-lg" placeholder="Vui lòng nhập email của bạn"/>
                    @error('customer-email')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="form-outline mb-4">
                    <label class="form-label text-danger" for="form2Example27" >Mật khẩu*</label>
                    <input type="password" id="form2Example27" name="customer-password" class="form-control form-control-lg" placeholder="Vui lòng nhập mật khẩu của bạn"/>
                    @error('customer-password')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="form-outline mb-4">
                    <label class="form-label text-danger" for="form2Example27" >Nhập lại mật khẩu*</label>
                    <input type="password" id="form2Example27" name="customer-password-again" class="form-control form-control-lg" placeholder="Vui lòng nhập lại mật khẩu của bạn"/>
                    @error('customer-password-again')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="form-outline mb-4">
                    <label class="form-label text-danger" for="form2Example27" >Số điện thoại</label>
                    <input type="text" id="form2Example27" name="customer-phone" class="form-control form-control-lg" placeholder="Vui lòng nhập số điện thoại của bạn"/>
                    @error('customer-phone')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="pt-1 mb-4">
                    <button class="btn btn-outline-warning btn-lg btn-block" type="submit">Đăng ký</button>
                  </div>
                </form>

                <p class="mb-5 pb-lg-2" style="color: #393f81;">Bạn đã có tài khoản?
                  <a href="login-checkout" style="color: #f80202;">Đăng nhập ngay</a>
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection


