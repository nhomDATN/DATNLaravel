@extends('layouts.layout')
@section('content')
<hr />
<div class="container mt-4">
    <h2>Đăng Ký</h2>
    <form  action="{{ route('homeuser') }}">
        <div class="form-group">
            Email<span class="text-danger">*</span> <input name="Email" type="email" class="form-control w-50" placeholder="Nhập Email" required>
        </div>
        <div class="form-group">
            Mật Khẩu<span class="text-danger">*</span> <input name="Password" type="password" class="form-control w-50" placeholder="Nhập Mật Khẩu" required>
        </div>
        <div class="form-group">
            Họ Tên<span class="text-danger">*</span> <input name="Fullname" type="text" class="form-control w-50" placeholder="Nhập Họ Tên" required>
        </div>
        <div class="form-group">
            Địa Chỉ<span class="text-danger">*</span> <input name="Address" type="text" class="form-control w-50" placeholder="Nhập địa chỉ">
        </div>
        <div class="form-group">
            SĐT<span class="text-danger">*</span> <input name="Phone" type="text" class="form-control w-50" value="old(Phone)" placeholder="Nhập Số Điện Thoại">
        </div>
        <button type="submit" class="btn btn-success">Đăng Ký</button>
    </form>
    <p class="mt-4">Quay lại <a href="/login">Đăng Nhập!</a></p>
</div>
@if(session('message'))
<script>
        alert('Sai tài khoản hoặc mật khẩu!');
</script>
@endif
@endsection