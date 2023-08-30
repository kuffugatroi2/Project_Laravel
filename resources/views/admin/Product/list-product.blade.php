@extends('admin_layout')
@section('admin_content')

<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
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
                    <form action="{{ route('products.index') }}" method="GET">
                        <a class="btn btn-success btn-sm button-status" href="{{ route('products.create') }}">
                            <i class="fa fa-plus-circle"> Thêm mới</i>
                        </a>
                        <span class="margin-left">Trạng thái:</span>
                        <select name="select-status" id="select-status" class="from-control input-search margin-left">
                           <option value="all">All</option>
                           <option value="1">Hoạt động</option>
                           <option value="0">Không hoạt động</option>
                        </select>
                        <span class="margin-left">Tên sản phẩm:</span>
                        <input type="text" name="search-name-product" class="input-search margin-left input-border">
                        <button type="submit" class="btn btn-primary btn-sm button-search">
                           <i class="fa fa-search"></i>
                           Tìm kiếm
                        </button>
                    </form>
                    {{-- <a class="btn btn-success mb-2" href="{{ route('products.create') }}">
                        <i class="fa fa-plus-circle"> Thêm mới</i>
                    </a> --}}
                    <div class="table-responsive table--no-card m-b-30 margin-top">
                        <table class="table table-borderless table-striped table-earning">
                            <thead>
                                <tr>
                                    <th>Tên sản phẩm</th>
                                    <th>Giá mới</th>
                                    <th>Giá cũ</th>
                                    <th>Ảnh</th>
                                    <th>Số lượng</th>
                                    <th class="text-right">Tên thể loại</th>
                                    <th class="text-right">Trạng thái</th>
                                    <th class="text-right">Hoạt động</th>
                                </tr>
                            </thead>
                            @foreach ($products['data'] as $product)
                            <tbody>
                                <tr>
                                    <td class="format-text-2-line">
                                        <h5 class="format-text-2-line">{{$product->product_name}}</h5>
                                    </td>
                                    <td class="text-info">{{$product->product_price}}</td>
                                    <td class="text-danger">
                                        @if ($product->product_old_price == 0)
                                            {{$product->product_old_price}}
                                        @else
                                        <strike>
                                            {{$product->product_old_price}}
                                        </strike>
                                        @endif
                                    </td>
                                    <td>
                                        <img src="uploads/product/{{$product->product_image}}" style="max-height: 70px; max-width: 100px;" alt="">
                                    </td>
                                    <td>{{$product->product_quantity}}</td>
                                    <td class="text-right">{{$product->category_name}}</td>
                                    <td>
                                        <span class="text-ellipsis">
                                            {!! convertSatus($product->product_status, $product->product_id) !!}
                                        </span>
                                    </td>
                                    <td class="text-right">
                                        <form action="{{ route('products.destroy', $product->product_id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <a
                                               href="{{ route('products.show', ['product' => $product->product_id]) }}"
                                               class="btn btn-success button_list" ui-toggle-class="">
                                               <i class="fa fa-info-circle text-active"></i>
                                            </a>
                                            <a
                                               href="{{ route('products.edit', ['product' => $product->product_id]) }}"
                                               class="btn btn-info button_list" ui-toggle-class="">
                                               <i class="fa fa-edit text-active"></i>
                                            </a>
                                            <button
                                               class="btn btn-danger button_list"
                                               type="submit"
                                               onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này không?')"
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
                @if (!empty($products['data']))
                <div class="col-lg-12 flex-end">
                    {{ $products['data']->links("pagination::bootstrap-4") }}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection
