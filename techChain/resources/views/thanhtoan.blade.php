@extends('layout')
@section('noidungchinh')
    <div class="col-md-6 border p-3">
        <h3>Thông tin giao hàng</h3>
        <form method="post" action="luudonhang"> @csrf
            <div class="mb-3">
                <label for="">Họ và tên</label>
                <input type="text" name="ho_ten" class="form-control shadow-none">
            </div>
            <div class="mb-3">
                <label for="">Địa chỉ</label>
                <input type="text" name="dia_chi" class="form-control shadow-none">
            </div>
            <div class="mb-3">
                <label for="">Số điện thoại</label>
                <input type="text" name="dien_thoai" class="form-control shadow-none">
            </div>
            <div class="mb-3">
                <label for="">Email</label>
                <input type="email" name="email" class="form-control shadow-none">
            </div>
            <div class="mb-3">
                <button type="submit" name="btnsunmit" class="btn btn-primary">Lưu đơn hàng</button>
            </div>
        </form>
    </div>
@endsection
