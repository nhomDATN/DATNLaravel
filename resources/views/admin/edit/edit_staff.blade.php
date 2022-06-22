@extends('admin/layouts.app')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Chỉnh Sửa Thông Tin Nhân Viên</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('nhanVien.index') }}">Nhân Viên</a></li>
                            <li class="breadcrumb-item active">Chỉnh Sửa Thông Tin Nhân Viên</li>
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
                            <h3 class="card-title">Mẫu Chỉnh Sửa Thông Tin Nhân Viên</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="post" action="{{ route('nhanVien.update',['nhanVien'=>$nhanVien]) }}">
                            @csrf
                            @method('PATCH')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="">Tên Nhân Viên</label>
                                    <input type="text" class="form-control" name="tennhanvien"
                                    placeholder="Tên Nhân Viên" value="{{ $nhanVien->ten_nhan_vien }}">
                                </div>

                                <div class="form-group">
                                    <label for="">Địa Chỉ</label>
                                    <input type="text" class="form-control" name="diachi"
                                    placeholder="Địa Chỉ" value="{{ $nhanVien->dia_chi }}">
                                </div>

                                <div class="form-group">
                                    <label for="">Ngày Sinh</label>
                                    <input type="datetime" class="form-control" name="ngaysinh"
                                    placeholder="Ngày Sinh" value="{{ $nhanVien->ngay_sinh }}">
                                </div>

                                <div class="form-group">
                                    <label for="">SĐT</label>
                                    <input type="text" class="form-control" name="sdt"
                                    placeholder="SĐT" value="{{ $nhanVien->sdt }}">
                                </div>

                                <div class="form-group">
                                    <label for="">CCCD</label>
                                    <input type="text" class="form-control" name="CCCD"
                                    placeholder="CCCD" value="{{ $nhanVien->CCCD }}">
                                </div>

                                <div class="form-group">
                                    <label for="">Lương</label>
                                    <input type="text" class="form-control" name="luong"
                                    placeholder="Lương" value="{{ $nhanVien->luong }}">
                                </div>

                                <div class="form-group">
                                    <label for="">Thưởng Tháng</label>
                                    <input type="text" class="form-control" name="thuongthang"
                                    placeholder="Thưởng Tháng" value="{{ $nhanVien->thuong_thang }}">
                                </div>
                            
                                <div class="form-group">
                                    <label for="">Nơi Làm</label>
                                    <select class="form-control" name="noilamviec" >
                                        @foreach ($lstnlv as $nlv)
                                            <option value="{{ $nlv->id }}" @if($nlv->id == $nhanVien->noi_lam_id) selected @endif>
                                                {{ $nlv->ma_noi_lam_viec }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="">Chức Vụ</label>
                                    <select class="form-control" name="chucvu" >
                                        @foreach ($lstcv as $cv)
                                            <option value="{{ $cv->id }}" @if($cv->id == $nhanVien->chuc_vu_id) selected @endif>
                                                {{ $cv->ten_chuc_vu }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="">Trạng Thái</label>
                                    <select name = "trangthai" class="form-control">
                                        <option value ="{{$nhanVien->trang_thai}}">
                                            @if($nhanVien->trang_thai == 1)
                                                Hoạt Động
                                            @else
                                                Ngưng Hoạt Động
                                            @endif
                                        </option>
                                        @if($nhanVien->trang_thai == 1)
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
