@extends('admin_layout')
@section('admin_content')

<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div id="alert" style="opacity: 1; transition: opacity 2s;">
                @include('alert')
            </div>
            {{ Widget::run('ManagerOrderWidget', $request->all())}}
        </div>
    </div>
</div>

@endsection
