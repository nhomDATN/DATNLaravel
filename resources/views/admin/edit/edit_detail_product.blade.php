@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Edit Detail Product</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('chiTietSanPham.index',['sanPham'=>$chiTietSanPham->san_pham_id ]) }}">Detail Product</a></li>
                            <li class="breadcrumb-item active">Edit Detail Product</li>
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
                            <h3 class="card-title">Form Edit Detail Product</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="post" action="{{ route('chiTietSanPham.update',['chiTietSanPham'=>$chiTietSanPham]) }}">
                            @csrf
                            @method('PATCH')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="">ID</label>
                                    <input type="id" class="form-control"
                                        value="{{ $chiTietSanPham->id }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="">ID Product</label>
                                    <input type="id" class="form-control"  name="idproduct"
                                        value="{{ $chiTietSanPham->san_pham_id }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="">Colors</label>
                                    <select class="form-control" name="mau">
                                        @foreach ($lstmau as $mau)
                                            <option value="{{ $mau->id }}" @if($mau->id == $chiTietSanPham->mau_id) selected @endif>
                                                {{ $mau->ten_mau }}
                                            </option>
                                        @endforeach
                                      </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Sizes</label>
                                    <select class="form-control" name="size">
                                        @foreach ($lstsize as $size)
                                            <option value="{{ $size->id }}" @if($size->id == $chiTietSanPham->size_id) selected @endif>
                                                {{ $size->ten_size }}
                                            </option>
                                        @endforeach
                                      </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Quantity</label>
                                    <input type="number" class="form-control" name="soluong" min="0" value="{{ $chiTietSanPham->so_luong }}">
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
