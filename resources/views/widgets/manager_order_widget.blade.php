<button type="button" class="btn btn-primary show-filter">Bộ lọc <i class="fa fa-caret-down"></i></button>
<form class="d-none" id="filter-form" action="{{ route('order.manager_order') }}" method="GET">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div>
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
                </div>
                <br>
                <div class="d-flex justify-content-center align-items-center">
                    <span class="margin-left">Từ ngày:</span>
                    <input type="date" id="from-date" name="from-date" value="{{ $today ?? '' }}"
                        class="input-search margin-left">
                    <span class="margin-left">Đến ngày:</span>
                    <input type="date" id="to-date" name="to-date" value="{{ $today ?? '' }}"
                        class="input-search margin-left">

                    <button type="submit" class="   btn btn-primary btn-sm button-search">
                        <i class="fa fa-search"></i>
                        Tìm kiếm
                    </button>
                </div>
            </div>
        </div>
    </div>
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
                @if (isset($allOrder))
                    @foreach ($allOrder as $order)
                        <tbody>
                            <tr>
                                <td><b>{{ $order->customer_name }}</b></td>
                                <td class="text-info">{{ $order->order_total }}</td>
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
                                        <form action="admin/update-status-order/{{ $order->order_id }}" method="POST">
                                            @csrf
                                            <div class="row form-group">
                                                <div class="col col-md-6">
                                                    <select class="form-select select-cart"
                                                        aria-label="Default select example" name="order_status">
                                                        <option value="0">Trang thái</option>
                                                        <option value="1">Chờ duyệt</option>
                                                        <option value="2">Đã giao</option>
                                                        <option value="3">Hủy đơn</option>
                                                        <option value="4">Vận chuyển</option>
                                                        <option value="5">Đơn hoàn</option>
                                                    </select>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <button type="submit" class="btn btn-primary btn-sm">Cập
                                                        nhật</button>
                                                </div>
                                            </div>

                                        </form>
                                    </td>
                                @endif
                                <td class="text-info">{{ $order->created_at }}</td>
                                <td>
                                    <a href="admin/view-order/{{ $order->order_id }}"
                                        class="btn btn-success button_list" ui-toggle-class="">
                                        <i class="fa fa-info-circle text-active"></i>
                                    </a>
                                </td>
                        </tbody>
                    @endforeach
                @endif
            </table>
        </div>
        @if (!empty($allOrder))
            <div class="col-lg-12 flex-end">
                {{ $allOrder->links('pagination::bootstrap-4') }}
            </div>
        @endif
    </div>
</div>

<script>
    /*
        document.addEventListener('DOMContentLoaded', function () { ... });
        - Đoạn mã này đảm bảo rằng tất cả các phần tử html được tải hoàn toàn
        trước khi thực hiện các hành động của javascript
        DOMContentLoaded: để đảm bảo rằng mã Javascript sẽ thực hiện sau khi trang đã được tải xong
    */

    document.addEventListener('DOMContentLoaded', function() {
        // Chọn phần tử có class là "show-filter"
        var showFilterBtn = document.querySelector('.show-filter');

        // chọn form có id='filter-form'
        var filterForm = document.getElementById('filter-form');
        // chọn icon trong button
        var iconFilter = showFilterBtn.querySelector('i');

        // Gán sự kiện click cho phần tử
        showFilterBtn.addEventListener('click', function() {
            // Kiểm tra trạng thái hiện tại của form
            var isFormHidden = filterForm.classList.contains('d-none');
            if (isFormHidden) {
                filterForm.classList.remove('d-none');
                iconFilter.classList.remove('fa-caret-down')
                iconFilter.classList.add('fa-caret-up')
            } else {
                filterForm.classList.add('d-none');
                iconFilter.classList.remove('fa-caret-up')
                iconFilter.classList.add('fa-caret-down')
            }
        });
    });
</script>
