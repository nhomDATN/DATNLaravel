@extends('admin/layouts.app')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Chỉnh Sửa Nơi Làm Việc</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('noiLamViec.index') }}">Nơi Làm Việc</a></li>
                            <li class="breadcrumb-item active">Chỉnh Sửa Nơi Làm Việc</li>
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
                            <h3 class="card-title">Mẫu Chỉnh Sửa Nơi Làm Việc</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="post" action="{{ route('noiLamViec.update',['noiLamViec'=>$noiLamViec]) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="">Mã Nơi Làm Việc</label>
                                    <input type="id" class="form-control" name="manoilamviec"
                                        placeholder="Mã Nơi Làm Việc" value="{{ $noiLamViec->ma_noi_lam_viec }}">
                                </div>
                         
                            
                                <div class="form-group">
                                    <label for="">Địa Chỉ</label>
                                    <input type="id" class="form-control" name="diachi"
                                        placeholder="Địa Chỉ" value="{{ $noiLamViec->dia_chi }}">
                                </div>
                        
                            
                                <div class="form-group">
                                    <label for="">Trạng Thái</label>
                                    <select name = "trangthai" class="form-control">
                                        <option value ="{{$noiLamViec->trang_thai}}">
                                        @if($noiLamViec->trang_thai == 1)
                                            Hoạt Động
                                        @else
                                            Ngưng Hoạt Động
                                        @endif
                                        </option>
                                        @if($noiLamViec->trang_thai == 1)
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
