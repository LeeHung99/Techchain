@extends('layout')
@section('title') Thông báo @endsection
@section('noidungchinh')
@if (session()->has('thongbao')==true)
<div class="alert alert-danger">
    {{ session()->get('thongbao') }}
</div>
@endif
@endsection
 