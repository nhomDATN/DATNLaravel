@extends('admin.layouts.app')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Chi Tiết Sản Phẩm</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('sanpham.adminShow') }}">Sản phẩm</a></li>
                            <li class="breadcrumb-item active">Chi tiết sản phẩm</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div style="float: right;margin-left:20px;margin-top: -0.3rem;width: 100px;">
                                    <a href="{{ route('sanpham.edit',['id'=>$sanpham[0]->id]) }}">
                                        <button type="button" class="btn btn-block btn-default btn-sm">Sửa</button>
                                    </a>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-2 mt-2" style="height: 480px;">
                                <div class="float-left  w-25 position-relative" style="height: 350px"><img src="{{ asset("images").'/'.$sanpham[0]->hinh }}" class="img-responsivealt w-100" height="350"></div>
                                <div>
                                    <div class="bg bg-dark w-100">
                                            <p style="padding: 12px 0; font-size: 25px">Tên sản phẩm</p>
                                    </div>
                                    <p style="padding: 12px 0; font-size: 30px; color:red">{{ $sanpham[0]->ten_san_pham }}</p>
                                    <div class=" w-100">
                                        <p style="padding: 12px 0; font-size: 25px">===Đơn giá: <span style="padding: 12px 0; font-size: 30px; color:blue">{{ number_format($sanpham[0]->gia,0,',','.'). " VNĐ" }}</span></p>
                                    </div>
                                    <br><br><br>
                                    <br>
                                    <div class=" w-100">
                                        <p style="padding: 12px 0; font-size: 25px;">>>Mô tả:</p>
                                    </div>
                                    <div style="display: flex;height: 150px; overflow: hidden;">
                                        
                                        <p style="padding: 12px 0; font-size: 30px;">{{ explode('.',$sanpham[0]->mo_ta)[0] .'...'  }}</p>
                                    </div>
                                    
                                   <div class=" w-100">
                                        <p style="padding: 12px 0; font-size: 25px; ">>>Khuyến mãi: {{ $sanpham[0]->gia_tri ."%" }}</p>
                                    </div>
                                    <div class=" w-100">
                                        <p style="padding: 12px 0; font-size: 25px">>>Danh sách nguyên liệu:</p>
                                     </div>
                                    <p style="padding: 12px 0; font-size: 30px;">{{ $lstDetailProduct }}</p>
                                     <div class=" w-100 position-relative">
                                        <p style="padding: 12px 0; font-size: 25px">>>Danh sách từ khóa tìm kiếm:</p>
                                    </div>
                                    <p style="padding: 12px 0; font-size: 30px;">{{ $sanpham[0]->tim_kiem }}</p>
                                </div>
                               
                              
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
    </div>
@endsection
