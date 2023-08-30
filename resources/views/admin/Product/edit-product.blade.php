@extends('admin_layout')
@section('admin_content')

<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <form role="form" action="{{ route('products.update', $product['data']->product_id) }}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            @method('PUT')
                            <div class="card-header">
                                <strong>Update sản phẩm</strong> FORM
                                {{-- <small> Form</small> --}}
                            </div>
                            {{-- <div class="row"> --}}
                                <div class="card-body card-block">
                                    <div class="form-group">
                                        <label>Loại sản phẩm</label>
                                        <select name="item_id" class="form-control input-sm m-bot15" id="item_id">
                                            <option value="{{ $product['data']->item_id }}">{{ $product['data']->item_name }}</option>
                                        </select>
                                        @if (session('error'))
                                        <div class="text-danger">
                                            {{ session('error')}}
                                        </div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Thương hiệu sản phẩm</label>
                                        <select name="brand_id" class="form-control input-sm m-bot15" id="brand_id">
                                            <option value="{{ $product['data']->brand_id }}">{{ $product['data']->brand_name }}</option>
                                        </select>
                                        @if (session('error'))
                                        <div class="text-danger">
                                            {{ session('error')}}
                                        </div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Thể loại sản phẩm</label>
                                        <select name="category_id" class="form-control input-sm m-bot15" id="category_id">
                                            <option value="{{ $product['data']->category_id }}">{{ $product['data']->category_name }}</option>
                                        </select>
                                        @if (session('error'))
                                        <div class="text-danger">
                                            {{ session('error')}}
                                        </div>
                                        @endif
                                        @if (session('error_1'))
                                        <div class="text-danger">
                                            {{ session('error_1')}}
                                        </div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label class=" form-control-label">Tên sản phẩm</label>
                                        <input
                                            type="text" id="product_name" name="product_name"
                                            placeholder="Nhập tên sản phẩm"
                                            class="form-control"
                                            value="{{ $product['data']->product_name }}"
                                        >
                                        @error('product_name')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                        @if (session('errorName'))
                                        <div class="text-danger">
                                            {{ session('errorName')}}
                                        </div>
                                        @endif
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label class=" form-control-label">Số lượng</label>
                                            <input
                                                type="number"
                                                id="product_quantity"
                                                name="product_quantity"
                                                placeholder="Nhập số lượng sản phẩm"
                                                class="form-control"
                                                min="0" max="100" step="1" value="{{ $product['data']->product_quantity }}"
                                            >
                                            @error('product_quantity')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label><b>Ảnh sản phẩm</b></label>
                                            {{-- <label> --}}
                                            <img src="uploads/product/{{ $product['data']->product_image }}" alt="" width="200px" height="200px" style="margin-bottom: 15px">
                                            <input type="file" name="product_image" class="form-control" id="exampleInputEmail1" placeholder="">
                                            @if (session('errorImage'))
                                            <div class="text-danger">
                                                {{ session('errorImage')}}
                                            </div>
                                            @endif
                                            {{-- </label> --}}
                                            @error('product_image')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label class=" form-control-label">Giá hiện tại</label>
                                            <input
                                                type="number"
                                                id="product_name"
                                                name="product_price"
                                                placeholder="Nhập giá bán sản phẩm hiện tại"
                                                class="form-control"
                                                min="0" step="10000" value="{{ $product['data']->product_price }}"
                                            >
                                            @error('product_price')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class=" form-control-label">Giá cũ</label>
                                            <input
                                                type="number"
                                                id="product_name"
                                                name="product_old_price"
                                                placeholder="Nhập giá cũ sản phẩm"
                                                class="form-control"
                                                min="0" step="10000" value="{{ $product['data']->product_old_price }}"
                                            >
                                            @error('product_old_price')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Từ khóa</label>
                                        <textarea name="meta_keywords_product" class="form-control ckeditor" placeholder="Từ khóa sản phẩm ...">{{ $product['data']->meta_keywords }}</textarea>
                                    </div>
                                </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-success btn-sm">
                                    <i class="fa fa-dot-circle-o"></i> Chỉnh sửa
                                </button>
                                <button type="reset" class="btn btn-danger btn-sm">
                                    <i class="fa fa-ban"></i> Reset
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

{{-- @section('script')
<script>
    $(document).ready(function() {
        $("#item_id").change(function() {
            var item_id =$(this).val(); // Lấy id của chính nó (item)
            $.get("admin/brands-ajax/"+item_id, function(data) { // gọi ajax
                // alert(data);
                $("#brand_id").html(data); //truyền lại cho brand
            })
            // alert(item_id);
        });

        $("#brand_id").change(function() {
            var brand_id =$(this).val(); // Lấy id của chính nó (brand)
            $.get("admin/categories-ajax/"+brand_id, function(data) { // gọi ajax
                // alert(data);
                $("#category_id").html(data); //truyền lại cho category
            })
            // alert(brand_id);
        });
    });
</script>
@endsection --}}