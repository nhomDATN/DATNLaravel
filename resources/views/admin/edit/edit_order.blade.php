@extends('admin.layouts.app')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Duyệt hóa đơn</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="">Hóa đơn</a></li>
                        <li class="breadcrumb-item active">Duyệt hóa đơn</li>
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
                    <h3 class="card-title">Duyệt hóa đơn</h3>
                </div>
                <div class="p-2">
                    <h4>Mã hóa đơn: <span class=" font-weight-bold">{{ $invoice[0]->ma_hoa_don }}</span></h4>
                    <div style="float: right; width: 100px;"> 
                        <a href="{{ route('bill.pdf',['id' => $invoice[0]->id]) }}" class="btn btn-block btn-default btn-sm">In Hóa Đơn</a>
                    </div>
                    <p>Tình trạng: </p>
                    <form action="{{ route('invoice.update')}}" class="w-50" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{ $invoice[0]->id }}" />
                    <select name="status">
                        <option value="{{ $invoice[0]->trang_thai }}">@switch($invoice[0]->trang_thai)
                            @case(0)
                                Đang xét
                                @break
                            @case(1)
                                Đã xét
                                @break
                            @case(2)
                                Đang vận chuyển
                                @break
                            @case(3)
                                Đã giao
                                @break
                            @default
                                Đã hủy
                        @endswitch</option>
                        @for ($i = $invoice[0]->trang_thai + 1; $i < 5; $i++)
                        <option value="{{ $i }}">@switch($i)
                            @case(0)
                                Đang xét
                                @break
                            @case(1)
                                Đã xét
                                @break
                            @case(2)
                                Đang vận chuyển
                                @break
                            @case(3)
                                Đã giao
                                @break
                            @default
                                Đã hủy
                        @endswitch</option>
                        @endfor
                    </select>
                    <div style="float: right; width: 100px;"> 
                            <button type="submit" class="btn btn-block btn-primary btn-sm">Duyệt</button>
                    </div>
                </form>
                <div class=" pt-3">
                    <h4>Chi tiết đơn hàng:</h4>
                    <p class="">Phí vận chuyển: <span >@if ($invoice[0]->tong_tien >= 500000)
                        0 VNĐ
                    @else
                    25.000 VNĐ
                    @endif</span></p>
                    <p class="">Tiền thanh toán: <span style="color: red;">{{ number_format($invoice[0]->tong_tien,0,',','.') }} VNĐ</span></p>
                    <div class="card-body table-responsive p-0" style="height: 300px;">
                       <table class="table table-head-fixed text-nowrap">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>&nbsp;</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Đơn giá</th>
                                    <th>Số lượng</th>
                                    <th>Thành tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $stt = 0;
                                @endphp
                                @foreach ($invoice_detail as $item)
                                
                                <tr>
                                    <td>{{ ++$stt }}</td>
                                    <td><img src="{{ asset("images/$item->hinh") }}"alt=""></td>
                                    <td>{{ $item->ten_san_pham }}</td>
                                    <td>{{ number_format($item->gia,0,',','.') }}VNĐ</td>
                                    <td>{{ $item->so_luong }}</td>
                                    <td>{{ number_format($item->gia * $item->so_luong,0,',','.') }} VNĐ</td>
                                </tr>
                                @endforeach
                               
                            </tbody>
                       </table>
                    </div>
                    
                </div>
                   
                </div>
                <!-- /.card-header -->
                <!-- form start -->
            </div>
        </div><!-- /.container-fluid -->
    </section>
</div>
@endsection