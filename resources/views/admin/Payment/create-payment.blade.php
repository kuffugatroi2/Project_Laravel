@extends('admin_layout')
@section('admin_content')

<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <form role="form" action="{{ route('payments.store') }}" method="post">
                            {{ csrf_field() }}
                            <div class="card-header">
                                <strong>Thêm Phương thức thanh toán mới</strong> FORM
                            </div>
                            <div class="card-body card-block">
                                <div class="form-group">
                                    <label class=" form-control-label">Tên Phương thức</label>
                                    <input type="text" id="category_product_name" name="payment-method" placeholder="Nhập tên thể loại sản phẩm" class="form-control">
                                    @error('payment-method')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Mô tả</label>
                                    <textarea
                                        name="payment-description"
                                        class="form-control ckeditor"
                                        id="exampleInputPassword1"
                                        rows="6"
                                        placeholder="Mô tả phương thức ..."></textarea>
                                    @error('payment-description')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
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
