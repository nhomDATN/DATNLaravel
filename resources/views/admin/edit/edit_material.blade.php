@extends('admin/layouts.app')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Chỉnh Sửa Nguyên Liệu</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('nguyenLieu.index') }}">Nguyên Liệu</a></li>
                            <li class="breadcrumb-item active">Chỉnh Sửa Nguyên Liệu</li>
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
                            <h3 class="card-title">Mẫu Chỉnh Sửa Nguyên Liệu</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="post" action="{{ route('nguyenLieu.update',['nguyenLieu'=>$nguyenLieu]) }}">
                            @csrf
                            @method('PATCH')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="">Tên Nguyên Liệu</label>
                                    <input type="id" class="form-control" name="tennguyenlieu"
                                    value="{{ $nguyenLieu->ten_nguyen_lieu }}">
                                </div>
                                <div class="form-group">
                                    <label for="">Đơn Giá</label>
                                    <input type="id" class="form-control" name="dongia"
                                    value="{{ $nguyenLieu->don_gia }}">
                                </div>
                                <div class="form-group">
                                    <label for="">Số Lượng</label>
                                    <input type="id" class="form-control" name="soluong"
                                    value="{{ $nguyenLieu->so_luong }}">
                                </div>
                                <div class="form-group">
                                    <label for="">Đơn Vị Tính</label>
                                    <select class="form-control" name="donvitinh" >
                                        @foreach ($lstdvt as $dvt)
                                            <option value="{{ $dvt->id }}" @if($dvt->id == $nguyenLieu->don_vi_tinh_id) selected @endif>
                                                {{ $dvt->ten_don_vi_tinh }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Kho</label>
                                    <select class="form-control" name="kho" >
                                        @foreach ($lstkho as $kho)
                                            <option value="{{ $kho->id }}" @if($kho->id == $nguyenLieu->kho_id) selected @endif>
                                                {{ $kho->ma_noi_lam_viec }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Trạng Thái</label>
                                    <select name = "trangthai" class="form-control">
                                        <option value ="{{$nguyenLieu->trang_thai}}">
                                        @if($nguyenLieu->trang_thai == 1)
                                            Hoạt Động
                                        @else
                                            Ngưng Hoạt Động
                                        @endif
                                        </option>
                                        @if($nguyenLieu->trang_thai == 1)
                                            <option value ="0"> Ngưng Hoạt Động </option>
                                        @else
                                            <option value ="1"> Hoạt Động </option>
                                        @endif
                                    </select>
                                </div>   
                            </div>
                            <!-- /.card-body -->

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
