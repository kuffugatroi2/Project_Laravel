@extends('admin_layout')
@section('admin_content')

<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                   <div class="card">
                      <form action="{{ route('items.update', ['item' => $item['data']->item_id]) }}" method="POST" enctype="multipart/form-data">
                        <div class="card-header">
                            <strong>Update loại sản phẩm</strong> FORM
                        </div>
                        <div class="card-body card-block">
                            @csrf
                            @method('PUT')
                            <div class="row">
                               <div class="col-md-12">
                                  <div class="form-group">
                                     <label for="name"><b>Tên Loại sản phẩm</b></label>
                                     <input class="form-control" value="{{ $item['data']->item_name }}" name="item_name" id="item_name">
                                     @error('item_name')
                                     <div class="text-danger">{{ $message }}</div>
                                     @enderror
                                  </div>
                               </div>
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