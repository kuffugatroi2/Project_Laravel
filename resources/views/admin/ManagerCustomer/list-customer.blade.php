@extends('admin_layout')
@section('admin_content')

<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
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
            <form action="{{ route('customer.get_list_customer') }}" method="GET">
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
                              <th>STT</th>
                              <th>Tên khách hàng</th>
                              <th>Email</th>
                              <th>Số điện thoại</th>
                              <th>Ngày tạo</th>
                              <th>Hoạt động</th>
                            </tr>
                          </thead>
                          @foreach ($customers as $key => $customer)
                          <tbody>
                            <tr>
                                <td>{{$key + 1}}</td>
                                <td><b>{{$customer->customer_name}}</b></td>
                                <td class="text-info">{{$customer->customer_email}}</td>
                                <td class="text-info">{{$customer->customer_phone}}</td>
                                <td class="text-info">{{$customer->created_at}}</td>
                                <td>
                                  <a
                                    href="{{route('customer.delete_customer', $customer->customer_id)}}"
                                    class="btn btn-danger button_list"
                                    onclick="return confirm('Bạn có chắc muốn xóa khách hàng này không?')"
                                    style="color: white;"
                                  >
                                    <i class="fa fa-trash"></i>
                                  </a>
                                </td>
                          </tbody>
                          @endforeach
                      </table>
                    </div>
                    {{-- @if (!empty($products['data']))
                    <div class="col-lg-12 flex-end">
                      {{ $allOrder->links("pagination::bootstrap-4") }}
                    </div>
                    @endif --}}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection