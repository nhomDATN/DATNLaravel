@extends('layouts.info_layout')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Thông tin tài khoản</h1>
                    <!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid" >
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">Lịch sử đặt hàng</h3>
                        </div>
                        <div class="p-2" style=" height: 480px; overflow-y: scroll;">
                            
                            @if(count($invoice)==0)
                            <div style="display: flex; flex-direction: column; align-items: center">
                                <img src="{{ asset("/images/empty.png") }}" alt="empty" height="400">
                                <p class="font-weight-bold" style="font-size: 32px">Chưa có lịch sử đặt hàng nào</p>
                            </div>
                            @else
                            
                            {{--  --}}

                            <table class="table table-head-fixed text-nowrap">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Mã Hóa Đơn</th>
                                        <th>Người Nhận</th>
                                        <th>Ngày đặt</th>
                                        <th>Tình Trạng</th>
                                        <th>Thành Tiền</th>
                                        <th>Cổng thanh toán</th>
                                        <th>&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody id="listInvoice">
                                    @php
                                        $stt = 0;
                                    @endphp
                                    @foreach ($invoice as $item)
                                    <tr>
                                        <td>{{ ++$stt }}</td>
                                        <td>{{ $item->ma_hoa_don }}</td>
                                        <td>{{ $item->nguoi_nhan_hang }}</td>
                                        <td>{{ explode(' ',$item->created_at)[0] }}</td>
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
                                        <td>{{ number_format($item->tong_tien,0,',','.').' VNĐ' }}</td>
                                        <td>{{ $item->phuong_thuc_thanh_toan}}</td>
                                        <td><a class="btn btn-primary" href="{{ route('user.info.history_order_detail',['id'=>$item->id,'dh'=>$item->ma_hoa_don]) }}">Xem</a>
                                        @if ($item->trang_thai == 0)
                                            <a class="btn btn-danger" onclick="formModal({{ $item->id }},'{{ $item->ma_hoa_don }}')"><i class="fa fa-trash"></i></a>
                                        @endif
                                        </td>
                                   </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @endif
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                    </div>
                   
            </div><!-- /.container-fluid  href="{{ route('cancelInvoice',['id'=>$item->ma_hoa_don]) }}" -->
         </section> 
    </div>
    <div class="modal" id="modal-cancelInvoice">
        <div class="form-comment" style="height: 155px">
            <div class="form-header" style="height: 15px">
                <p>Hủy đơn</p>
                <span id="close">X</span>
            </div>
            <hr>
            <div class="form-body"  style="height: 50px">
                <div class="get-star" id="form-content">
                   <p> Bạn có chắc là muốn hủy đơn hàng <span id="DH" class="font-weight-bold">DH036137137</span></p> 
                </div>
            </div>
            <div class="form-footer">
                <form action="{{ route('cancelInvoice') }}" method="post">
                    @csrf
                    <input type="hidden" name="id" value="">
                    <a class=" btn btn-default" id="close-btn"> Không </a>
                <button type="submit">Có</button>
            </form>
            </div>
        </div>
        </div>
    <script>
        function formModal(idDH,DHcode)
        {
            $('input[name="id"]').val(idDH);
            $('#modal-cancelInvoice').css('display', 'flex');
            $('#DH').html(DHcode);
            $('#close').click(function(){
                $('#modal-cancelInvoice').css('display', 'none');
            });
            $('#close-btn').click(function(){
                $('#modal-cancelInvoice').css('display', 'none');
            });
        }
    </script>
@endsection