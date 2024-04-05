@extends('layout')
@section('noidungchinh')
<h1>Sản phẩm trong loại {{ $title }} </h1>
<div class="row" id="data">
    @foreach ($listsp as $sp )
    <div class="sp col-md-3 mt-4">
        <div class="card">
            <img src="{{$sp->hinh}}" class="card-img-top" alt="...">
            <div class="card-body">
                <a href="/sp/{{$sp->id_sp}}" class="nav-link"> {{$sp->ten_sp}}</a>
                <p class="card-text"><b class="text-danger">{{ number_format( $sp->gia , 0 , "," , ".") }} VNĐ</b></p>
                <button class='btn btn-danger'>Chọn</button>
                <button class="btn btn-primary"> <a href="/sp/{{$sp->id_sp}}" class="nav-link text-bg-primary"> Xem </a> </button>
            </div>
        </div>
    </div>
    @endforeach
</div>
<!-- --phân trang -->
<div class='mt-4 p-2 d-flex justify-content-center'> {{ $listsp->onEachSide(3)->links() }} </div>
@endsection