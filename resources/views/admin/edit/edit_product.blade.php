@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Edit Product</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('sanPham.index') }}">Product</a></li>
                            <li class="breadcrumb-item active">Edit Product</li>
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
                            <h3 class="card-title">Form Edit Product</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="post" action="{{ route('sanPham.update',['sanPham'=>$sanPham]) }}">
                            @csrf
                            @method('PATCH')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="">ID</label>
                                    <input type="id" class="form-control" name="id"
                                        value="{{ $sanPham ->id }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="">Name</label>
                                    <input type="text" class="form-control" name="tensp"
                                        placeholder="Name Product" value="{{ $sanPham ->ten_san_pham }}">
                                </div>
                                <div class="form-group">
                                    <label for="">Description</label>
                                    <textarea class="form-control" rows="3" placeholder="Enter ..." name="mota">{{ $sanPham ->mo_ta }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="">Price</label>
                                    <input type="number" class="form-control" name="gia"
                                        placeholder="Price Product" value="{{ $sanPham ->gia }}" min="0">
                                </div>
                                {{-- <div class="form-group">
                                    <label for="InputFile">File Picture Input</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="InputFile">
                                            <label class="custom-file-label" for="InputFile">Choose file</label>
                                        </div>
                                        <div class="input-group-append">
                                            <span class="input-group-text">Upload</span>
                                        </div>
                                    </div>
                                </div> --}}
                                <div class="form-group">
                                    <label for="">Product Types</label>
                                    <select class="form-control" name="loaisp">
                                        @foreach ($lstloai as $loai)
                                            <option value="{{ $loai->id }}" @if($loai->id == $sanPham->loai_san_pham_id) selected @endif>
                                                {{ $loai->ten_loai_san_pham }}
                                            </option>
                                        @endforeach
                                      </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Brands</label>
                                    <select class="form-control" name="thuonghieu">
                                        @foreach ($lstthuonghieu as $thuonghieu)
                                        <option value="{{ $thuonghieu->id }}" @if($thuonghieu->id == $sanPham->thuong_hieu_id) selected @endif>
                                            {{ $thuonghieu->ten_thuong_hieu }}
                                        </option>
                                    @endforeach
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
