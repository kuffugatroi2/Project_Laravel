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
                        <th>Tên thành phố</th>
                        <th>Tên quận huyện</th>
                        <th>Tên phường xã</th>
                        <th>Phí ship</th>
                        {{-- <th>Hiển thị</th> --}}
                        <th style="width:30px;"></th>
                    </tr>
                </thead>
                @foreach ($delivery as $deli)
                    <tbody>
                        <tr>
                            <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
                            <td>{{ $deli->city->name }}</td>
                            <td>{{ $deli->district->name }}</td>
                            <td>{{ $deli->wards->name }}</td>
                            <td
                                contenteditable data-feeship_id="{{ $deli->fee_id }}"
                                class="fee_feeship_edit"
                            >
                                {{-- {{ number_format($deli->fee_feeship, 0, ',', '.').' '.'vnđ' }} --}}
                                {{ number_format($deli->fee_feeship, 0, ',', '.') }}
                            </td>
                            {{-- <td>
                                <span class="text-ellipsis">
                                    @if ($pro->product_status == 0)
                                        <a href="active-product/"><span style="font-size: 25px; color: red;" class="fa fa-thumbs-down"></span></a>
                                    @else
                                        <a href="unactive-product/"><span style="font-size: 25px; color: green;" class="fa fa-thumbs-up"></span></a>
                                    @endif
                                </span>
                            </td> --}}
                            <td>
                                {{-- <a href="edit-product/" class="active" ui-toggle-class="">
                                    <i class="fa fa-edit text-success text-active"></i>
                                </a> --}}
                                <a onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này không?')" href="delete-product/" class="active" ui-toggle-class="">
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

    <script type="text/javascript">
        $(document).ready(function() {
            // fetch_delivery();
            function fetch_delivery() {
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: '{{url('/all-delivery')}}',
                    method: 'POST',
                    data:{
                        _token: _token
                    },
                    success:function(data) {
                        $('#load_delivery').html(data)
                    }
                });
            }

            $(document).on('blur', '.fee_feeship_edit', function() {
                var feeship_id = $(this).data('feeship_id');
                var fee_value = $(this).text();
                var _token = $('input[name="_token"]').val();
                // alert(freeship_id);
                // alert(fee_value);
                $.ajax({
                    url: '{{url('/update-delivery')}}',
                    method: 'POST',
                    data:{
                        feeship_id: feeship_id,
                        fee_value: fee_value,
                        _token: _token
                    },
                    success:function(data) {
                        // fetch_delivery()
                    }
                });
            });
        });
    </script>
@endsection
