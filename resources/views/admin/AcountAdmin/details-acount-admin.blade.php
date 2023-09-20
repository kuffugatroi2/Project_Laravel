@extends('admin_layout')
@section('admin_content')

<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div id="alert" style="opacity: 1; transition: opacity 2s;">
                @include('alert')
            </div>
            <div class="row m-t-30">
                <div class="col-md-12">
                    <div class="table-responsive m-b-40">
                      <table class="table table-borderless table-data3">
                          <thead>
                            <tr>
                              <th>Tên</th>
                              <th>Email</th>
                              <th>Số điện thoại</th>
                              <th>Ngày tạo</th>
                              <th>Hoạt động</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                                <td><b>{{$user->name}}</b></td>
                                <td class="text-info">{{$user->email}}</td>
                                <td class="text-info">{{$user->phone}}</td>
                                <td class="text-info">{{$user->created_at}}</td>
                                <td>
                                    <a
                                    href="{{ route('admin.edit_acount_admin', $user->id) }}"
                                    class="btn btn-info button_list" ui-toggle-class="">
                                    <i class="fa fa-edit text-active"></i>
                                    </a>
                                </td>
                          </tbody>
                      </table>
                    </div>
                    {{-- @if (!empty($products['data']))
                    <div class="col-lg-12 flex-end">
                      {{ $allOrder->links("pagination::bootstrap-4") }}
                    </div>
                    @endif --}}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
