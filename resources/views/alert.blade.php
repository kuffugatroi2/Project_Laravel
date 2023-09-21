{{-- @if (count($errors) > 0)
    <div class="alert alert-danger">
        @foreach ($errors->all() as $err)
            {{$err}} <br>
        @endforeach
    </div>
@endif --}}

{{-- @if (session('message'))
    <div class="alert alert-danger">
        {{session('thongbao')}}
    </div>
@endif --}}

{{-- @if (Session::has('message'))
    <div class="alert alert-danger">
        {{Session::get('thongbao')}}
    </div>
@endif --}}

{{-- @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $err)
                <li>{{$err}}</li>
            @endforeach
        </ul>
    </div>
@endif --}}

<?php
$message = Session::get('message');
if ($message) {
echo '<div class="alert alert-success">' . $message . '</div>';
Session::put('message', null);
}
?>
@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
