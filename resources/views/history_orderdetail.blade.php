@extends('layouts.info_layout')
@section('content')
@php
    function hasRate($id,$productID)
    {
        $checkRate = DB::table('danh_gias')
        ->where('san_pham_id',$id)
        ->where('tai_khoan_id',$productID)
        ->where('so_sao','>',0)
        ->get();
        $checkContent = DB::table('binh_luans')
        ->where('san_pham_id',$id)
        ->where('tai_khoan_id',$productID)
        ->get();
        if(count($checkRate) > 0)
            return $Infor =[
                'star' => $checkRate[0]->so_sao,
                'content'=>$checkContent[0]->noi_dung
        ];
        return null;
    }
@endphp
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
                                        <th>Đơn giá</th>
                                        <th>Số lượng</th>
                                        <th>Thành tiền</th>
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
                                        <td>{{ $item->ten_san_pham }}</td>{{-- <p class="btn btn-outline-secondary" onclick="xemlai({{ $item->id }})">Xem lại</p> --}}
                                        <td>{{ number_format($item->gia ,0,',','.') }}</td>
                                        <td>{{ $item->so_luong }}</td>
                                        <td>{{ number_format($item->gia * $item->so_luong,0,',','.') }}</td>
                                        <td>{{ $item->chiet_khau }}%</td>
                                        <td>
                                            @php
                                                $data = hasRate($item->id,Session::get('UserId'));
                                            @endphp
                                            @if($data == null)
                                            <p class="btn btn-primary" onclick="danhgia({{ $item->id }},'{{ $item->ten_san_pham }}')">Đánh giá</p>
                                            @else
                                           
                                                <p class="btn btn-outline-secondary mt-3" onclick="xemlai({{ $item->id }},'{{ $item->ten_san_pham }}',{{ $data['star'] }},'{{ $data['content'] }}')">Xem lại</p>
                                                <a class =" btn btn-danger mt-0"href="{{ route('cancelComment',['id'=>Session::get('UserId'),'productID'=>$item->id]) }}">Xóa</a>
                                            @endif
                                        </td>
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
        function danhgia(id,name)
        {
            //console.log(name);
            $('#name').html(name);
            //comment
            $('#comment').css('display','flex');
            $('#close').click(function () {
                $('#comment').css('display','none');
            });
            $('#closeH').click(function () {
                $('#comment').css('display','none');
            });
            //Resee
            $('#ReSee').click(function () {
                $('#nameReSee').html(name);
                $('#comment').css('display','none');
                $('#reSee').css('display','flex');
                $('#reSee-content').html($('textarea[name="danh_gia"]').val());
                var str = '';
                for (var i = 0; i < 5 ; i++)
                {
                    if(i < $('input[name="star"]').val())
                    {
                        str += `<a><i class=" ion-ios-star"  style="color: orange; font-size:24px"> </i></a>`;
                    }
                    else
                        str += `<a><i class=" ion-ios-star-outline" style="color: orange; font-size:24px"> </i></a>`;
                }
                $('input[name="danh_gia"]').val($('textarea[name="danh_gia"]').val());
                $('#list-starReSee').html(str);
            });
            $('#closeReSeeH').click(function () {
                $('#comment').css('display','flex');
                $('#reSee').css('display','none');
                $('textarea[name="danh_gia"]').val($('input[name="danh_gia"]').val());
                getStar(star);
            });
            $('#closeReSee').click(function () {
                $('#reSee').css('display','none');
            });
            $('input[name="id"]').val(id);
            
            $('input[name="star"]').val(5);
        }
        function xemlai(id,name,star,comment)
        {
            
            $('input[name="id"]').val(id);
            $('input[name="star"]').val(star);
            $('input[name="danh_gia"]').val(comment);
            $('#nameReSee').html(name);
            $('#reSee').css('display','flex');
            $('#reSee-content').html(comment);

            var str = '';
                for (var i = 0; i < 5 ; i++)
                {
                    if(i < star)
                    {
                        str += `<a><i class=" ion-ios-star"  style="color: orange; font-size:24px"> </i></a>`;
                    }
                    else
                        str += `<a><i class=" ion-ios-star-outline" style="color: orange; font-size:24px"> </i></a>`;
                }
            $('#closeReSee').click(function () {
                $('#reSee').css('display','none');
            });
            $('#list-starReSee').html(str);

            $('#closeReSeeH').click(function () {
                $('#comment').css('display','flex');
                $('#reSee').css('display','none');
                $('textarea[name="danh_gia"]').val(comment);
                $('#name').html(name);
                getStar(star);
            });
            $('#ReSee').click(function () {
                $('#nameReSee').html(name);
                $('#comment').css('display','none');
                $('#reSee').css('display','flex');
                $('#reSee-content').html($('textarea[name="danh_gia"]').val());
                var str = '';
                for (var i = 0; i < 5 ; i++)
                {
                    if(i < $('input[name="star"]').val())
                    {
                        str += `<a><i class=" ion-ios-star"  style="color: orange; font-size:24px"> </i></a>`;
                    }
                    else
                        str += `<a><i class=" ion-ios-star-outline" style="color: orange; font-size:24px"> </i></a>`;
                }
                $('input[name="danh_gia"]').val($('textarea[name="danh_gia"]').val());
                $('#list-starReSee').html(str);
            });
            $('#closeReSeeH').click(function () {
                $('#comment').css('display','flex');
                $('#reSee').css('display','none');
                $('textarea[name="danh_gia"]').val(comment)
                getStar(star);
            });
            $('#close').click(function () {
                $('#comment').css('display','none');
            });
            $('#closeH').click(function () {
                $('#comment').css('display','none');
            });
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