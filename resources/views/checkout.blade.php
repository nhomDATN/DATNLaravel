@extends('layouts.layout')
@section('content')
@php 
    Session::put('dem', 0);
@endphp
<div class="hero-wrap hero-bread" style="background-image: url('images/banner-1.jpg');">
</div>

<section class="ftco-section">
    <div class="container">
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center">
                <div class="col-md-8 ftco-animate text-center">
                    <div style="background-color: rgba(212, 243, 212, 0.5);">
                        <h1 class="mb-0 bread" style="font-size: 35px; color: rgb(87, 247, 93)">Thanh Toán</h1>
                    </div>
                </div>
            </div>
        </div>
    </br>
            <div class="col-xl-7 ftco-animate">
                @foreach ($tttk as $tk)
                <form action="#" class="billing-form">
                    <h3 class="mb-4 billing-heading" style="color: red;">CHI TIẾT HÓA ĐƠN</h3>
                    <div style="color: red; font-size: 18px">THÔNG TIN NGƯỜI NHẬN HÀNG</div>
                    <div class="row align-items-end">
                        
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="firstname" style="color: green; font-size: 18px">Họ tên</label>
                                <input type="text" class="form-control" placeholder="Họ tên" value="@php echo $tk->ho_ten  @endphp" style="color: black !important; font-size: 16px">
                            </div>
                        </div>
                        {{-- <div class="col-md-6">
                            <div class="form-group">
                                <label for="lastname">Tên</label>
                                <input type="text" class="form-control" placeholder="">
                            </div>
                        </div> --}}
                        @php
                            $dia_chi = explode(",",$tk->dia_chi);
                        @endphp
                        <div class="w-100"></div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="country" style="color: green; font-size: 18px">Quận</label>
                                <input type="text" class="form-control" placeholder="Quận" value="@php echo $dia_chi[1]  @endphp" style="color: black !important; font-size: 16px">
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="streetaddress" style="color: green; font-size: 18px">Địa chỉ</label>
                                <input type="text" class="form-control" placeholder="Số nhà và tên đường" value="@php echo $dia_chi[0]  @endphp" style="color: black !important; font-size: 16px">
                            </div>
                        </div>
                        <div class="w-100"></div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="postcodezip" style="color: green; font-size: 18px">Mã giảm giá / ZIP *</label>
                                <input type="text" class="form-control" placeholder="Nhập mã giảm giá nếu có" value="@php echo $tk->voucher  @endphp" style="color: black !important; font-size: 16px">
                            </div>
                        </div>
                        <div class="w-100"></div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="phone" style="color: green; font-size: 18px">Số điện thoại</label>
                                <input type="text" class="form-control" placeholder="SĐT" value="@php echo $tk->sdt  @endphp" style="color: black !important; font-size: 16px">
                            </div>
                        </div>

                        {{-- <div class="w-100"></div>
                        <div class="col-md-12">
                            <div class="form-group mt-4">
                                <div class="radio">
                                    <label class="mr-3"><input type="radio" name="optradio"> Địa chỉ của tài khoản </label>
                                    <label><input type="radio" name="optradio"> Gửi đến địa chỉ khác</label>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </form>
                @endforeach
                <!-- END -->
            </div>
            
            <div class="col-xl-20">
                <div class="row mt-5 pt-3">
                    <div class="col-md-12">
                        <div class="cart-detail cart-total p-3 p-md-4">
                        <h3 class="billing-heading mb-4" style="color: red; font-size: 18px">CHI TIẾT GIỎ HÀNG</h3>
                        <p class="d-flex" style="color: black">
                            <span style="color: green; font-size: 18px">Tên sản phẩm</span>
                            <span style="color: green; text-align: center; font-size: 18px">Số lượng mua</span>
                            <span style="color: green; text-align: center; font-size: 18px">Giá</span>
                        </p>
                        @foreach ($giohang as $gh)
                            <p class="d-flex">
                                <span style="color: black; font-size: 16px">@php echo $gh->ten_san_pham @endphp</span>
                                <span style="color: black; text-align: center; font-size: 16px">@php echo $gh->so_luong @endphp</span>
                                <span style="color: black; text-align: center; font-size: 16px">{{ number_format($gh->gia * $gh->so_luong, 0, ",", ".")}} VNĐ</span>       
                            </p>
                        @endforeach
                    </div>  
                    <!-- END -->
                    </br>
                    <div class="col-md-6 d-flex mb-5">
                        <div class="cart-detail cart-total p-3 p-md-4">
                            <h3 class="billing-heading mb-4" style="color: red; font-size: 18px">TỔNG SỐ TIỀN GIỎ HÀNG</h3>
                            <p class="d-flex">
                                <span style="color: green; font-size: 18px">Tổng tiền</span>
                                <span style="color: black; font-size: 18px">{{ number_format($tongtien, 0, ",", ".")}} VNĐ</span>
                            </p>
                            {{-- <p class="d-flex">
                                <span>Vận chuyển</span>
                                <span>$0.00</span>
                            </p> --}}
                            <p class="d-flex">
                                <span style="color: green; font-size: 18px">Hạ giá</span>
                                <span style="color: black; font-size: 18px">{{ number_format($giamgia, 0, ",", ".")}} VNĐ </span>
                            </p>
                            <hr>
                            <p class="d-flex total-price">
                                <span style="color: green; font-size: 18px">Tổng tiền cần thanh toán</span>
                                <span style="color: black; font-size: 18px">{{ number_format($tongtien - $giamgia, 0, ",", ".")}} VNĐ</span>
                            </p>
                        </div>
                    </div>
                    <!-- END -->

                    <div class="col-md-6">
                        <div class="cart-detail p-3 p-md-4">
                            <h3 class="billing-heading mb-4" style="color: red">PHƯƠNG THỨC THANH TOÁN</h3>
                            <form action="{{ url('vnpay_payment') }}" method="POST">
                                @csrf
                                <input type="hidden" name="total_vnpay" value="{{  $tongtien - $giamgia }}">
                                <button type="submit" class="btn btn-default check_out" name="redirect">Thanh toán VNPAY</button>
                            </form>
                            <div class="form-group">
                                <div class="col-md-8">
                                    <div class="radio">
                                        <label><input type="radio" name="optradio" class="mr-2">  Thanh toán tiền mặt trực tiếp</label>
                                    </div>
                                </div>
                            </div>

                            <p><a href="#" class="btn btn-primary py-3 px-4">ĐẶT HÀNG</a></p>
                        </div>
                    </div>
                </div>
            </div> 
            <!-- .col-md-8 -->
        
    </div>
</section> 
@endsection