@extends('layouts.layout')
@section('content')
<hr />
<div class="container mt-4 center">
    <h2>Đăng Ký</h2>
    <form id="form"  action="{{ route('dangky') }}" method="post">
        @csrf
        <div class="form-group">
            Email<span class="text-danger">*</span> <input name="email" type="email" class="form-control" placeholder="Nhập Email" required>
        </div>
        <div class="form-group">
            Mật Khẩu<span class="text-danger">*</span> <input name="password" type="password" class="form-control " placeholder="Nhập Mật Khẩu" required>
        </div>
        <div class="form-group">
            Nhập lại mật Khẩu<span class="text-danger">*</span> <input name="password_confirm" type="password" class="form-control " placeholder="Nhập Lại Mật Khẩu" required>
        </div>
        <div class="form-group">
            Họ Tên<span class="text-danger">*</span> <input name="fullname" type="text" class="form-control" placeholder="Nhập Họ Tên" required>
        </div>
        <div class="form-group">
            Ngày Sinh<span class="text-danger">*</span> <input name="datetime" type="date" class="form-control " required>
        </div>
        <div class="form-group">
            Địa Chỉ<span class="text-danger">*</span> <input name="address" type="text" class="form-control" placeholder="Nhập địa chỉ">
        </div>
        <div class="form-group">
            SĐT<span class="text-danger">*</span> <input name="phone" type="text" class="form-control" value="" placeholder="Nhập Số Điện Thoại" required>
        </div>
        <button type="submit" id="submit" class="btn btn-success">Đăng Ký</button>
    </form>
    <p class="mt-4">Quay lại <a href="/login">Đăng Nhập!</a></p>
</div>
@if(session('alert'))
<script>
        alert('Email đã tồn tại!');
</script>
@endif
@if(session('alertPassword'))
<script>
        alert('Mật khẩu nhập lại không đúng!');
</script>
@endif
<script>
    $('input[name="phone"]').on('keyup', function(){
        console.log($('input[name="phone"]').val()[0] == 0);
    });
    var password = $('input[name="password"]').val();
    var password_confirmation = $('input[name="password_confirm"]').val();

        submit.addEventListener('click',function(e) {
            if(checkPhonenumber() == false)
            {
                alert('Số điện thoại phải tối thiểu là 10 chữ số và bắt đầu bằng số 0!');
                e.preventDefault();
            }
            else if(password != password_confirmation)
            {
                alert('Vui lòng nhập lại mật khẩu đúng với mật khẩu đăng ký!');
                e.preventDefault();
            }
        });
       function checkPhonenumber()
        {
            if($('input[name="phone"]').val()[0] == 0 && $('input[name="phone"]').val().length >= 10)
            {
                return true;
            }
            return false;
        }
</script>
@endsection