@extends('admin/layouts.app')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Hóa Đơn</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="home">Trang Chủ</a></li>
                            <li class="breadcrumb-item active">Hóa đơn</li>
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
                                <div class="card-tools">
                                    <div class="input-group input-group-sm" style="width: 230px;">
                                        <input type="text" name="table_search" class="form-control float-right" id="search" name="search"
                                            placeholder="Tìm kiếm theo mã hóa đơn">
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
                                            <th>STT</th>
                                            <th>Mã Hóa Đơn</th>
                                            <th>Người Nhận</th>
                                            <th>Ngày Order</th>
                                            <th>Tình Trạng</th>
                                            <th>Tổng Tiền</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody id="listInvoice">
                                        @php
                                            $stt =0;
                                        @endphp
                                        @foreach ($invoice as $item)
                                        <tr>
                                            <td>{{ ++$stt }}</td>
                                            <td>{{ $item->ma_hoa_don }}</td>
                                            <td>{{ $item->nguoi_nhan_hang }}</td>
                                            <td>{{ $item->created_at }}</td>
                                            <td>@switch($item->trang_thai)
                                                @case(0)
                                                   <p style="color:gray"> Đang xét</p>
                                                    @break
                                                @case(1)
                                                <p style="color:blue"> Đã xét</p>
                                                   
                                                    @break
                                                @case(2)
                                                <p style="color:lime">  Đang vận chuyển</p>
                                                   
                                                    @break
                                                @case(3)
                                                <p style="color:green">Đã giao</p>
                                                    @break
                                                @default
                                                <p style="color:red">Đã hủy</p>
                                                   
                                            @endswitch</td>
                                            <td>{{ number_format($item->tong_tien,0,',','.') }}</td>
                                            <td><a href="{{ route('invoice.edit',['id'=>$item->id]) }}"  class="btn btn-block btn-default btn-sm">Duyệt</a></td>
                                        </tr>
                                        @endforeach
                                       
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
    <script>
        $(document).on('keyup','#search',function(){
            var key = $(this).val();
            $.ajax({
                url: '{{ URL::to('searchInvoice') }}',
                type: 'get',
                data:{
                    keyword: key
                },
                success: function(response)
                {
                    document.getElementById('listInvoice').innerHTML = response;
                    console.log(response);
                }
            });

        });
    </script>
    @endsection
