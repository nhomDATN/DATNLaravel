@extends('layouts.app')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Order</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="home">Home</a></li>
                        <li class="breadcrumb-item active">Order</li>
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
                            <h3 class="card-title">Order Management</h3>
                            <div class="card-tools">
                                <div class="input-group input-group-sm" style="width: 180px;">
                                    <input type="text" name="table_search" class="form-control float-right" id="search" name="search"
                                        placeholder="Search by UserEmail">

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
                                        <th>Consignee's Name</th>
                                        <th>ShippingAddress</th>
                                        <th>ShippingPhone</th>
                                        <th>Note</th>
                                        <th>UserEmail</th>
                                        <th>StaffEmail</th>
                                        <th>Status</th>
                                        <th>Created At</th>
                                        <th>Updated At</th>
                                        <th>Detail</th>
                                        <th>Edit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($lstdh) > 0)
                                    @foreach ($lstdh as $dh)
                                    <tr>
                                        <td>{{ $dh->id }}</td>
                                        <td>{{ $dh->ten_nguoi_nhan }}</td>
                                        <td>{{ $dh->dia_chi_nguoi_nhan }}</td>
                                        <td>{{ $dh->sdt_nguoi_nhan }}</td>
                                        <td>{{ $dh->ghi_chu }}</td>
                                        <td>{{ $dh->khachemail }}</td>
                                        <td>{{ $dh->nvemail }}</td>
                                        <td>
                                        @switch($dh->trang_thai)
                                            @case(-1)
                                                Cart
                                                @break
                                            @case(0)
                                                Processing
                                                @break
                                            @case(1)
                                                Processed
                                                @break
                                            @case(2)
                                                Delivering
                                                @break
                                            @case(3)
                                                Delivered
                                                @break
                                            @default
                                                Canceled
                                        @endswitch
                                        </td>
                                        <td>{{ $dh->created_at }}</td>
                                        <td>{{ $dh->updated_at }}</td>
                                        <td style="width: 20px">
                                            <a href='{{ route('donHang.show', ['donHang'=> $dh]) }}'>
                                                <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i
                                                        class="fas fa-info-circle"></i>
                                                </button>
                                            </a>
                                        </td>
                                        @if ($dh->trang_thai!=4 && $dh->trang_thai!=3 && $dh->trang_thai!=-1)
                                        <td style="width: 20px">
                                            <a href='{{ route('donHang.edit', ['donHang'=> $dh]) }}'>
                                                <button style="background-color: #28a745" type="button" class="btn btn-default btn-sm checkbox-toggle"><i
                                                        class="fas fa-edit"></i>
                                                </button>
                                            </a>
                                        </td>
                                        @else
                                        <td style="width: 20px">
                                            <a href='#'>
                                                <button style="background-color:#cbc7c7" type="button" class="btn btn-default btn-sm checkbox-toggle"><i
                                                        class="fas fa-edit"></i>
                                                </button>
                                            </a>
                                        </td>
                                        @endif

                                    </tr>
                                    @endforeach
                                    @else
                                    <tr>
                                        <td colspan="100" class="text-center" style="font-style: italic;font-weight: bold;color: #4f5962;">No Order Found</td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
</div>
<script type="text/javascript">
$('#search').on('keyup',function(){
            $value = $(this).val();
    $.ajax({
        type: 'get',
        url: '{{ URL::to('searchDonHang') }}',
        data: {
            'search': $value
        },
        success:function(data){
            $('tbody').html(data);
        }
    });
        $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
})
    </script>
@endsection