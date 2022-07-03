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
                            <h3 class="card-title">Thông tin tài khoản</h3>
                        </div>
                        <div class="p-5" style=" height: 480px;">
                            <div style="position: relative;float: left; width:315px;">
                                <img src="{{ asset("/imageUsers") ."/".$user[0]->hinh_anh }}" alt="" width="285" height="285" style="border-radius: 50%; border: solid 2px black">
                            
                            </div>
                            <div  style=" padding-left: 10px;  position: relative">
                                <div style="display: flex; flex-direction: row; justify-content: space-between; align-items: center">
                                    <p>Tên người dùng:</p>
                                    <p class="font-weight-bold" style="font-size: 32px">{{ $user[0]->ho_ten }}</p>
                                </div>
                                <div style="display: flex; flex-direction: row; justify-content: space-between; align-items: center">
                                    <p>Email:</p>
                                    <p>{{ $user[0]->email }}</p>
                                </div>
                                <div style="display: flex; flex-direction: row; justify-content: space-between; align-items: center">
                                    <p>Ngày sinh:</p>
                                    <p>{{ explode(' ', $user[0]->ngay_sinh)[0] }}</p>
                                </div>
                                <div style="display: flex; flex-direction: row; justify-content: space-between; align-items: center">
                                    @php
                                        $hashStr = "*******";
                                        $sdt = $user[0]->sdt;
                                        $hashStrl = $hashStr.mb_substr($sdt, strlen($sdt)-4);
                                    @endphp
                                    <p>Số điện thoại:</p>
                                    <p> {{ $hashStrl}} </p>
                                </div>
                                <div style="display: flex; flex-direction: row; justify-content: space-between; align-items: center">
                                    <p>Địa chỉ giao hàng mặc định:</p>
                                    <p>{{ $user[0]->dia_chi }}</p>
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