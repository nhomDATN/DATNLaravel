@extends('admin/layouts.app')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Chỉnh Sửa Khuyến Mãi</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('khuyenMai.index') }}">Khuyến Mãi</a></li>
                            <li class="breadcrumb-item active">Chỉnh Sửa Khuyến Mãi</li>
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
                            <h3 class="card-title">Mẫu Chỉnh Sửa Khuyến Mãi</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="post" action="{{ route('khuyenMai.update',['khuyenMai'=>$khuyenMai]) }}">
                            @csrf
                            @method('PATCH')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="">Mã Khuyến Mãi</label>
                                    <input type="text" class="form-control" name="makhuyenmai"
                                    placeholder="Mã Khuyến Mãi" value="{{ $khuyenMai->ma_khuyen_mai }}">
                                </div>
                            
                                <div class="form-group">
                                    <label for="">Tên Loại Khuyến Mãi</label>
                                    <select class="form-control" name="loaikhuyenmai" >
                                        @foreach ($lstlkm as $lkm)
                                            <option value="{{ $lkm->id }}" @if($lkm->id == $khuyenMai->loai_khuyen_mai_id) selected @endif>
                                                {{ $lkm->ten_loai_khuyen_mai }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="">Ngày Bắt Đầu</label>
                                    <input type="datetime" class="form-control" name="ngaybatdau" 
                                        placeholder="Ngày Bắt Đầu" value="{{ $khuyenMai->ngay_bat_dau }}">
                                </div>

                                <div class="form-group">
                                    <label for="">Ngày Kết Thúc</label>
                                    <input type="datetime" class="form-control" name="ngayketthuc" 
                                        placeholder="Ngày Kết Thúc" value="{{ $khuyenMai->ngay_ket_thuc }}">
                                </div>

                                <div class="form-group">
                                    <label for="">Giá Trị</label>
                                    <input type="number" class="form-control" name="giatri"
                                    placeholder="Giá Trị" value="{{ $khuyenMai ->gia_tri }}">
                                </div>

                                <div class="form-group">
                                    <label for="">Giảm Tối Đa</label>
                                    <input type="number" class="form-control" name="maximum"
                                    placeholder="Giảm Tối Đa" value="{{ $khuyenMai->maximum }}">
                                </div>

                                <div class="form-group">
                                    <label for="">Trạng Thái</label>
                                    <select name = "trangthai" class="form-control">
                                        <option value ="{{$khuyenMai->trang_thai}}">
                                        @if($khuyenMai->trang_thai == 1)
                                            Hoạt Động
                                        @else
                                            Ngưng Hoạt Động
                                        @endif
                                        </option>
                                        @if($khuyenMai->trang_thai == 1)
                                            <option value ="0"> Ngưng Hoạt Động </option>
                                        @else
                                            <option value ="1"> Hoạt Động </option>
                                        @endif
                                    </select>
                                </div>   
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary" style="width: 100%">Submit</button>
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
