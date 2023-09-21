@extends('admin_layout')
@section('admin_content')

<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div id="alert" style="opacity: 1; transition: opacity 2s;">
                        @include('alert')
                    </div>
                    <form action="{{ route('categories.index') }}" method="GET">
                        <a class="btn btn-success btn-sm button-status" href="{{ route('categories.create') }}">
                            <i class="fa fa-plus-circle"> Thêm mới</i>
                        </a>
                        <span class="margin-left">Trạng thái:</span>
                        <select name="select-status" id="select-status" class="from-control input-search margin-left">
                           <option value="all">All</option>
                           <option value="1">Hoạt động</option>
                           <option value="0">Không hoạt động</option>
                        </select>
                        <span class="margin-left">Tên danh mục:</span>
                        <input type="text" name="search-name-category" class="input-search margin-left input-border">
                        <button type="submit" class="btn btn-primary btn-sm button-search">
                           <i class="fa fa-search"></i>
                           Tìm kiếm
                        </button>
                    </form>

                    <div class="table-responsive table--no-card m-b-30 margin-top">
                        <table class="table table-borderless table-striped table-earning">
                            <thead>
                                <tr>
                                    <th>Tên danh mục</th>
                                    <th>Tên thương hiệu</th>
                                    <th>Trạng thái</th>
                                    <th class="text-right">Hoạt động</th>
                                </tr>
                            </thead>
                            @foreach ($categories['data'] as $category)
                            <tbody>
                                <tr>
                                    <td>{{$category->category_name}}</td>
                                    <td>{{$category->brand_name}}</td>
                                    <td>
                                        <span class="text-ellipsis">
                                            {!! convertSatus($category->category_status, $category->category_id) !!}
                                        </span>
                                    </td>
                                    <td class="text-right">
                                        <form action="{{ route('categories.destroy', $category->category_id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <a
                                               href="{{ route('categories.edit', ['category' => $category->category_id]) }}"
                                               class="btn btn-info button_list" ui-toggle-class="">
                                               <i class="fa fa-edit text-active"></i>
                                            </a>
                                            <button
                                               class="btn btn-danger button_list"
                                               type="submit"
                                               onclick="return confirm('Bạn có chắc muốn xóa thể loại sản phẩm này không?')"
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
                @if (!empty($categories['data']))
                <div class="col-lg-12 flex-end">
                    {{ $categories['data']->links("pagination::bootstrap-4") }}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection
