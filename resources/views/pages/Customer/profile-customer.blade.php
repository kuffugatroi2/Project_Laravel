@extends('layout')
@section('content')

    <?php
    $date = getdate();
    $dayOfBirth = 0;
    $monthOfBirth = 0;
    $yearOfBirth = 0;
    if (isset($profile['data']->birthday) && $profile['data']->birthday != null) {
    $birthday = explode('-', $profile['data']->birthday);
    $dayOfBirth = $birthday[0];
    $monthOfBirth = $birthday[1];
    $yearOfBirth = $birthday[2];
    }
    ?>
    <h1></h1>
    <div class="Shopping-cart-area pt-60 pb-60">
        <div class="container">
            <h1 class="text-login" style="font-size: 35px">Hồ sơ của tôi</h1>
            <p class="text-login ">Quản lý thông tin hồ sơ để bảo mật tài khoản</p>
            <div class="row">
                <div class="col-12">
                    <div class="product-area pt-35">
                        <div class="container">
                            <?php
                            $message = Session::get('message');
                            if ($message) {
                            echo '<div class="alert alert-success">' . $message . '</div>';
                            Session::put('message', null);
                            }
                            ?>
                            @if (session('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="li-product-tab">
                                        <ul class="nav li-product-menu">
                                            <li><a class="active" data-toggle="tab" href="#description"><span>Chi
                                                        tiết</span></a></li>
                                            <li><a data-toggle="tab" href="#update-profile-customer"><span>Cập
                                                        nhật</span></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-content">
                                <div id="description" class="tab-pane active show" role="tabpanel">
                                    <div class="product-description">
                                        <table class="table table-hover table-light">
                                            <tr>
                                                <td>Họ và tên:</td>
                                                <td class="text-info">{{ $profile['data']->customer_name }}</td>
                                            </tr>
                                            @if ($profile['data']->gender == null)
                                                <tr>
                                                    <td>Giới tính:</td>
                                                    <td class="text-info">NULL</td>
                                                </tr>
                                            @else
                                                <tr>
                                                    <td>Giới tính:</td>
                                                    @if ($profile['data']->gender == 1)
                                                        <td class="text-info">Nam</td>
                                                    @elseif ($profile['data']->gender == 2)
                                                        <td class="text-info">Nữ</td>
                                                    @else
                                                        <td class="text-info">Khác</td>
                                                    @endif
                                                    {{-- <td class="text-info">{{ $profile['data']->gender }}</td> --}}
                                                </tr>
                                            @endif
                                            @if ($profile['data']->birthday == null)
                                                <tr>
                                                    <td>Ngày sinh:</td>
                                                    <td class="text-info">NULL</td>
                                                </tr>
                                            @else
                                                <tr>
                                                    <td>Ngày sinh:</td>
                                                    <td class="text-info">{{ $profile['data']->birthday }}</td>
                                                </tr>
                                            @endif
                                            <tr>
                                                <td>Email:</td>
                                                <td class="text-info">{{ $profile['data']->customer_email }}</td>
                                            </tr>
                                            <tr>
                                                <td>Số điện thoại:</td>
                                                <td class="text-info">{{ $profile['data']->customer_phone }}</td>
                                            </tr>
                                            @if ($profile['data']->customer_address == null)
                                                <tr>
                                                    <td>Địa chỉ:</td>
                                                    <td class="text-info">NULL</td>
                                                </tr>
                                            @else
                                                <tr>
                                                    <td>Địa chỉ:</td>
                                                    <td class="text-info">{{ $profile['data']->customer_address }}</td>
                                                </tr>
                                            @endif
                                            <tr>
                                                <td>Ngày tạo:</td>
                                                <td class="text-info">{{ $profile['data']->created_at }}</td>
                                            </tr>
                                            <tr>
                                                <td>Ngày cập nhật:</td>
                                                <td class="text-info">{{ $profile['data']->updated_at }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <div id="update-profile-customer" class="tab-pane" role="tabpanel">
                                    <div class="product-details-manufacturer">
                                        <div class="card">
                                            <form role="form"
                                                action="{{ route('customer.update_profile_customer', $profile['data']->customer_id) }}"
                                                method="post" enctype="multipart/form-data">
                                                {{ csrf_field() }}
                                                <div class="card-header">
                                                    <strong>Cập nhật thông tin hồ sơ</strong> FORM
                                                </div>
                                                <div class="card-body card-block">
                                                    <div class="row">
                                                        <div class="form-group col-md-6">
                                                            <label class="form-control-label">Họ và tên</label>
                                                            <input type="text" id="customer_name" name="customer_name"
                                                                placeholder="Vui lòng nhập họ và tên" class="form-control"
                                                                value="{{ $profile['data']->customer_name }}">
                                                            @error('customer_name')
                                                                <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label class=" form-control-label">Email</label>
                                                            <input type="text" id="customer_email" name="customer_email"
                                                                placeholder="Vui lòng nhập email" class="form-control"
                                                                value="{{ $profile['data']->customer_email }}" disabled>
                                                            @error('customer_email')
                                                                <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-md-6">
                                                            <label class=" form-control-label">Số điện thoại</label>
                                                            <input type="text" id="customer_phone" name="customer_phone"
                                                                placeholder="Vui lòng nhập số điện thoại"
                                                                class="form-control"
                                                                value="{{ $profile['data']->customer_phone }}">
                                                            @error('customer_phone')
                                                                <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label class=" form-control-label">Địa chỉ</label>
                                                            <input type="text" id="customer_address" name="customer_address"
                                                                placeholder="Vui lòng nhập địa chỉ" class="form-control"
                                                                value="{{ $profile['data']->customer_address }}">
                                                            @error('customer_address')
                                                                <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-md-6">
                                                            <label class=" form-control-label">Giới tính</label>
                                                            <div class="form-check">
                                                                <div class="radio">
                                                                    @if ($profile['data']->gender == 1)
                                                                        <label for="radio1" class="form-check-label ">
                                                                            <input type="radio" id="gender" name="gender"
                                                                                value="1"
                                                                                class="radio-checkout margin-right"
                                                                                checked>Nam
                                                                        </label>
                                                                    @else
                                                                        <label for="radio1" class="form-check-label ">
                                                                            <input type="radio" id="gender" name="gender"
                                                                                value="1"
                                                                                class="radio-checkout margin-right">Nam
                                                                        </label>
                                                                    @endif
                                                                </div>
                                                                <div class="radio">
                                                                    @if ($profile['data']->gender == 2)
                                                                        <label for="radio1" class="form-check-label ">
                                                                            <input type="radio" id="gender" name="gender"
                                                                                value="2"
                                                                                class="radio-checkout margin-right"
                                                                                checked>Nữ
                                                                        </label>
                                                                    @else
                                                                        <label for="radio2" class="form-check-label ">
                                                                            <input type="radio" id="gender" name="gender"
                                                                                value="2"
                                                                                class="radio-checkout margin-right">Nữ
                                                                        </label>
                                                                    @endif
                                                                </div>
                                                                <div class="radio">
                                                                    @if ($profile['data']->gender == 3)
                                                                        <label for="radio1" class="form-check-label ">
                                                                            <input type="radio" id="gender" name="gender"
                                                                                value="3"
                                                                                class="radio-checkout margin-right"
                                                                                checked>Khác
                                                                        </label>
                                                                    @else
                                                                        <label for="radio3" class="form-check-label ">
                                                                            <input type="radio" id="gender" name="gender"
                                                                                value="3"
                                                                                class="radio-checkout margin-right">Khác
                                                                        </label>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            @error('product_hard_drive')
                                                                <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label class=" form-control-label">Ngày sinh</label>
                                                            <div class="row form-group">
                                                                <div class="col-12 col-md-4">
                                                                    <select name="date-of-birth" id="select"
                                                                        class="form-control">
                                                                        @for ($i = 1; $i <= 31; $i++)
                                                                            @if ($dayOfBirth == $i) <option
                                                                            value="{{ $i }}"
                                                                            selected>{{ $i }}</option>
                                                                            @continue @endif
                                                                            <option value="{{ $i }}">
                                                                                {{ $i }}</option>
                                                                        @endfor
                                                                    </select>
                                                                </div>
                                                                <div class="col-12 col-md-4">
                                                                    <select name="month-of-birth" id="select"
                                                                        class="form-control">
                                                                        @for ($i = 1; $i <= 12; $i++)
                                                                            @if ($monthOfBirth == $i) <option
                                                                            value="{{ $i }}"
                                                                            selected>{{ $i }}</option>
                                                                            @continue @endif
                                                                            <option value="{{ $i }}">
                                                                                {{ $i }}</option>
                                                                        @endfor
                                                                    </select>
                                                                </div>
                                                                <div class="col-12 col-md-4">
                                                                    <select name="year-of-birth" id="select"
                                                                        class="form-control">
                                                                        @for ($i = 1940; $i < $date['year']; $i++)
                                                                            @if ($yearOfBirth == $i) <option
                                                                            value="{{ $i }}"
                                                                            selected>{{ $i }}</option>
                                                                            @continue @endif
                                                                            <option value="{{ $i }}">
                                                                                {{ $i }}</option>
                                                                        @endfor
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            @error('product_screen')
                                                                <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-md-6">
                                                            <input type="checkbox" id="change-password"
                                                                name="change-password" class="radio-checkout">
                                                            <label>Đổi mật khẩu</label>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-md-6">
                                                            <label class="form-control-label">Mật khẩu</label>
                                                            <input type="password" id="password-input" name="password"
                                                                placeholder="Vui lòng nhập mật khẩu"
                                                                class="form-control password" disabled>
                                                            @error('password')
                                                                <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label class="form-control-label">Nhập lại mật khẩu</label>
                                                            <input type="password" id="password-input" name="password-again"
                                                                placeholder="Vui lòng nhập lại mật khẩu"
                                                                class="form-control password" disabled>
                                                            @error('password-again')
                                                                <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-footer">
                                                    <button type="submit" class="btn btn-success btn-sm">
                                                        <i class="fa fa-dot-circle-o"></i> Cập nhật
                                                    </button>
                                                    <button type="reset" class="btn btn-danger btn-sm">
                                                        <i class="fa fa-ban"></i> Reset
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Shopping Cart Area End-->

@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $("#change-password").change(function() {
                if ($(this).is(":checked")) {
                    $(".password").removeAttr('disabled')
                } else {
                    $(".password").attr('disabled', '')
                }
            });
        });

    </script>
@endsection
