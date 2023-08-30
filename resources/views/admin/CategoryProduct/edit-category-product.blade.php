@extends('admin_layout')
@section('admin_content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <form role="form" action="{{ route('categories.update', ['category' => $category['data']->category_id]) }}" method="post">
                            {{ csrf_field() }}
                            @method('PUT')
                            <div class="card-header">
                                <strong>update thể loại sản phẩm</strong> FORM
                            </div>
                            <div class="card-body card-block">
                                <div class="form-group">
                                    <label>Tên thương hiệu</label>
                                    <select name="brand_id" class="form-control input-sm m-bot15">
                                        <option value="{{ $category['data']->brand_id }}">{{ $category['data']->brand_name }}</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class=" form-control-label">Tên thể loại</label>
                                    <input type="text" id="category_product_name" name="category_product_name" placeholder="Nhập tên thể loại sản phẩm" class="form-control" value="{{ $category['data']->category_name }}">
                                    @error('category_product_name')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    @if (session('errorName'))
                                    <div class="text-danger">
                                        {{ session('errorName')}}
                                    </div>
                                    @endif
                                </div>
                                {{-- <div class="form-group">
                                    <label>Từ khóa</label>
                                    <textarea rows="4" name="meta_keywords_category_product" class="form-control ckeditor" placeholder="Từ khóa thể loại ...">{{ $category['data']->meta_keywords }}</textarea>
                                </div> --}}
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
