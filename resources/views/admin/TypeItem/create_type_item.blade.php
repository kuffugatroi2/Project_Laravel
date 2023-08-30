@extends('admin_layout')
@section('admin_content')

<div class="main-content">
   <div class="section__content section__content--p30">
       <div class="container-fluid">
           <div class="row">
               <div class="col-lg-12">
                  <div class="card">
                     <form class="" action="{{ route('items.store') }}" method="POST" enctype="multipart/form-data">
                       <div class="card-header">
                           <strong>Thêm loại sản phẩm mới</strong> FORM
                       </div>
                       <div class="card-body card-block">
                           @csrf
                           <div class="row">
                              <div class="col-md-12">
                                 <div class="form-group">
                                    <label for="name"><b>Tên Loại sản phẩm</b></label>
                                    <input class="form-control" value="{{ old('name') }}" name="item_name" id="item_name" placeholder="Nhập tên loại sản phẩm">
                                    @error('item_name')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                 </div>
                              </div>
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