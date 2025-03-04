@extends('layout')
@section('title')
    Giỏ hàng của bạn
@endsection
@section('noidungchinh')
    <table class="table table-bordered m-auto" id="tblgiohang">
        <caption>SẢN PHẨM BẠN ĐÃ CHỌN </caption>
        <tr>
            <thead class="text-center">
                <th>Tên sản phẩm</th>
                <th>Số lượng </th>
                <th>Đơn giá</th>
                <th>Thành tiền</th>
                <th>Xóa</th>
            </thead>
        </tr>
        @php
            $tongtien = 0;
            $tongsoluong = 0;
            //code để hiện các sản phẩm trong giỏ
            // var_dump($cart) ;
            if (isset($cart)) {
                foreach ($cart as $c) {
                    $id_sp = $c['id_sp'];
                    $soluong = $c['soluong'];

                    $ten_sp = \DB::table('sanpham')
                        ->where('id_sp', '=', $id_sp)
                        ->value('ten_sp');
                    $gia = \DB::table('sanpham')
                        ->where('id_sp', '=', $id_sp)
                        ->value('gia');
                    $hinh = \DB::table('sanpham')
                        ->where('id_sp', '=', $id_sp)
                        ->value('hinh');

                    $thanhtien = $gia * $soluong;
                    $tongtien += $thanhtien;
                    $tongsoluong += $soluong;
                    $thanhtien = number_format($thanhtien, 0, ',', '.');
                    $gia = number_format($gia, 0, ',', '.');
                    echo "<tr>
                                <td><b>{$ten_sp}</b> </td>
                                <td><input type='number' value='{$soluong}' class='form-control'></td>
                                <td> {$gia} </td>
                                <td> {$thanhtien}</td>
                                <td> 
                                    <a  href='/xoasptronggio/{$id_sp}'>Xóa</a> 
                                </td>
                        </tr>";
                }
            }
        @endphp
        <tr>
            <th colspan="5" class='text-center'>
                Số sản phẩm {{ $tongsoluong }} .
                Tổng tiền {{ number_format($tongtien, 0, ',', '.') }} VNĐ
            </th>
        </tr>
        <tr>
            <th colspan="5" class='text-center'>
              <a href="" onclick="history.go(-1)" class="btn btn-success text-bg-success">Trở lại</a> | 
              <a href="/xoagiohang" class="btn btn-primary text-bg-primary">Xóa giỏ hàng</a> | 
              <a href="/thanhtoan" class="btn btn-danger text-bg-danger">Thanh toán</a>
            </th>
         </tr>
    </table>
@endsection
