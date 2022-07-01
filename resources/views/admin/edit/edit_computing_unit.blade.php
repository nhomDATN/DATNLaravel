@extends('admin/layouts.app')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Chỉnh Sửa Đơn Vị Tính</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('donViTinh.index') }}">Đơn Vị Tính</a></li>
                            <li class="breadcrumb-item active">Chỉnh Sửa Đơn Vị Tính</li>
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
                            <h3 class="card-title">Mẫu Chỉnh Sửa Đơn Vị Tính</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="post" action="{{ route('donViTinh.update',['donViTinh'=>$donViTinh]) }}">
                            @csrf
                            @method('PATCH')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="">Tên Đơn Vị</label>
                                    <input type="id" class="form-control" name="tendonvitinh"
                                    value="{{ $donViTinh->ten_don_vi_tinh }}">
                                </div>
                                
                                <div class="form-group">
                                    <label for="">Trạng Thái</label>
                                    <select name = "trangthai" class="form-control">
                                        <option value ="{{$donViTinh->trang_thai}}">
                                        @if($donViTinh->trang_thai == 1)
                                            Hoạt Động
                                        @else
                                            Ngưng Hoạt Động
                                        @endif
                                        </option>
                                        @if($donViTinh->trang_thai == 1)
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
