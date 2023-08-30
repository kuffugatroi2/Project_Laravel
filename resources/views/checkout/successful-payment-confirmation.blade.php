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
$address = Auth::guard('customer')->user()->customer_address;
$explode_name = explode(' ', $name);
}
$count = count($explode_name);
?>

  <?php
  $message = Session::get('message');
  if ($message) {
  echo '<div class="alert alert-success" style="text-align: center">' . $message . '</div>';
  Session::put('message', null);
  }
  ?>
  @if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
  @endif

<div class="Shopping-cart-area pt-60 pb-60">
  <div class="container">
    <i class="fa fa-check-circle checkout-success"></i>
    <h1 class="text-login" style="font-size: 35px; color: #28a744">Thanh toán thành công!</h1>
    <p class="text-login">Bạn vui lòng ấn đặt hàng để đơn hàng được lưu vào hệ thống</p>
    <form action="{{ route('checkout.save_order_checkout_vnpay') }}" method="POST" class="openVnpay">
        @csrf
        @if ($count == 2)
        <input placeholder="Nhập họ" type="text" name="shipping-first-name" value="{{ $explode_name[0] }}" hidden>
        <input placeholder="Nhập tên" type="text" name="shipping-last-name" value="{{ $explode_name[1] }}" hidden>
        @elseif($count == 3)
        <input placeholder="Nhập họ" type="text" name="shipping-first-name" value="{{ $explode_name[0] }} {{ $explode_name[1] }}" hidden>
        <input placeholder="Nhập tên" type="text" name="shipping-last-name" value="{{ $explode_name[2] }}" hidden>
        @endif
        <input placeholder="Nhập địa chỉ nhận hàng" type="text" name="shipping-address" value="{{ $address }}" hidden>
        <input placeholder="Nhập email" type="email" name="shipping-email" value="{{ $email }}" hidden>
        <input type="text" placeholder="Nhập số điện thoại nhận hàng" name="shipping-phone" value="{{ $phone }}" hidden>
        <textarea id="checkout-mess" name="shipping-notes" cols="30" rows="10" placeholder="Ghi chú về đơn hàng của bạn, ví dụ: ghi chú đặc biệt cho giao hàng" hidden></textarea>
        {{-- <input type="radio" id="open-vnpay1" class="radio-checkout open-vnpay" name="payment-option"
        value="14" hidden> --}}
        <button type="submit" class="btn btn-primary" style="margin: auto; display: block;">Đặt hàng</button>
    </form>
    {{-- <a
    href="{{route('checkout.save_order_checkout_vnpay')}}"
    type="button" class="btn btn-primary"
    style="margin: auto; display: block; width: 120px; color: white;"
    >Đặt hàng</a> --}}
  </div>
</div>

@endsection