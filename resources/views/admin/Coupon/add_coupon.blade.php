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
                            <form role="form" action="{{URL::to('save-coupon')}}" method="post">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label>Tên mã giảm giá</label>
                                    <input type="text" name="coupon_name" class="form-control" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label>Mã giảm giá</label>
                                    <input type="text" name="coupon_code" class="form-control" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label>Số lượng mã</label>
                                    <input type="text" name="coupon_qty" class="form-control" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label>Tính năng mã</label>
                                    <select name="coupon_condition" class="form-control input-sm m-bot15">
                                        <option value="0">Giảm theo %</option>
                                        <option value="1">Giảm theo $</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Nhập số % hoăc tiền giảm</label>
                                    <input type="text" name="coupon_number" class="form-control" placeholder="">
                                </div>
                                <button type="submit" class="btn btn-info">Thêm mã giảm giá</button>
                            </form>
                        </div>

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
@endsection
