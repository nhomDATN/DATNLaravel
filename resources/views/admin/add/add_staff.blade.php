@extends('admin/layouts.app')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Thêm Nhân Viên</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href=" {{ route('nhanVien.index') }}">Nhân Viên</a></li>
                            <li class="breadcrumb-item active">Thêm Nhân Viên</li>
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
                            <h3 class="card-title">Mẫu Thêm Nhân Viên</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="post" action="{{ route('nhanVien.store') }}">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="">Tên Nhân Viên</label>
                                    <input type="text" class="form-control" name="tennhanvien"
                                    placeholder="Tên Nhân Viên">
                                </div>

                                <div class="form-group">
                                    <label for="">Địa Chỉ</label>
                                    <input type="text" class="form-control" name="diachi"
                                    placeholder="Địa Chỉ" >
                                </div>

                                <div class="form-group">
                                    <label for="">Ngày Sinh</label>
                                    <input type="datetime" class="form-control" name="ngaysinh"
                                    placeholder="Ngày Sinh">
                                </div>

                                <div class="form-group">
                                    <label for="">SĐT</label>
                                    <input type="text" class="form-control" name="sdt"
                                    placeholder="SĐT">
                                </div>

                                <div class="form-group">
                                    <label for="">CCCD</label>
                                    <input type="text" class="form-control" name="CCCD"
                                    placeholder="CCCD">
                                </div>

                                <div class="form-group">
                                    <label for="">Lương</label>
                                    <input type="text" class="form-control" name="luong"
                                    placeholder="Lương">
                                </div>

                                <div class="form-group">
                                    <label for="">Thưởng Tháng</label>
                                    <input type="text" class="form-control" name="thuongthang"
                                    placeholder="Thưởng Tháng">
                                </div>
                            
                                <div class="form-group">
                                    <label for="">Nơi Làm</label>
                                    <select class="form-control" name="noilamviec" >
                                        @foreach ($lstnlv as $nlv)
                                            <option value="{{ $nlv->id }}">
                                                {{ $nlv->ma_noi_lam_viec }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="">Chức Vụ</label>
                                    <select class="form-control" name="chucvu">
                                        @foreach ($lstcv as $cv)
                                            <option value="{{ $cv->id }}">
                                                {{ $cv->ten_chuc_vu }}
                                            </option>
                                        @endforeach
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
