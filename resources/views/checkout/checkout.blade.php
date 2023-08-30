@extends('layout')
@section('content')
    <?php
    $customer_id = Auth::guard('customer')->check();
    $shipping_id = Session::get('shipping_id');
    $name = null;
    $phone = null;
    $email = null;
    $count = 0;
    $explode_fullname = null;
    if ($customer_id) {
    $name = Auth::guard('customer')->user()->customer_name;
    $phone = Auth::guard('customer')->user()->customer_phone;
    $email = Auth::guard('customer')->user()->customer_email;
    $explode_name = explode(' ', $name);
    }
    $count = count($explode_name);
    ?>
    <div class="checkout-area pt-60 pb-30">
        <div class="container">
            <div class="row">
                <div class="col-12">
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
                </div>
            </div>
            <form action="{{ route('checkout.order_place') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-lg-6 col-12">
                        {{-- <form action="#"> --}}
                        <div class="checkbox-form">
                            <h3>Thông tin giao hàng</h3>
                            <div class="row">
                                @if ($count == 2)
                                    <div class="col-md-6">
                                        <div class="checkout-form-list">
                                            <label>Họ <span class="required">*</span></label>
                                            <input placeholder="Nhập họ" type="text" name="shipping-first-name"
                                                value="{{ $explode_name[0] }}">
                                            @error('shipping-first-name')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="checkout-form-list">
                                            <label>Tên <span class="required">*</span></label>
                                            <input placeholder="Nhập tên" type="text" name="shipping-last-name"
                                                value="{{ $explode_name[1] }}">
                                            @error('shipping-last-name')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                @elseif($count == 3)
                                    <div class="col-md-6">
                                        <div class="checkout-form-list">
                                            <label>Họ <span class="required">*</span></label>
                                            <input placeholder="Nhập họ" type="text" name="shipping-first-name"
                                                value="{{ $explode_name[0] }} {{ $explode_name[1] }}">
                                            @error('shipping-first-name')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="checkout-form-list">
                                            <label>Tên <span class="required">*</span></label>
                                            <input placeholder="Nhập tên" type="text" name="shipping-last-name"
                                                value="{{ $explode_name[2] }}">
                                            @error('shipping-last-name')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                @endif
                                <div class="col-md-12">
                                    <div class="checkout-form-list">
                                        <label>Địa chỉ <span class="required">*</span></label>
                                        <input placeholder="Nhập địa chỉ nhận hàng" type="text" name="shipping-address">
                                        @error('shipping-address')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="checkout-form-list">
                                        <label>Email <span class="required">*</span></label>
                                        <input placeholder="Nhập email" type="email" name="shipping-email"
                                            value="{{ $email }}">
                                        @error('shipping-email')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="checkout-form-list">
                                        <label>Số điện thoại <span class="required">*</span></label>
                                        <input type="text" placeholder="Nhập số điện thoại nhận hàng" name="shipping-phone"
                                            value="{{ $phone }}">
                                        @error('shipping-phone')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="different-address">
                                <div class="order-notes">
                                    <div class="checkout-form-list">
                                        <label>Ghi chú</label>
                                        <textarea id="checkout-mess" name="shipping-notes" cols="30" rows="10"
                                            placeholder="Ghi chú về đơn hàng của bạn, ví dụ: ghi chú đặc biệt cho giao hàng"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-12">
                        <div class="your-order">
                            <?php $contents = Cart::content(); ?>
                            <h3>Đơn hàng của bạn</h3>
                            <div class="your-order-table table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="cart-product-name">Sản phẩm</th>
                                            <th class="cart-product-total">Tổng</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($contents as $content)
                                            <tr class="cart_item">
                                                <td class="cart-product-name"> {{ $content->name }} <strong
                                                        class="product-quantity"> × {{ $content->qty }}</strong></td>
                                                <td class="cart-product-total">
                                                    <span class="amount">
                                                        <?php
                                                        $subtotal = $content->price * $content->qty;
                                                        echo number_format($content->subtotal, 0, ',', '.') . ' ' . 'đ';
                                                        ?>
                                                    </span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr class="cart-subtotal">
                                            <th>Tổng tiền giỏ hàng</th>
                                            <td><span class="amount">{{ Cart::pricetotal(0, ',', '.') . ' ' . 'đ' }}</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>thuế</th>
                                            <td><span class="amount">{{ Cart::tax(0, ',', '.') . ' ' . 'đ' }}</span></td>
                                        </tr>
                                        <tr class="order-total">
                                            <th>Tổng tiền sau thuế</th>
                                            <td><strong><span
                                                        class="amount">{{ Cart::total(0, ',', '.') . ' ' . 'đ' }}</span></strong>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <div class="payment-method">
                                <div class="payment-accordion">
                                    <div id="accordion">
                                        @foreach ($payments['data'] as $key => $payment)
                                            <div class="card">
                                                <div class="card-header" id="#payment-3">
                                                    <h5 class="panel-title">
                                                        @if ($key == 0)
                                                            <input type="radio" id="open-vnpay" class="radio-checkout open-vnpay" name="payment-option"
                                                                value="{{ $payment->payment_id }}" checked>
                                                        @else
                                                            <input type="radio" id="open-vnpay1" class="radio-checkout open-vnpay" name="payment-option"
                                                                value="{{ $payment->payment_id }}">
                                                        @endif
                                                        <a class="collapsed" data-toggle="collapse"
                                                            data-target="#{{ $payment->payment_id }}" aria-expanded="false"
                                                            aria-controls="{{ $payment->payment_id }}">
                                                            {{ $payment->payment_method }}
                                                        </a>
                                                    </h5>
                                                </div>
                                                <div id="{{ $payment->payment_id }}" class="collapse"
                                                    data-parent="#accordion">
                                                    <div class="card-body">
                                                        <p>
                                                            {!! $payment->payment_desc !!}
                                                            {{-- @if ($payment->payment_method == 'VNPAY')
                                                            <br>
                                                            <form action="{{URL('vnpay_payment')}}" method="POST">
                                                            @csrf
                                                            <button type="submit" name="redirect" class="btn btn-primary">Thanh toán</button>
                                                            </form>
                                                            @endif --}}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="order-button-payment">
                                        <input value="Đặt hàng" type="submit">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <form action="{{ URL('vnpay_payment') }}" method="POST" class="openVnpay" hidden>
                @csrf
                <button type="submit" name="redirect" class="btn btn-primary vnpay">
                    <img src="frontend/images/vnpay.png" alt="" style="width: 30px;">
                    Thanh toán VNPAY</button>
            </form>
            {{-- <a href="{{route('checkout.save_order_checkout_vnpay')}}" type="submit" name="redirect" class="btn btn-primary vnpay">
                <img src="frontend/images/vnpay.png" alt="" style="width: 30px;">
                Thanh toán</a> --}}
    </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function(){
            $(".open-vnpay").change(function() {
                if ($(this).is(":checked")) {
                    var item_id = $(this).val();
                    if (item_id == 14) {
                        $(".openVnpay").removeAttr('hidden')
                    }
                } else {
                    $(".openVnpay").attr('hidden')
                }
            });
        });
    </script>
@endsection
