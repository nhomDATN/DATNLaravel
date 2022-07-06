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
                            <h3 class="card-title">Cập nhật tài khoản</h3>
                        </div>
                        <div class="p-2" style=" height: 480px; overflow-y: scroll;">
                            <form method="post" action="{{ route('updateInfo') }}" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" value="{{ $user[0]->id }}" name="id" />
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="InputFile">Chọn ảnh đại diện (nếu muốn đổi):</label>
                                        <div class="custom-file">
                                          <input type="file" class="custom-file-input" id="customFile" name="file" accept="image/*" >
                                          <label class="custom-file-label" for="customFile">Chọn ảnh</label>
                                        </div>
                                      </div>
                                    <div class="form-group">
                                        <label for="">Họ tên:</label>
                                        <input type="id" class="form-control" name="ho_ten"
                                        placeholder="Nhập Họ Tên" value="{{ $user[0]->ho_ten }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Số điện thoại:</label>
                                        <input type="text" class="form-control" name="sdt_new"
                                        placeholder="Nhập số điện thoại mới" value="{{ $user[0]->sdt}}" required>
                                        <span class=" d-none" id="errorSDTNew" style="color:red;"> Số điện thoại phải có tối thiểu 10 số</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Địa chỉ giao hàng:</label>
                                        <input type="" class="form-control" name="dia_chi"
                                        placeholder="Nhập địa chỉ giao hàng" value="{{ $user[0]->dia_chi }}" required>
                                    </div>
                                    
                                </div>
                                <!-- /.card-body -->
    
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" id="submit" class="btn btn-primary" style="width: 100%">Đổi</button>
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
        <script>
            $('input[name="sdt_new"]').on('keyup',function(){
                if($(this).val().length < 10 || $(this).val()[0] != 0)
                {
                    $('#errorSDTOld').html('Số điện thoại phải bắt đầu bằng số 0 và không thể < 10 chữ số ');
                    $('#errorSDTNew').removeClass('d-none');
                    $('#submit').addClass('disabled')
                }
                else
                {
                    $('#submit').removeClass('disabled')
                    $('#errorSDTNew').addClass('d-none');
                }
            });
            submit.addEventListener('click', function(e){
                if( $('#submit').hasClass('disabled'))
                {
                    e.preventDefault();
                }
            });
        </script>
    </div>
@endsection