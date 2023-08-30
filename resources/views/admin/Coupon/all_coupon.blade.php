@extends('admin_layout')
@section('admin_content')
    {{-- <h3>{{$title2}}</h3> --}}
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                {{$title2}}
                {{-- LIỆT KÊ DANH MỤC SẢN PHẨM --}}
            </div>

            @include('alert')
            <?php
                $message = Session::get('message');
                if ($message) {
                    echo '<div class="alert alert-success">'.$message.'</div>';
                    Session::put('message', null);
                }
            ?>

            {{-- nên dùng như cách này trong alert--}}

            {{-- @if (session('message'))
                <div class="alert alert-danger">
                    {{session('message')}}
                </div>
            @endif --}}

            <div class="row w3-res-tb">
            <div class="col-sm-5 m-b-xs">
                <select class="input-sm form-control w-sm inline v-middle">
                    <option value="0">Bulk action</option>
                    <option value="1">Delete selected</option>
                    <option value="2">Bulk edit</option>
                    <option value="3">Export</option>
                </select>
                <button class="btn btn-sm btn-default">Apply</button>
            </div>
            <div class="col-sm-4">
            </div>
            <div class="col-sm-3">
                <div class="input-group">
                    <input type="text" class="input-sm form-control" placeholder="Search">
                    <span class="input-group-btn">
                    <button class="btn btn-sm btn-default" type="button">Go!</button>
                    </span>
                </div>
            </div>
            </div>
            <div class="table-responsive">
            <table class="table table-striped b-t b-light">
                <thead>
                    <tr>
                        <th style="width:20px;">
                        <label class="i-checks m-b-none">
                        <input type="checkbox"><i></i>
                        </label>
                        </th>
                        <th>Tên mã giảm giá</th>
                        <th>Mã giảm giá</th>
                        <th>Số lượng mã giảm giá</th>
                        <th>Tính năng mã</th>
                        <th>Số % hoặc tiền giảm</th>
                        <th style="width:30px;"></th>
                    </tr>
                </thead>
                @foreach ($coupons as $coupon)
                    <tbody>
                        <tr>
                            <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
                            <td>{{$coupon->coupon_name}}</td>
                            <td>{{$coupon->coupon_code}}</td>
                            <td>{{$coupon->coupon_qty}}</td>
                            <td>
                                @if ($coupon->coupon_condition == 0)
                                    Giảm theo %
                                @else
                                    Giảm theo $
                                @endif
                                {{-- {{$coupon->coupon_condition}} --}}
                            </td>
                            <td>{{$coupon->coupon_number}}</td>
                            {{-- <td>
                                <span class="text-ellipsis">
                                    @if ($coupon->coupon_status == 0)
                                        <a href="active-coupon-product/{{$coupon->coupon_id}}"><span style="font-size: 25px; color: red;" class="fa fa-thumbs-down"></span></a>
                                    @else
                                        <a href="unactive-coupon-product/{{$coupon->coupon_id}}"><span style="font-size: 25px; color: green;" class="fa fa-thumbs-up"></span></a>
                                    @endif
                                </span>
                            </td> --}}
                            <td>
                                <a href="" class="active" ui-toggle-class="">
                                    <i class="fa fa-edit text-success text-active"></i>
                                </a>
                                <a onclick="return confirm('Bạn có chắc muốn xóa mã này không?')" href="delete-coupon/{{$coupon->coupon_id}}" class="active" ui-toggle-class="">
                                    <i class="fa fa-times text-danger text"></i>
                                </a>
                            </td>
                        </tr>
                    </tbody>
                @endforeach
            </table>
            </div>
            <footer class="panel-footer">
            <div class="row">
                <div class="col-sm-5 text-center">
                    <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small>
                </div>
                <div class="col-sm-7 text-right text-center-xs">
                    <ul class="pagination pagination-sm m-t-none m-b-none">
                        <li><a href=""><i class="fa fa-chevron-left"></i></a></li>
                        <li><a href="">1</a></li>
                        <li><a href="">2</a></li>
                        <li><a href="">3</a></li>
                        <li><a href="">4</a></li>
                        <li><a href=""><i class="fa fa-chevron-right"></i></a></li>
                    </ul>
                </div>
            </div>
            </footer>
        </div>
    </div>
@endsection
