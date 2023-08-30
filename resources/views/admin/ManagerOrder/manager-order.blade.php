@extends('admin_layout')
@section('admin_content')

<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            {{-- @include('alert') --}}
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
            <form action="{{ route('order.manager_order') }}" method="GET">
              <span class="margin-left">Trạng thái:</span>
              <select name="select-status" id="select-status" class="from-control input-search margin-left">
                 <option value="all">All</option>
                 <option value="1">Chờ duyệt</option>
                 <option value="2">Đã giao</option>
                 <option value="3">Đơn hủy</option>
                 <option value="4">Vận chuyển</option>
                 <option value="5">Đơn hoàn</option>
              </select>
              <span class="margin-left">Tên khách hàng:</span>
              <input type="text" name="search-name-customer" class="input-search margin-left input-border">
              <button type="submit" class="btn btn-primary btn-sm button-search">
                 <i class="fa fa-search"></i>
                 Tìm kiếm
              </button>
            </form>
            <div class="row m-t-30">
                <div class="col-md-12">
                    <div class="table-responsive m-b-40 border-radius">
                      <table class="table table-borderless table-data3">
                          <thead>
                            <tr>
                              <th>Tên khách hàng</th>
                              <th>Tổng tiền</th>
                              <th>Trạng thái</th>
                              <th></th>
                              <th>Ngày đặt hàng</th>
                              <th>Hoạt động</th>
                            </tr>
                          </thead>
                          @foreach ($allOrder as $order)
                          <tbody>
                            <tr>
                                <td><b>{{$order->customer_name}}</b></td>
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

                                @if ($order->order_status == 2 || $order->order_status == 3)
                                  <td></td>
                                @else
                                  <td>
                                    <form action="admin/update-status-order/{{$order->order_id}}" method="POST">
                                      @csrf
                                      <div class="row form-group">
                                        <div class="col col-md-6">
                                          <select class="form-select select-cart" aria-label="Default select example" name="order_status">
                                            <option value="0">Trang thái</option>
                                            <option value="1">Chờ duyệt</option>
                                            <option value="2">Đã giao</option>
                                            <option value="3">Hủy đơn</option>
                                            <option value="4">Vận chuyển</option>
                                            <option value="5">Đơn hoàn</option>
                                          </select>
                                        </div>
                                        <div class="col-12 col-md-6">
                                          <button type="submit" class="btn btn-primary btn-sm">Cập nhật</button>
                                        </div>
                                      </div>

                                    </form>
                                  </td>
                                @endif
                                <td class="text-info">{{$order->created_at}}</td>
                                <td>
                                  <a
                                  href="admin/view-order/{{$order->order_id}}"
                                  class="btn btn-success button_list" ui-toggle-class="">
                                  <i class="fa fa-info-circle text-active"></i>
                                  </a>
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

@endsection