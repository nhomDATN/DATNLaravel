@extends('layouts.info_layout')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Thông tin tài khoản</h1>
                    <!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid" >
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">Đổi mật khẩu</h3>
                        </div>
                        <div class="p-5" style=" height: 480px;">
                            <form method="post" action="{{ route('replacePassword') }}">
                                @csrf
                                <input type="hidden" name="id" value="{{ $id }}">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="">Số điện thoại</label>
                                        <input type="text" class="form-control" name="sdt"
                                        placeholder="Nhập số điện thoại" value="" required>
                                        <span id="errorSDT" class="text-danger"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Mật khẩu mới</label>
                                        <input type="password" class="form-control" name="password"
                                        placeholder="Nhập mật khẩu mới" value="" required>
                                        <span id="errorPW" class="text-danger"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Nhập lại mật khẩu mới</label>
                                        <input type="password" class="form-control" name="confirm_password"
                                       placeholder="Nhập lại mật khẩu mới" value="" required>
                                       <span id="errorCPW" class="text-danger"></span>
                                    </div> 
                                </div>
                                <!-- /.card-body -->
    
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" id="submit" class="btn btn-primary disabled" style="width: 100%">Đổi</button>
                                </div>
    
                                @if(session('alert'))
                                    <section class='alert alert-danger'>{{session('alert')}}</section>
                                @endif
                            </form>
                            
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                    </div>
                   
            </div><!-- /.container-fluid -->
        </section>
    </div>
    <script>
        var flag = 0;
        var flag1 = 0;
        var flag2 = 0;
      $('input[name="sdt"]').on('keyup', function(){
        if($(this).val().length > 9 && $(this).val()[0] == 0)
        {
            flag = 1;
            $('#errorSDT').html('');
        }
        else{
            $('#submit').addClass('disabled');
            flag = 0;
            $('#errorSDT').html('Số điện thoại phải bắt đầu bằng số 0 và phải < 10 chữ số');
        }
        if( flag ==  1 && flag1 ==  1 && flag2 == 1)
        {
            enable();
        }
      });
      $('input[name="password"]').on('keyup', function(){
        if($(this).val().length > 5)
        {
            flag1 = 1;
            $('#errorPW').html('');
        }
        else{
            $('#submit').addClass('disabled');
            flag1 = 0;
            $('#errorPW').html('Mật khẩu phải có tối thiểu 6 ký tự');
        }
        if( flag == 1 && flag1 == 1 && flag2 == 1)
        {
            enable();
        }
      });
      $('input[name="confirm_password"]').on('keyup', function(){
        if($(this).val().length > 5)
        {
            flag2 = 1;
            $('#errorCPW').html('');
        }
        else{
            flag2 = 0;
            $('#submit').addClass('disabled');
            $('#errorCPW').html('Mật khẩu phải có tối thiểu 6 ký tự');
        }
        if( flag == 1 && flag1 == 1 && flag2 == 1)
        {
            enable();
        }
      });
         submit.addEventListener('click', function(e){
                if( $('#submit').hasClass('disabled'))
                {
                    e.preventDefault();
                }
            });
            function enable()
            {
                $('#submit').removeClass('disabled');
            }
    </script>
@endsection