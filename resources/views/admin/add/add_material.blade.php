@extends('admin/layouts.app')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Thêm Nguyên Liệu</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('nguyenLieu.index') }}">Nguyên Liệu</a></li>
                            <li class="breadcrumb-item active">Thêm Nguyên Liệu</li>
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
                            <h3 class="card-title">Mẫu Thêm Nguyên Liệu</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="post" action="{{ route('nguyenLieu.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="">Tên Nguyên Liệu</label>
                                    <input type="text" class="form-control" name="tennguyenlieu"
                                        placeholder="Tên Nguyên Liệu">
                                </div>                           
                                <div class="form-group">
                                    <label for="">Đơn Giá</label>
                                    <input type="text" class="form-control" name="dongia"
                                        placeholder="Đơn Giá">
                                </div>
                                <div class="form-group">
                                    <label for="">Số Lượng</label>
                                    <input type="text" class="form-control" name="soluong"
                                        placeholder="Số Lượng">
                                </div>
                                <div class="form-group">
                                    <label for="">Đơn Vị Tính</label>
                                    <select class="form-control" name="donvitinh">
                                        @foreach ($lstdvt as $dvt)
                                            <option value="{{ $dvt->id }}">
                                                {{ $dvt->ten_don_vi_tinh }}
                                            </option>
                                        @endforeach
                                      </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Kho</label>
                                    <select class="form-control" name="kho">
                                        @foreach ($lstkho as $kho)
                                            <option value="{{ $dvt->id }}">
                                                {{ $kho->ma_noi_lam_viec }}
                                            </option>
                                        @endforeach
                                      </select>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary" style="width: 100%">Submit</button>
                            </div>
                        </form>
                    </div>
            </div><!-- /.container-fluid -->
        </section>
    </div>
@endsection
