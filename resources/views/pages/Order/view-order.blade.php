@extends('layout')
@section('content')

<?php
  $date = getdate();
?>

<!--Shopping Cart Area Strat-->
<div class="Shopping-cart-area pt-60 pb-60">
  <div class="container">
    <h1 class="text-login" style="font-size: 35px">Đơn hàng của tôi</h1>
    <p class="text-login ">Quản lý và theo dõi để nhận hàng đúng hạn</p>
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
                              <li><a class="active" data-toggle="tab" href="#description"><span>Chi tiết</span></a></li>
                              <li><a data-toggle="tab" href="#update-profile-customer"><span>Cập nhật</span></a></li>
                          </ul>
                      </div>
                      <!-- Begin Li's Tab Menu Content Area -->
                  </div>
              </div>
              <div class="tab-content">
                  <div id="description" class="tab-pane active show" role="tabpanel">
                        <div class="product-description">
                            <table class="table table-hover table-light">
                                <tr>
                                  <td>Người nhận:</td>
                                  <td class="text-info">{{$detailOrders->shipping_name}}</td>
                                </tr>
                                @if ($detailOrders->shipping_email == NULL)
                                <tr>
                                  <td>Email:</td>
                                  <td class="text-info">NULL</td>
                                </tr>
                                @else
                                <tr>
                                  <td>Email:</td>
                                  <td class="text-info">{{$detailOrders->shipping_email}}</td>
                                </tr>
                                @endif
                                <tr>
                                    <td>Số điện thoại:</td>
                                    <td class="text-info">{{$detailOrders->shipping_phone}}</td>
                                </tr>
                                <tr>
                                  <td>Địa chỉ:</td>
                                  <td class="text-info">{{$detailOrders->shipping_address}}</td>
                                </tr>
                                @if ($detailOrders->shipping_notes == NULL)
                                <tr>
                                  <td>Ghi chú:</td>
                                  <td class="text-info">NULL</td>
                                </tr>
                                @else
                                <tr>
                                  <td>Ghi chú:</td>
                                  <td class="text-info">{{$detailOrders->shipping_notes}}</td>
                                </tr>
                                @endif
                                <tr>
                                  <td>Tên sản phẩm:</td>
                                  <td class="text-info">{{$detailOrders->product_name}}</td>
                                </tr>
                                <tr>
                                  <td>Giá:</td>
                                  <td class="text-info">{{$detailOrders->product_price}}</td>
                                </tr>
                                <tr>
                                  <td>Số lượng:</td>
                                  <td class="text-info">{{$detailOrders->product_sales_quantity}}</td>
                                </tr>
                                <tr>
                                  <td>Thuế:</td>
                                  <td class="text-info">{{$detailOrders->tax}}</td>
                                </tr>
                                <tr>
                                  <td>Tổng tiền:</td>
                                  <td class="text-info">{{$detailOrders->order_total}}</td>
                                </tr>
                                <tr>
                                  <td>Hình thức thanh toán:</td>
                                  <td class="text-info">{{$detailOrders->payment_method}}</td>
                                </tr>
                            </table>
                        </div>
                  </div>
                  <div id="update-profile-customer" class="tab-pane" role="tabpanel">
                    <div class="product-details-manufacturer">
                        <div class="card">
                            <form role="form" action="{{ route('update_shipping', $detailOrders->shipping_id) }}" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="card-header">
                                  <strong>Cập nhật thông tin giao hàng</strong> FORM
                                </div>
                                    <div class="card-body card-block">
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label class="form-control-label">Họ và tên người nhận</label>
                                                <input type="text" id="shipping-name" name="shipping-name" placeholder="Vui lòng nhập họ và tên" class="form-control" value="{{$detailOrders->shipping_name}}">
                                                @error('shipping-name')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class=" form-control-label">Email</label>
                                                <input type="text" id="shipping-email" name="shipping-email" placeholder="Vui lòng nhập email" class="form-control" value="{{$detailOrders->shipping_email}}">
                                                @error('shipping-email')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label class=" form-control-label">Số điện thoại</label>
                                                <input type="text" id="shipping-phone" name="shipping-phone" placeholder="Vui lòng nhập số điện thoại" class="form-control" value="{{$detailOrders->shipping_phone}}">
                                                @error('shipping-phone')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class=" form-control-label">Địa chỉ</label>
                                                <input type="text" id="shipping-address" name="shipping-address" placeholder="Vui lòng nhập địa chỉ" class="form-control" value="{{$detailOrders->shipping_address}}">
                                                @error('shipping-address')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row">
                                          <div class="form-group col-md-12 ">
                                              <label class=" form-control-label">Ghi chú</label>
                                              <textarea name="shipping-notes" id="" cols="30" rows="10" placeholder="Ghi chú về đơn hàng của bạn, ví dụ: ghi chú đặc biệt cho giao hàng">{{$detailOrders->shipping_notes}}</textarea>
                                              @error('shipping-notes')
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