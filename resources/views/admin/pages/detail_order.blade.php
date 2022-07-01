@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Detail Order</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('donHang.index') }}">Order</a></li>
                            <li class="breadcrumb-item active">Detail Order</li>
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
                                <h3 class="card-title">Detail Order Management</h3>
                                <div class="card-tools">
                                    <div class="input-group input-group-sm" style="width: 200px;">
                                        <input type="text" name="table_search" class="form-control float-right" id="search"
                                            name="search" placeholder="Search by Product Name">

                                        <div class="input-group-append">

                                            <button type="submit" class="btn btn-default">
                                                <i class="fas fa-search"></i>
                                            </button>

                                        </div>
                                    </div>
                                </div>

                            </div>                         
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0" style="height: 480px;">
                                <table class="table table-head-fixed text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Order ID</th>
                                            <th>ProductName</th>
                                            <th>Color</th>
                                            <th>Size</th>
                                            <th>Quantity</th>
                                            <th>Price</th>
                                            <th>Review Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                        @if (count($lstctdh) > 0)                                      
                                        @foreach ($lstctdh as $ctdh)
                                        <tr>
                                            <td>{{ $ctdh->id }}</td>
                                            <td>{{ $ctdh->don_hang_id }}</td>
                                            <td>{{ $ctdh->ten_san_pham }}</td>
                                            <td>{{ $ctdh->ten_mau }}</td>
                                            <td>{{ $ctdh->ten_size }}</td>
                                            <td>{{ $ctdh->so_luong }}</td>
                                            <td>{{ $ctdh->gia }}</td>
                                            @if($ctdh->trang_thai_danh_gia == 1)
                                                <td>Reviewed</td>
                                                @else
                                                <td>Not Yet Review</td>   
                                                @endif
                                        </tr>
                                        @endforeach
                                        @else
                                        <tr>
                                            <td colspan="100" class="text-center"
                                                style="font-style: italic;font-weight: bold;color: #4f5962;">No Detail Order
                                                Found</td>
                                        </tr>
                                    @endif
                                    </tbody>
                                </table>
                                
                            </div>
                            <h4 style="margin-left:10px">Total price: <b>$ {{ $tongtien }}</b></h4>
                            <h4 style="margin-left:10px">Total quantity: <b>{{ $tongsoluong }}</b></h4>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
    </div>
    @endsection
