@extends('layouts.layout')
@section('content')
<hr />
<div class="container">
    <h2>Đăng Nhập</h2>
    <form action="{{ route('home') }}" data-id="login" method="POST">
        @csrf
        <div class="form-group">
            Tài Khoản <input type="email" class="form-control" placeholder="Nhập Tài Khoản" id="email">
        </div>
        <div class="form-group">

            Mật Khẩu <input type="password" class="form-control" placeholder="Nhập Mật Khẩu" id="pwd">
        </div>
        <div class="form-group form-check">
            <label class="form-check-label">
                <input class="form-check-input" type="checkbox"> Remember me
            </label>
        </div>
        <button type="submit" class="btn btn-primary">Đăng Nhập</button>
    </form>
    <div class="mt-4 w-25 text-center">
        <a class="btn btn-outline-info" href="#"><img src="images/fb.jpg" style="height: 20px;" /> Đăng nhập bằng Facebook</a></br>
    </div>
    <div class="mt-4  w-25 text-center" style="border-radius: 10px 10px 10px 10px;">
        <a class="btn btn-outline-info" href="#"><img src="images/Google.jpg" style="height: 20px;" /> Đăng nhập bằng Google</a></br>
    </div>
    <p class="mt-4">Chưa Có Tài Khoản?<a href="/register">Đăng Ký Ngay</a></p>
</div>
<hr>
@endsection