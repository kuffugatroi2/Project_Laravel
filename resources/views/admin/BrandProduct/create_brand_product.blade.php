@extends('admin_layout')
@section('admin_content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <form role="form" action="{{ route('brands.store') }}" method="post">
                            {{ csrf_field() }}
                            <div class="card-header">
                                <strong>Thêm thương hiệu sản phẩm mới</strong> FORM
                            </div>
                            <div class="card-body card-block">
                                <div class="form-group">
                                    <label>Loại sản phẩm</label>
                                    <select name="item_id" class="form-control input-sm m-bot15">
                                    @foreach ($allItem['data'] as $item)
                                        <option value="{{ $item->item_id }}">{{ $item->item_name }}</option>
                                    @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class=" form-control-label">Tên thương hiệu</label>
                                    <input type="text" id="brand_product_name" name="brand_product_name" placeholder="Nhập tên thương hiệu" class="form-control">
                                    @error('brand_product_name')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                {{-- <div class="form-group">
                                    <label>Từ khóa thương hiệu</label>
                                    <textarea rows="4" name="meta_keywords_brand" class="form-control ckeditor" placeholder="Từ khóa ..."></textarea>
                                </div> --}}
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
