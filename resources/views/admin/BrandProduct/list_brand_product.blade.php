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
            <form action="{{ route('brands.index') }}" method="GET">
               <a class="btn btn-success btn-sm button-status" href="{{ route('brands.create') }}">
                   <i class="fa fa-plus-circle"> Thêm mới</i>
               </a>
               <span class="margin-left">Trạng thái:</span>
               <select name="select-status" id="select-status" class="from-control input-search margin-left">
                  <option value="all">All</option>
                  <option value="1">Hoạt động</option>
                  <option value="0">Không hoạt động</option>
               </select>
               <span class="margin-left">Tên thương hiệu:</span>
               <input type="text" name="search-name-brand" class="input-search margin-left input-border">
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
                              <th>Tên thương hiệu</th>
                              <th>Trạng thái</th>
                              <th>Hoạt động</th>
                              </tr>
                           </thead>
                           @foreach ($brands['data'] as $brand)
                           <tbody>
                              <tr>
                                 <td>{{$brand->brand_name}}</td>
                                 <td>
                                    <span class="text-ellipsis">
                                        {!! convertSatus($brand->brand_status, $brand->brand_id) !!}
                                 </span>
                                 </td>
                                 <td>
                                    <form action="{{ route('brands.destroy', $brand->brand_id) }}" method="POST">
                                       @csrf
                                       @method('DELETE')
                                       <a
                                          href="{{ route('brands.edit', ['brand' => $brand->brand_id]) }}"
                                          class="btn btn-info button_list" ui-toggle-class="">
                                          <i class="fa fa-edit text-active"></i>
                                       </a>
                                       <button
                                          class="btn btn-danger button_list"
                                          type="submit"
                                          onclick="return confirm('Bạn có chắc muốn xóa thương hiệu này không?')"
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
                @if (!empty($brands['data']))
                <div class="col-lg-12 flex-end">
                    {{ $brands['data']->links("pagination::bootstrap-4") }}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection
