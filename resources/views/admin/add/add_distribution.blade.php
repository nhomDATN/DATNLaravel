@extends('admin/layouts.app')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Thêm Phân Phối</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('phanPhoi.index') }}">Phân Phối</a></li>
                            <li class="breadcrumb-item active">Thêm Phân Phối</li>
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
                            <h3 class="card-title">Mẫu Thêm Phân Phối</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="post" action="{{ route('phanPhoi.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="">Nơi Phân Phối</label>
                                    <select class="form-control" name="noiphanphoi">
                                        @foreach ($lstnlv as $nlv)
                                            <option value="{{ $nlv->id }}">
                                                {{ $nlv->ma_noi_lam_viec }}
                                            </option>
                                        @endforeach
                                      </select>
                                </div>
                                
                                <div class="form-group">
                                    <label for="">Tên Nguyên Liệu</label>
                                    <select class="form-control" name="tennguyenlieu">
                                        @foreach ($lstnguyenlieu as $nguyenlieu)
                                            <option value="{{ $nguyenlieu->id }}">
                                                {{ $nguyenlieu->ten_nguyen_lieu }}
                                            </option>
                                        @endforeach
                                      </select>
                                </div>

                                <div class="form-group">
                                    <label for="">Đơn vị tính</label>
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
                                            <option value="{{ $kho->id }}">
                                                {{ $kho->ma_noi_lam_viec }}
                                            </option>
                                        @endforeach
                                      </select>
                                </div>

                                <div class="form-group">
                                    <label for="">Số Lượng</label>
                                    <input type="text" class="form-control" name="soluong"
                                        placeholder="Số Lượng">
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
