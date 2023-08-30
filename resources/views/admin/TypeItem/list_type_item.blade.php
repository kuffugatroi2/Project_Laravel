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
            <form action="{{ route('items.index') }}" method="GET">
            <a class="btn btn-success btn-sm button-status" href="{{ route('items.create') }}">
                <i class="fa fa-plus-circle"> Thêm mới</i>
            </a>
                <span class="margin-left">Trạng thái:</span>
                <select name="select-status" id="select-status" class="from-control input-search margin-left">
                    <option value="all">All</option>
                    <option value="1">Hoạt động</option>
                    <option value="0">Không hoạt động</option>
                </select>
                <span class="margin-left">Tên mặt hàng:</span>
                <input type="text" name="search-name-item" class="input-search margin-left input-border">
                <button type="submit" class="btn btn-primary btn-sm button-search">
                    <i class="fa fa-search"></i>
                    Tìm kiếm
                </button>
            </form>
            <div class="row m-t-30">
                <div class="col-md-12">
                    <!-- DATA TABLE-->
                    <div class="table-responsive m-b-40 border-radius">
                        <table class="table table-borderless table-data3">
                            <thead>
                                <tr>
                                    <th>Tên mặt hàng</th>
                                    <th>Trạng thái</th>
                                    <th>Hoạt động</th>
                                </tr>
                            </thead>
                            @foreach ($items['data'] as $item)
                            <tbody>
                                <tr>
                                    <td>{{$item->item_name}}</td>
                                    <td>
                                        <span class="text-ellipsis">
                                            {{-- Sử dụng function chung của helper thay vì if else trong code blade --}}
                                            {!! convertSatus($item->item_status, $item->item_id) !!}
                                            {{-- @if ($item->item_status == 0)
                                                <a
                                                    onclick="return confirm('Bạn có chắc muốn kích hoạt loại sản phẩm này không?')"
                                                    href="{{ route('items.active_item', $item->item_id) }}"
                                                >
                                                    <span class="fa fa-solid fa-laptop laptop"></span>
                                                </a>
                                            @else
                                                <a
                                                    onclick="return confirm('Bạn có chắc muốn tắt kích hoạt loại sản phẩm này không?')"
                                                    href="{{ route('items.unactive_item', $item->item_id) }}"
                                                >
                                                    <span class="fa fa-solid fa-laptop laptop-crack"></span>
                                                </a>
                                            @endif --}}
                                        </span>
                                    </td>
                                    <td>
                                        <form action="{{ route('items.destroy', $item->item_id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <a
                                                href="{{ route('items.edit', ['item' => $item->item_id]) }}"
                                                class="btn btn-info button_list" ui-toggle-class="">
                                                <i class="fa fa-edit text-active"></i>
                                            </a>
                                            <button
                                                class="btn btn-danger button_list"
                                                type="submit"
                                                onclick="return confirm('Bạn có chắc muốn xóa loại sản phẩm này không?')"
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
                    <!-- END DATA TABLE-->
                </div>
            </div>
        </div>
    </div>
</div>

@endsection