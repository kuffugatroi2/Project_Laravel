@extends('admin_layout')
@section('admin_content')

<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <form role="form" action="{{ route('admin.update_acount_admin', $user->id) }}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="card-header">
                                <strong>Update tài khoản</strong> FORM
                            </div>
                                <div class="card-body card-block">
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label class=" form-control-label">Họ và tên</label>
                                            <input
                                                type="text"
                                                name="name"
                                                placeholder="Vui lòng nhập họ và tên"
                                                class="form-control"
                                                value="{{$user->name}}"
                                            >
                                            @error('name')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label><b>Email</b></label>
                                            <input type="text" name="email" class="form-control" value="{{$user->email}}" disabled>
                                        </div>
                                    </div>
                                    <input type="checkbox" id="change-password" name="change-password">
                                    <label>Đổi mật khẩu</label>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label class="form-control-label">Mật khẩu</label>
                                            <input
                                                type="text"
                                                id="password-input"
                                                name="password"
                                                placeholder="Vui lòng nhập mật khẩu"
                                                class="form-control password"
                                                disabled
                                            >
                                            @error('password')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class=" form-control-label">Nhập lại mật khẩu</label>
                                            <input
                                                type="text"
                                                id="password-input"
                                                name="password-again"
                                                placeholder="Vui lòng nhập lại mật khẩu"
                                                class="form-control password"
                                                disabled
                                            >
                                            @error('password-again')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
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

@section('script')
    <script>
        $(document).ready(function(){
            $("#change-password").change(function() {
                if ($(this).is(":checked")) {
                    $(".password").removeAttr('disabled')
                } else {
                    $(".password").attr('disabled', '')
                }
            });
        });
    </script>
@endsection