@extends('admin_layout')
@section('admin_content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <form role="form" action="{{ route('brands.update', ['brand' => $brand['data']->brand_id]) }}" method="post">
                            {{ csrf_field() }}
                            @method('PUT')
                            <div class="card-header">
                                <strong>Update thương hiệu sản phẩm</strong> FORM
                            </div>
                            <div class="card-body card-block">
                                <div class="form-group">
                                    <label>Loại sản phẩm</label>
                                    <select name="item_id" class="form-control input-sm m-bot15">
                                        <option value="{{ $brand['data']->item_id }}">{{ $brand['data']->item_name }}</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class=" form-control-label">Tên thương hiệu</label>
                                    <input type="text" id="brand_product_name" name="brand_product_name" placeholder="Nhập tên thương hiệu" class="form-control" value="{{$brand['data']->brand_name}}">
                                    @error('brand_product_name')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    @if (session('errorName'))
                                    <div class="text-danger">
                                        {{ session('errorName')}}
                                    </div>
                                    @endif
                                </div>
                                {{-- <div class="form-group">
                                    <label>Từ khóa thương hiệu</label>
                                    <textarea rows="4" name="meta_keywords_brand" class="form-control ckeditor" placeholder="Từ khóa ...">{{ $brand['data']->meta_keywords }}</textarea>
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
