@extends('admin_layout')
@section('admin_content')

<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <form role="form" action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="card-header">
                                <strong>Thêm sản phẩm mới</strong> FORM
                            </div>
                                <div class="card-body card-block">
                                    <div class="form-group">
                                        <label>Loại sản phẩm</label>
                                        <select name="item_id" class="form-control input-sm m-bot15" id="item_id">
                                            <option value="" selected>-------- Vui lòng chọn loại sản phẩm --------</option>
                                            @foreach ($items['data'] as $item)
                                                <option value="{{ $item->item_id }}">{{ $item->item_name }}</option>
                                            @endforeach
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
                                            <option value="" selected>-------- Vui lòng thương hiệu sản phẩm --------</option>
                                            @foreach ($brands['data'] as $brand)
                                                <option value="{{ $brand->brand_id }}">{{ $brand->brand_name }}</option>
                                            @endforeach
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
                                            <option value="" selected>-------- Vui lòng thể loại sản phẩm --------</option>
                                            @foreach ($categories['data'] as $category)
                                                <option value="{{ $category->category_id }}">{{ $category->category_name }}</option>
                                            @endforeach
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
                                        <input type="text" id="product_name" name="product_name" placeholder="Nhập tên sản phẩm" class="form-control">
                                        @error('product_name')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
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
                                                min="0" max="100" step="1" value="1"
                                            >
                                            {{-- <input type="number" name="points" min="0" max="100" step="10" value="30"> --}}
                                            @error('product_quantity')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label><b>Ảnh sản phẩm</b></label>
                                            {{-- <label> --}}
                                            <input type="file" name="product_image" class="form-control" id="exampleInputEmail1" placeholder="haha">
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
                                                min="0" step="10000" value="0"
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
                                                min="0" step="10000" value="0"
                                            >
                                            @error('product_old_price')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Từ khóa</label>
                                        <textarea name="meta_keywords_product" class="form-control ckeditor" placeholder="Từ khóa sản phẩm ..."></textarea>
                                    </div>
                                </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-success btn-sm">
                                    <i class="fa fa-dot-circle-o"></i> Thêm mới
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

@section('script')
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
@endsection