@if (count($errors) > 0)
    <div class="alert alert-danger">
        @foreach ($errors->all() as $err)
            {{$err}} <br>
        @endforeach
    </div>
@endif

{{-- @if (session('thongbao'))
    <div class="alert alert-danger">
        {{session('thongbao')}}
    </div>
@endif --}}

@if (Session::has('thongbao'))
    <div class="alert alert-danger">
        {{Session::get('thongbao')}}
    </div>
@endif

{{-- @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $err)
                <li>{{$err}}</li>
            @endforeach
        </ul>
    </div>
@endif --}}



