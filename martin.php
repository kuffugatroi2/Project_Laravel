@extends('admin_layout')
@section('admin_content')
  <div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
          {{$title2}}
      </div>

      @include('alert')
      <?php
          $message = Session::get('message');
          if ($message) {
              echo '<div class="alert alert-danger">'.$message.'</div>';
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
                    <th>Tên khách hàng</th>
                    <th>Emails</th>
                    <th>Số điện thoại</th>
                    {{-- <th style="width:30px;"></th> --}}
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
                    <td>{{ $manager_order_by_id->customer_name }}</td>
                    <td>{{ $manager_order_by_id->customer_email }}</td>
                    <td>{{ $manager_order_by_id->customer_phone }}</td>
                </tr>
            </tbody>
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
  <hr>

  <div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
          {{$title3}}
          {{-- LIỆT KÊ DANH MỤC SẢN PHẨM --}}
      </div>

      @include('alert')
      <?php
          $message = Session::get('message');
          if ($message) {
              echo '<div class="alert alert-danger">'.$message.'</div>';
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
                    <th>Tên người Vấn chuyển</th>
                    <th>Địa chỉ</th>
                    <th>Emails</th>
                    <th>Số điện thoại</th>
                    <th>Ghi chú</th>
                    {{-- <th style="width:30px;"></th> --}}
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
                    <td>{{ $manager_order_by_id->shipping_name }}</td>
                    <td>{{ $manager_order_by_id->shipping_address }}</td>
                    <td>{{ $manager_order_by_id->shipping_email }}</td>
                    <td>{{ $manager_order_by_id->shipping_phone }}</td>
                    <td>{{ $manager_order_by_id->shipping_notes }}</td>
                </tr>
            </tbody>
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
  <hr>

  <div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
          {{$title4}}
          {{-- LIỆT KÊ DANH MỤC SẢN PHẨM --}}
      </div>

      @include('alert')
      <?php
          $message = Session::get('message');
          if ($message) {
              echo '<div class="alert alert-danger">'.$message.'</div>';
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
                    <th>Tên sản phẩm</th>
                    <th>Giá</th>
                    <th>Số lượng</th>
                    <th>Tổng tiền</th>
                    <th style="width:30px;"></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
                    <td>{{ $manager_order_by_id->product_name }}</td>
                    <td>{{ $manager_order_by_id->product_price }}</td>
                    <td>{{ $manager_order_by_id->product_sales_quantity }}</td>
                    <td>{{ $manager_order_by_id->product_price * $manager_order_by_id->product_sales_quantity }}</td>
                </tr>
            </tbody>
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