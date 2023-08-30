@extends('admin_layout')
@section('admin_content')

<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    {{-- <section>
                        <marquee direction="left" class="marquee">{{$title2}}</marquee>
                    </section> --}}
                    <div class="overview-wrap">
                        <h2 class="title-1" style="margin: auto">Thống kê tổng quan</h2>
                    </div>
                </div>
            </div>
            <br>
            <div>
                <form action="{{ route('dashboard') }}" method="GET">
                    <input type="month" id="month" name="month" value="{{$today}}" class="input-search">
                    <button type="submit" class="btn btn-primary btn-sm button-search">
                        <i class="fa fa-search"></i>
                        Tìm kiếm
                    </button>
                </form>
            </div>
            <div class="row m-t-25">
                <div class="col-sm-6 col-lg-3">
                    <div class="overview-item overview-item--c1">
                        <div class="overview__inner">
                            <div class="overview-box clearfix">
                                <div class="icon">
                                    <i class="zmdi zmdi-calendar-note"></i>
                                </div>
                                <div class="text">
                                    <h2>{{$products}}</h2>
                                    <span>Tổng sản phẩm</span>
                                </div>
                            </div>
                            <div class="overview-chart">
                                <canvas id="widgetChart1"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="overview-item overview-item--c2">
                        <div class="overview__inner">
                            <div class="overview-box clearfix">
                                <div class="icon">
                                    <i class="zmdi zmdi-shopping-cart"></i>
                                </div>
                                <div class="text">
                                    <h2>{{$orders}}</h2>
                                    <span>Tổng đơn</span>
                                </div>
                            </div>
                            <div class="overview-chart">
                                <canvas id="widgetChart2"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="overview-item overview-item--c3">
                        <div class="overview__inner">
                            <div class="overview-box clearfix">
                                <div class="icon">
                                    <i class="zmdi fa-desktop"></i>
                                </div>
                                <div class="text">
                                    <h2>{{$totalNumberOfProductsSold}}</h2>
                                    <span>Đã bán</span>
                                </div>
                            </div>
                            <div class="overview-chart">
                                <canvas id="widgetChart3"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="overview-item overview-item--c4">
                        <div class="overview__inner">
                            <div class="overview-box clearfix">
                                <div class="icon">
                                    <i class="zmdi zmdi-money"></i>
                                </div>
                                <div class="text">
                                <h2>{{$totalRevenue}}.M.₫</h2>
                                    <span>Tổng doanh thu</span>
                                </div>
                            </div>
                            <div class="overview-chart">
                                <canvas id="widgetChart4"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="title-1 m-b-25" style="text-align: center;">Đơn hàng mới</h2>
                    <div>
                        <form action="{{ route('dashboard') }}" method="GET">
                            <span>Từ ngày:</span>
                            <input type="date" id="from-date" name="from-date" value="{{$today}}" class="input-search margin-left">
                            <span class="margin-left">Đến ngày:</span>
                            <input type="date" id="to-date" name="to-date" value="{{$today}}" class="input-search margin-left">
                            <button type="submit" class="btn btn-primary btn-sm button-search">
                                <i class="fa fa-search"></i>
                                Tìm kiếm
                            </button>
                        </form>
                    </div>
                    <br>
                    <div class="table-responsive table--no-card m-b-40">
                        <table class="table table-borderless table-striped table-earning">
                            <thead>
                                <tr>
                                    <th>Tên Khách Hàng</th>
                                    <th>Tổng Tiền</th>
                                    <th>Trạng Thái</th>
                                    <th>Ngày Đặt Hàng</th>
                                    <th class="text-right">Hoạt Động</th>
                                </tr>
                            </thead>
                            @foreach ($newOrders as $order)
                            <tbody>
                                <tr>
                                    <td>{{$order->customer_name}}</td>
                                    <td>{{$order->order_total}}</td>
                                    <td class="text-primary">Chờ duyệt</td>
                                    <td class="text-info">{{$order->created_at}}</td>
                                    <td class="text-right">
                                        <a
                                        href="admin/view-order/{{$order->order_id}}"
                                        class="btn btn-success button_list" ui-toggle-class="">
                                        <i class="fa fa-info-circle text-active"></i>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                            @endforeach
                        </table>
                    </div>
                    <div class="col-lg-12 flex-end">
                        {{ $newOrders->links("pagination::bootstrap-4") }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection