@extends('admin_layout')
@section('admin_content')

<div class="main-content">
  <div class="section__content section__content--p30">
    <div class="container-fluid">
      <div class="row">
        <div class="product-area pt-35 col-lg-12">
          <div class="container">
            {{-- <div class="row">
                <div class="col-lg-12">
                    <div class="li-product-tab">
                        <ul class="nav li-product-menu">
                            <li><a class="active btn btn-primary" data-toggle="tab" href="#description"><span>Product Details</span></a></li>
                            <li><a class="btn btn-primary" data-toggle="tab" href="#product-details"><span>Content</span></a></li>
                        </ul>
                    </div>
                </div>
            </div> --}}
            <div class="tab-content">
              <div id="description" class="tab-pane active show" role="tabpanel">
                <div class="product-description">
                  <table class="table table-hover table-light">
                    <tr>
                      <td>Tên khách hàng:</td>
                      <td class="text-info">{{ $manager_order_by_id->customer_name }}</td>
                    </tr>
                    <tr>
                      <td>Emails:</td>
                      <td class="text-info">{{ $manager_order_by_id->customer_email }}</td>
                    </tr>
                    <tr>
                      <td>Số điện thoại:</td>
                      <td class="text-info">{{ $manager_order_by_id->customer_phone }}</td>
                    </tr>
                    <tr>
                      <td>Tên người nhận hàng:</td>
                      <td class="text-info">{{ $manager_order_by_id->shipping_name }}</td>
                    </tr>
                    <tr>
                      <td>Địa chỉ:</td>
                      <td class="text-info">{{ $manager_order_by_id->shipping_address }}</td>
                    </tr>
                    <tr>
                      <td>Email:</td>
                      <td class="text-info">{{ $manager_order_by_id->shipping_email }}</td>
                    </tr>
                    <tr>
                      <td>Số điện thoại:</td>
                      <td class="text-info">{{ $manager_order_by_id->shipping_phone }}</td>
                    </tr>
                    <tr>
                      <td>Ghi chú:</td>
                      <td class="text-info">{{ $manager_order_by_id->shipping_notes }}</td>
                    </tr>
                    <tr>
                      <td>Tên sản phẩm:</td>
                      <td class="text-info">{{ $manager_order_by_id->product_name }}</td>
                    </tr>
                    <tr>
                      <td>Giá:</td>
                      <td class="text-info">{{ $manager_order_by_id->product_price }}</td>
                    </tr>
                    <tr>
                      <td>Số lượng:</td>
                      <td class="text-info">{{ $manager_order_by_id->product_sales_quantity }}</td>
                    </tr>
                    <tr>
                      <td>Thuế:</td>
                      <td class="text-info">{{ $manager_order_by_id->tax }}</td>
                    </tr>
                    <tr>
                      <td>Tổng tiền:</td>
                      <td class="text-info">{{ $manager_order_by_id->order_total }}</td>
                    </tr>
                    <tr>
                      <td>Hình thức thanh toán:</td>
                      <td class="text-info">{{ $manager_order_by_id->payment_method }}</td>
                    </tr>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection