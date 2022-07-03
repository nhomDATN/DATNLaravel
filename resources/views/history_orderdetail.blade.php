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
                            <h3 class="card-title">Lịch sử đặt hàng / Chiết hóa đơn</h3>
                        </div>
                        <div class="p-2" style=" height: 480px; overflow-y: scroll">
                            <table class="table table-head-fixed text-nowrap">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>&nbsp;</th>
                                        <th>Tên sản phẩm</th>
                                        <th>Số lượng</th>
                                        <th>Đơn giá</th>
                                        <th>Chiết khấu</th>
                                        <th>&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $stt = 0;
                                    @endphp
                                    @foreach ($invoice as $item)
                                    <tr>
                                        <td>{{ ++$stt }}</td>
                                        <td><img src="{{ asset("images/$item->hinh") }}"alt="hinh"></td>
                                        <td>{{ $item->ten_san_pham }}</td>
                                        <td>{{ $item->so_luong }}</td>
                                        <td>{{ number_format($item->gia ,0,',','.') }}</td>
                                        <td>{{ $item->chiet_khau }}%</td>
                                        <td><p class="btn btn-primary" onclick="danhgia({{ $item->id }})">Đánh giá</p></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                           </table>
                            
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                    </div>
                   
            </div><!-- /.container-fluid -->
        </section>
    </div>
    <script>
        function danhgia(id)
        {
            console.log(name);
            $('.modal').css('display','flex');
            $('#close').click(function () {
                $('.modal').css('display','none');
            });
            $('#closeH').click(function () {
                $('.modal').css('display','none');
            });
            $('input[name="id"]').val(id);
            
            $('input[name="star"]').val(5);
        }
        function getStar(star)
            {
                var str = '';
                for (var i = 0; i < 5; i++)
                {
                    if(i < star)
                    {
                        str += `<a><i class=" ion-ios-star" onclick="getStar(${i+1})" style="color: orange; font-size:24px"> </i></a>`;
                    }
                    else
                        str += `<a><i class=" ion-ios-star-outline" onclick="getStar(${i+1})" style="color: orange; font-size:24px"> </i></a>`;  
                }
                $('#list-star').html(str);
                $('input[name="star"]').val(star);
            }
    </script>
@endsection