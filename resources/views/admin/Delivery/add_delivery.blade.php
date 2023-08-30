@extends('admin_layout')
@section('admin_content')
    {{-- <h3>{{$title2}}</h3> --}}
    <div class="form-w3layouts">
        <!-- page start-->
        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        {{$title2}}
                    </header>
                    <div class="panel-body">
                        <div class="position-center">
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
                            {{-- <form role="form" action="{{ URL::to('save-brand-product') }}" method="post"> --}}

                            <form>
                                @csrf
                                <div class="form-group">
                                    <label>Chọn thành phố</label>
                                    <select name="city" id="city" class="form-control input-sm m-bot15 choose city">
                                        <option>---- Chọn tỉnh / thành phố ----</option>
                                        @foreach ($cities as $city)
                                            <option value="{{ $city->matp }}">{{ $city->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Chọn quận / huyện</label>
                                    <select name="district" id="district" class="form-control input-sm m-bot15 choose district">
                                        <option>---- Chọn quận / huyện----</option>
                                        @foreach ($districts as $district)
                                            <option value="{{ $district->maqh }}">{{ $district->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Chọn xã phường</label>
                                    <select name="wards" id="wards" class="form-control input-sm m-bot15 wards">
                                        <option>---- Chọn xã / phường----</option>
                                        @foreach ($wards as $ward)
                                        <option value="{{ $ward->xaid }}">{{ $ward->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Phí vận chuyển</label>
                                    <input type="text" name="fee_ship" class="form-control fee_ship" placeholder="">
                                </div>
                                <button type="button" name="add_delivery" class="btn btn-info add_delivery">Thêm phí vận chuyển</button>
                            </form>
                        </div>

                        <div id="load_delivery"></div>
                    </div>
                </section>
            </div>
            {{-- <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        Horizontal Forms
                    </header>
                    <div class="panel-body">
                        <div class="position-center">
                            <form class="form-horizontal" role="form">
                            <div class="form-group">
                                <label for="inputEmail1" class="col-lg-2 col-sm-2 control-label">Email</label>
                                <div class="col-lg-10">
                                    <input type="email" class="form-control" id="inputEmail1" placeholder="Email">
                                    <p class="help-block">Example block-level help text here.</p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword1" class="col-lg-2 col-sm-2 control-label">Password</label>
                                <div class="col-lg-10">
                                    <input type="password" class="form-control" id="inputPassword1" placeholder="Password">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-offset-2 col-lg-10">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox"> Remember me
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-offset-2 col-lg-10">
                                    <button type="submit" class="btn btn-danger">Sign in</button>
                                </div>
                            </div>
                        </form>
                        </div>
                    </div>
                </section>

            </div> --}}
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            $('.add_delivery').click(function() {
                var city = $('.city').val();
                var district = $('.district').val();
                var wards = $('.wards').val();
                var fee_ship = $('.fee_ship').val();
                var _token = $('input[name="_token"]').val();
                // alert(city);
                // alert(district);
                // alert(wards);
                // alert(fee_ship);
                $.ajax({
                    url: '{{url('/save-delivery')}}',
                    method: 'POST',
                    data:{
                        city: city,
                        district: district,
                        wards: wards,
                        fee_ship: fee_ship,
                        _token: _token
                    },
                    success:function(data) {
                        alert("Thêm phí vận chuyển thành công!");
                        // swal("Thêm phí vận chuyển thành công!")
                        window.location.href = '{{ url('/all-delivery') }}';
                    }
                });
            });
            $('.choose').on('change', function() {
                // debugger;
                var action = $(this).attr('id');
                var ma_id = $(this).val();
                var _token = $('input[name="_token"]').val();
                var result = '';
                // alert(action);
                // alert(ma_id);
                // alert(_token);
                if (action == 'city') {
                    result = 'district';
                } else {
                    result = 'wards';
                }
                $.ajax({
                    url: '{{url('/add-delivery')}}',
                    method: 'POST',
                    data:{
                        action: action,
                        ma_id: ma_id,
                        _token: _token
                    },
                    success:function(data) {
                        // debugger;
                        $('#' + result).html(data);
                    }
                });
            });
        });
    </script>
@endsection
