@extends('admin/layouts.app')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Chỉnh Sửa Thông Tin Tài Khoản</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('taiKhoan.index') }}">Tài Khoản</a></li>
                            <li class="breadcrumb-item active">Chỉnh Sửa Thông Tin Tài Khoản</li>
                        </ol>
                    </div>
                    <!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">Mẫu Chỉnh Sửa Thông Tin Tài Khoản</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="post" action="{{ route('taiKhoan.update',['taiKhoan'=>$taiKhoan]) }}">
                            @csrf
                            @method('PATCH')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input type="text" class="form-control" name="email" 
                                    value="{{ $taiKhoan->email }}" readonly
                                    placeholder="Email">
                                </div>
                                <div class="form-group">
                                    <label for="">Họ Tên</label>
                                    <input type="text" class="form-control" name="hoten" 
                                    value="{{ $taiKhoan->ho_ten }}"
                                    placeholder="Họ Tên">
                                </div>                           
                                <div class="form-group">
                                    <label for="">Ngày Sinh</label>
                                    <input type="date" class="form-control" name="ngaysinh" 
                                    value="{{ $taiKhoan->ngay_sinh }}"
                                    placeholder="Ngày Sinh">
                                </div>
                                <div class="form-group">
                                    <label for="">Địa Chỉ</label>
                                    <input type="text" class="form-control" name="diachi" 
                                    value="{{ $taiKhoan->dia_chi }}"
                                    placeholder="Địa Chỉ">
                                </div>
                                <div class="form-group">
                                    <label for="">SĐT</label>
                                    <input type="text" class="form-control" name="sdt" 
                                    value="{{ $taiKhoan->sdt }}"
                                    placeholder="SĐT">
                                </div>
                                <div class="form-group">
                                    <label for="">Loại Tài Khoản</label>
                                    <select class="form-control" name="loaitk" >
                                        @foreach ($lstltk as $ltk)
                                            <option value="{{ $ltk->id }}" @if($ltk->id == $taiKhoan->loai_tai_khoan_id) selected @endif>
                                                {{ $ltk->ten_loai_tai_khoan }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Trạng Thái</label>
                                    <select name = "trangthai" class="form-control">
                                        <option value ="{{$taiKhoan->trang_thai}}">
                                        @if($taiKhoan->trang_thai == 1)
                                            Hoạt Động
                                        @else
                                            Ngưng Hoạt Động
                                        @endif
                                        </option>
                                        @if($taiKhoan->trang_thai == 1)
                                            <option value ="0"> Ngưng Hoạt Động </option>
                                        @else
                                            <option value ="1"> Hoạt Động </option>
                                        @endif
                                    </select>
                                </div>   
                                
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary" style="width: 100%">Gửi</button>
                            </div>

                            @if(session('alert'))
                                <section class='alert alert-danger'>{{session('alert')}}</section>
                            @endif

                            @if (count($errors) > 0)
                                <div class="error-message">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </form>
                    </div>
            </div><!-- /.container-fluid -->
        </section>
    </div>
@endsection
