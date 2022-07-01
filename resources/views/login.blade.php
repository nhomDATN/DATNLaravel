@extends('layouts.layout')
@section('content')
<hr />
<div class="container">
    <h2>Đăng Nhập</h2>
    <form action="{{ route('login') }}" method="POST">
        @csrf
        <div class="form-group">
            Email <input type="email" class="form-control" placeholder="Nhập Email" name="Email" required>
        </div>
        <div class="form-group">

            Mật Khẩu <input type="password" class="form-control" placeholder="Nhập Mật Khẩu" name="Password" required>
        </div>
        
        {{-- <div class="form-group form-check">
            <input name="remember" class="form-check-input" type="checkbox" value="{{ time() }}">
            <label for="remember" style="padding-left: 10px;">Ghi nhớ mật khẩu</label>
        </div> --}}
        <button type="submit" class="btn btn-primary">Đăng Nhập</button>
    </form>
    {{-- <div class="mt-4 w-25 text-center">
        <a class="btn btn-outline-info" href="#"><img src="images/fb.jpg" style="height: 20px;" /> Đăng nhập bằng Facebook</a></br>
    </div>
    <div class="mt-4  w-25 text-center" style="border-radius: 10px 10px 10px 10px;">
        <a class="btn btn-outline-info" href="#"><img src="images/Google.jpg" style="height: 20px;" /> Đăng nhập bằng Google</a></br>
    </div> --}}
    <p class="mt-4">Chưa Có Tài Khoản? <a href="/dangky">Đăng Ký Ngay</a></p>
    <p class="mt-4"><a href="/forgotpassword">Quên mật khẩu?</a></p>
    <p class="mt-4">Bạn quên kích hoạt tài khoản? <a href="/Reverify_Email">Click</a> vào đây để kích hoạt tài khoản!</p>
    <p class="mt-4"><a href="/admin/login">Là Admin?</a></p>
</div>
{{-- <p>{!! QrCode::size(250)->generate('www.google.com'); !!}</p> --}}
<hr>
    @if(session('message'))
    <script>
            alert('Sai tài khoản!');
    </script>
    @endif
    @if(session('messageConfirm'))
    <script>
            alert('Tài khoản chưa được kích hoạt, vui lòng vào email để kích hoạt tài khoản!');
    </script>
    @endif
    @if(session('errorPassword'))
    <script>
            alert('Sai mật khẩu!');
    </script>
    @endif
@endsection