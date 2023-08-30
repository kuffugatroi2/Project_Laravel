@extends('layout')
@section('content')

<!--Shopping Cart Area Strat-->
<div class="Shopping-cart-area pt-60 pb-60">
  <div class="container">
    <h1 class="text-login" style="font-size: 35px">Đơn hàng của tôi</h1>
    <p class="text-login ">Quản lý và theo dõi để nhận hàng đúng hạn</p>
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
        <div class="col-12">
            <div class="table-content table-responsive">
                <div class="row m-t-30">
                    <div class="col-md-12">
                        <div class="table-responsive m-b-40 border-radius">
                          <table class="table table-borderless table-data3">
                              <thead>
                                <tr>
                                  <th>Tên Sản phẩm</th>
                                  <th>Tổng tiền</th>
                                  <th>Trạng thái</th>
                                  <th>Ngày đặt hàng</th>
                                  <th>Ngày giao hàng</th>
                                  <th>Hoạt động</th>
                                </tr>
                              </thead>
                              @foreach ($orders as $order)
                              <tbody>
                                <tr>
                                    <td><b>{{$order->product_name}}</b></td>
                                    <td class="text-info">{{$order->order_total}}</td>
                                    @if ($order->order_status == 1)
                                      <td class="text-primary">Chờ duyệt</td>
                                    @elseif($order->order_status == 2)
                                      <td class="text-success">
                                        Đã giao
                                        <i class="fa fa-check-circle"></i>
                                      </td>
                                    @elseif($order->order_status == 4)
                                      <td class="text-warning">
                                        Đang vận chuyển
                                        <i class="fa fa-solid fa-motorcycle"></i>
                                      </td>
                                    @elseif($order->order_status == 5)
                                      <td class="text-warning">
                                        Hoàn trả
                                        <i class="fa fa-solid fa-rotate-left"></i>
                                      </td>
                                    @else
                                      <td class="text-danger">
                                        Đã hủy
                                        <i class="fa fa-times-circle"></i>
                                      </td>
                                    @endif
                                    <?php
                                      $orderDate = $order->created_at;
                                      $deliveryDate = strtotime('+3 day' , strtotime ( $orderDate ));
                                      $deliveryDate = date ( 'Y-m-d h:i:s' , $deliveryDate );
                                    ?>
                                    <td class="text-info">{{$orderDate}}</td>
                                    <td class="text-info">{{$deliveryDate}}</td>
                                    <td>
                                      <a
                                      href="{{route('view_order',$order->order_id)}}"
                                      class="btn btn-success button_list" ui-toggle-class="">
                                      <i class="fa fa-info-circle text-active"></i>
                                      </a>
                                      @if ($order->order_status == 1)
                                      <a
                                      onclick="return confirm('Bạn có chắc muốn hủy đơn hàng này không?')"
                                      href="{{route('cancel_order',$order->order_id)}}"
                                      class="btn btn-danger button_list" ui-toggle-class="">
                                      <i class="fa fa-trash"></i>
                                      </a>
                                      @elseif ($order->order_status == 3 || $order->order_status == 5)
                                      <a
                                      onclick="return confirm('Bạn có chắc muốn mua lại đơn hàng này không?')"
                                      href="{{route('buy_back_order',$order->order_id)}}"
                                      class="btn btn-danger button_list" ui-toggle-class="">
                                      <i class="fa fa-solid fa-rotate-left"></i>
                                      </a>
                                      @endif
                                    </td>
                              </tbody>
                              @endforeach
                          </table>
                        </div>
                        @if (!empty($products['data']))
                        <div class="col-lg-12 flex-end">
                          {{ $allOrder->links("pagination::bootstrap-4") }}
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
</div>
<!--Shopping Cart Area End-->

@endsection