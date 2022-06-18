@extends('layouts.layout')
@section('content')
@php 
    Session::put('dem', 0);
@endphp
<div class="hero-wrap hero-bread" style="background-image: url('images/banner-1.jpg');">
</div>

<section class="ftco-section">
    <div class="container">
        @if(count($giohang) == 0)
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center">
                <div class="col-md-8 ftco-animate text-center">
                    <div style="background-color: rgba(243, 219, 212, 0.5);">
                        <h1 class="mb-0 bread" style="font-size: 35px; color: rgb(247, 116, 87)">Không Có Giỏ Hàng Để Thanh Toán</h1>
                    </div>
                </div>
            </div>
        </div>
        @else
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
        <form action="{{ route('thanhtoan') }}" method="POST">
            @csrf
            <h3 class="mb-4 billing-heading" style="color: red;">CHI TIẾT HÓA ĐƠN</h3>
             <div class="col-xl-20">
                <div class="row mt-5 pt-3">
                    <div class="col-md-12">
                        <div class="cart-detail cart-total p-md-4" style="margin-left:15px;">
                        <h3 class="billing-heading mb-4" style="color: red; font-size: 18px">CHI TIẾT GIỎ HÀNG</h3>
                        <p class="d-flex" style="color: black">
                            <span style="color: green; font-size: 18px">Tên sản phẩm</span>
                            <span style="color: green; text-align: center; font-size: 18px">Số lượng mua</span>
                            <span style="color: green; text-align: center; font-size: 18px">Giá</span>
                        </p>
                        @foreach($giohang as $item)
                            <p class="d-flex">
                                <span style="color: black; font-size: 16px">{{ $item->ten_san_pham }}</span>
                                <span style="color: black; text-align: center; font-size: 16px">{{ $item->so_luong }}</span>
                                <span style="color: black; text-align: center; font-size: 16px">{{ number_format(($item->gia - ($item->gia * $item->chiet_khau)/100), 0, ",", ".") }} VNĐ</span>       
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
                                <span style="color: black; font-size: 18px">{{ number_format($tongtien,0,',','.') }} VNĐ</span>
                            </p>
                            <p class="d-flex">
                                <span>Vận chuyển</span>
                                <span>{{ number_format($feeShipping,0,',','.') }} VNĐ</span>
                            </p>
                            <p class="d-flex">
                                <span style="color: green; font-size: 18px">Hạ giá</span>
                                <span style="color: black; font-size: 18px">0 VNĐ</span>
                            </p>
                            <hr>
                            <p class="d-flex total-price">
                                <span style="color: green; font-size: 18px">Tổng tiền cần thanh toán</span>
                                <span style="color: black; font-size: 18px">{{ number_format($tongtien + $feeShipping,0,',','.') }} VNĐ</span>
                            </p>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="postcodezip" style="color: green; font-size: 18px">Mã giảm giá / ZIP *</label>
                                    <input type="text" name="voucher" class="form-control" placeholder="Nhập mã giảm giá nếu có" value="" style="color: black !important; font-size: 16px">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div style="margin-left:15px;"><div style="color: red; font-size: 18px">THÔNG TIN NGƯỜI NHẬN HÀNG</div>
                    <div class="row align-items-end">
                         <div class="col-md-6">
                            <div class="form-group">
                                <label for="people" style="color: green; font-size: 18px">Tên Người Nhận</label>
                                <input type="text" class="form-control" placeholder="Nhập tên người nhận" name="people" value="{{ $tttk[0]->ho_ten }}">
                            </div>
                        </div>
                    
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="address" style="color: green; font-size: 18px">Địa Chỉ Giao Hàng</label>
                                <input type="text" class="form-control" placeholder="Số nhà và tên đường" name="address" value="{{ $tttk[0]->dia_chi }}" style="color: black !important; font-size: 16px">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="phone" style="color: green; font-size: 18px">Số điện thoại liên hệ</label>
                                <input type="text" class="form-control" placeholder="SĐT" name="phone" style="color: black !important; font-size: 16px" value="{{ $tttk[0]->sdt }}">
                            </div>
                        </div> 

                         
                     </div></div>
                    
                    <!-- END -->

                     <div class="col-md-6">
                        <div class="cart-detail p-3 p-md-4">
                            <h3 class="billing-heading mb-4" style="color: red">PHƯƠNG THỨC THANH TOÁN</h3>
                            <div class="form-group">
                                <div class="col-md-8">
                                    <div class="radio">
                                        <label><input type="radio" name="optradio" class="mr-2" value="cast" checked>  Thanh toán bằng tiền mặt </label>
                                        {{-- <label><input type="radio" name="optradio" class="mr-2" value="momo">  Thanh toán qua ví Momo <img src="/images/momo.jpg" alt="" style="width: 30px; height: 30px"></label> --}}
                                        <label><input type="radio" name="optradio" class="mr-2" value="VNPay">  Thanh toán qua VNPay <img src="/images/VNPay.png" alt="" style="width: 30px; height: 30px"></label>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="id" value="{{ Session::get('cartId') }}"">
                            <input type="hidden" name="userId" value="{{ Session::get('UserId') }}"">
                            <input type="hidden" name="total" value="{{ $tongtien + $feeShipping }}">
                            <p><button type="submit" class="btn btn-primary py-3 px-4" id="formSubmit">ĐẶT HÀNG</button></p>
                        </form>
                        </div>
                    </div>
                </div>
            </div> 
        @endif
    </div>
</section> 
<script>
    $(document).ready(function(){ 
        formSubmit.addEventListener('click', function(e) {
            if($('input[name="people"]').val() == '') {
                $('input[name="people"]').css('border','solid 1px red')
                e.preventDefault();
            }
            if($('input[name="address"]').val() == '') {
                $('input[name="address"]').css('border',' solid 1px red')
                e.preventDefault();
            }
            if($('input[name="phone"]').val() == '') {
                $('input[name="phone"]').css('border','solid 1px red')
                e.preventDefault();
            }
            else
            {
                e.submit();
            }
       
    });
    });
   
</script>
@endsection
