@extends('layouts.layout')
@section('content')
<hr />
<div class="container mt-4">
    <h2>Đăng Ký</h2>
    <form  action="{{ route('home') }}">
        <div class="form-group">

            Tài Khoản<span class="text-danger">*</span> <input type="text" class="form-control w-50" placeholder="Nhập Tài Khoản" id="email">
        </div>
        <div class="form-group">

            Mật Khẩu<span class="text-danger">*</span> <input type="password" class="form-control w-50" placeholder="Nhập Mật Khẩu" id="pwd">
        </div>
        <div class="form-group">

            Họ Tên<span class="text-danger">*</span> <input type="text" class="form-control w-50" placeholder="Nhập Họ Tên" id="pwd">
        </div>
        <div class="form-group">

            Email<span class="text-danger">*</span> <input type="email" class="form-control w-50" placeholder="Nhập Email" id="pwd">
        </div>
        <div class="form-group">

            Địa Chỉ<span class="text-danger">*</span> <input type="text" class="form-control w-50" placeholder="Nhập địa chỉ" id="pwd">
        </div>
        <div class="form-group">

            SĐT<span class="text-danger">*</span> <input type="text" class="form-control w-50" placeholder="Nhập Số Điện Thoại" id="pwd">
        </div>
        <button type="submit" class="btn btn-success">Đăng Ký</button>
    </form>
</div>
@endsection