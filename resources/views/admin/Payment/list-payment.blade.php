@extends('admin_layout')
@section('admin_content')

<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            @include('alert')
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
            <form action="{{ route('payments.index') }}" method="GET">
               <a class="btn btn-success btn-sm button-status" href="{{ route('payments.create') }}">
                  <i class="fa fa-plus-circle"> Thêm mới</i>
               </a>
               <span class="margin-left">Trạng thái:</span>
               <select name="select-status" id="select-status" class="from-control input-search margin-left">
                  <option value="all">All</option>
                  <option value="1">Hoạt động</option>
                  <option value="0">Không hoạt động</option>
               </select>
               <span class="margin-left">Tên phương thức:</span>
               <input type="text" name="search-name-payment" class="input-search margin-left input-border">
               <button type="submit" class="btn btn-primary btn-sm button-search">
                  <i class="fa fa-search"></i>
                  Tìm kiếm
               </button>
            </form>
            <div class="row m-t-30">
                <div class="col-md-12">
                    <!-- DATA TABLE-->
                    {{-- <div class="row w3-res-tb">
                        <div class="col-sm-5 m-b-xs">
                           <a class="btn btn-success mb-2" href="{{ route('payments.create') }}">
                              <i class="fa fa-plus-circle"> Thêm mới</i>
                           </a>
                        </div>
                     </div> --}}
                    <div class="table-responsive m-b-40 border-radius">
                        <table class="table table-borderless table-data3">
                           <thead>
                              <tr>
                              <th>Phương thức thanh toán</th>
                              <th>mô tả</th>
                              <th>Trạng thái</th>
                              <th>Hoạt động</th>
                              </tr>
                           </thead>
                           @foreach ($payments['data'] as $payment)
                           <tbody>
                              <tr>
                                 <td>{{$payment->payment_method}}</td>
                                 <td style="width: 420px" class="text-info">
                                    {!!$payment->payment_desc!!}
                                </td>
                                 <td>
                                    <span class="text-ellipsis">
                                        {!! convertSatus($payment->payment_status, $payment->payment_id) !!}
                                       {{-- @if ($payment->payment_status == 0)
                                          <a
                                             onclick="return confirm('Bạn có chắc muốn kích hoạt phương thức thanh toán này không?')"
                                             href="{{ route('payments.active_payment', $payment->payment_id) }}"
                                          >
                                             <span class="fa fa-solid fa-dollar laptop"></span>
                                          </a>
                                       @else
                                          <a
                                             onclick="return confirm('Bạn có chắc muốn tắt kích hoạt phương thức thanh toán này không?')"
                                             href="{{ route('payments.unactive_payment', $payment->payment_id) }}"
                                          >
                                             <span class="fa fa-solid fa-dollar laptop-crack"></span>
                                          </a>
                                       @endif --}}
                                     </span>
                                 </td>
                                 <td>
                                    <form action="{{ route('payments.destroy', $payment->payment_id) }}" method="POST">
                                       @csrf
                                       @method('DELETE')
                                       <a
                                          href="{{ route('payments.edit', ['payment' => $payment->payment_id]) }}"
                                          class="btn btn-info button_list" ui-toggle-class="">
                                          <i class="fa fa-edit text-active"></i>
                                       </a>
                                       <button
                                          class="btn btn-danger button_list"
                                          type="submit"
                                          onclick="return confirm('Bạn có chắc muốn xóa phương thức thanh toán này không?')"
                                       >
                                          <i class="fa fa-trash"></i>
                                       </button>
                                    </form>
                                    </td>
                              </tr>
                           </tbody>
                           @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
