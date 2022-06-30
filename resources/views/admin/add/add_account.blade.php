@extends('admin/layouts.app')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Thêm Tài Khoản</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('taiKhoan.index') }}">Tài Khoản</a></li>
                            <li class="breadcrumb-item active">Thêm Tài Khoản</li>
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
                            <h3 class="card-title">Mẫu Thêm Tài Khoản</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="post" action="{{ route('taiKhoan.store') }}">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input type="text" class="form-control" name="email"
                                        placeholder="Email">
                                </div>
                                <div class="form-group">
                                    <label for="">Password</label>
                                    <input type="password" class="form-control" name="password"
                                        placeholder="Password">
                                </div>
                                <div class="form-group">
                                    <label for="">Họ Tên</label>
                                    <input type="text" class="form-control" name="hoten"
                                        placeholder="Fullname">
                                </div>                           
                                <div class="form-group">
                                    <label for="">Ngày Sinh</label>
                                    <input type="date" class="form-control" name="ngaysinh"
                                        placeholder="Birthday">
                                </div>
                                <div class="form-group">
                                    <label for="">Địa Chỉ</label>
                                    <input type="text" class="form-control" name="diachi"
                                        placeholder="Address">
                                </div>
                                <div class="form-group">
                                    <label for="">SĐT</label>
                                    <input type="text" class="form-control" name="sdt"
                                        placeholder="Phone">
                                </div>
                                <div class="form-group">
                                    <label for="">Loại Tài Khoản</label>
                                    <select class="form-control" name="loaitk">
                                        @foreach ($lstltk as $ltk)
                                            @if($ltk->trang_thai != 0)
                                                <option value="{{ $ltk->id }}" >
                                                    {{ $ltk->ten_loai_tai_khoan }}
                                                </option>
                                            @endif
                                        @endforeach
                                      </select>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            @if(session('alert'))
                                <section class='alert alert-danger'>{{session('alert')}}</section>
                            @endif
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary" style="width: 100%">Gửi</button>
                            </div>
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
