@extends('layouts.layout')
@section('content')
<div class="hero-wrap hero-bread" style="background-image: url('images/banner-1.jpg');">
    <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
            <div class="col-md-9 ftco-animate text-center">
                <div style="background-color: rgba(212, 243, 212, 0.5);">
                    <h1 class="mb-0 bread" style="font-size: 35px; color: rgb(87, 247, 93)">Thanh Toán</h1>
                </div>
            </div>
        </div>
    </div>
</div>

<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-7 ftco-animate">
                @foreach ($tttk as $tk)
                <form action="#" class="billing-form">
                    <h3 class="mb-4 billing-heading">Chi tiết hóa đơn</h3>
                    <div style="color: red; font-size: 18px">Thông tin tài khoản</div>
                    <div class="row align-items-end">
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="firstname">Họ tên</label>
                                <input type="text" class="form-control" placeholder="Họ tên" value="@php echo $tk->ho_ten  @endphp" style="color: black !important">
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
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="country">Quận</label>
                                <input type="text" class="form-control" placeholder="Quận" value="@php echo $dia_chi[1]  @endphp" style="color: black !important">
                                {{-- <div class="select-wrap">
                                    <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                                    <select name="" id="" class="form-control" style="color: black !important">
                                        <option value="">Quận 1</option>
                                        
                                        <option value="">Quận 2</option>
                                        
                                        <option value="">Quận 3</option>
                                       
                                        <option value="">Quận 4</option>
                                        
                                        <option value="">Quận 5</option>
                                        
                                        <option value="">Quận 6</option>
                                        
                                        <option value="">Quận 7</option>
                                        
                                        <option value="">Quận 8</option>
                                        
                                        <option value="">Quận 9</option>
                                        
                                        <option value="">Quận 10</option>
                                        
                                        <option value="">Quận 11</option>
                                        
                                        <option value="">Quận 12</option>
                                        
                                    </select>
                                </div> --}}
                            </div>
                        </div>
                        <div class="w-100"></div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="streetaddress">Địa chỉ</label>
                                <input type="text" class="form-control" placeholder="Số nhà và tên đường" value="@php echo $dia_chi[0]  @endphp" style="color: black !important">
                            </div>
                        </div>
                        {{-- <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Căn hộ, dãy phòng,...(tùy chọn)">
                            </div>
                        </div> --}}
                        <div class="w-100"></div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="postcodezip">Mã giảm giá / ZIP *</label>
                                <input type="text" class="form-control" placeholder="Nhập mã giảm giá nếu có" value="@php echo $tk->voucher  @endphp" style="color: black !important">
                            </div>
                        </div>
                        <div class="w-100"></div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="phone">Số điện thoại</label>
                                <input type="text" class="form-control" placeholder="SĐT" value="@php echo $tk->sdt  @endphp" style="color: black !important">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="emailaddress">Email</label>
                                <input type="text" class="form-control" placeholder="Email" value="@php echo $tk->email  @endphp" style="color: black !important">
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
            
            <div class="col-xl-5">
                <div class="row mt-5 pt-3">
                    <div class="col-md-12">
                        <div class="cart-detail cart-total p-3 p-md-4">
                        <h3 class="billing-heading mb-4" style="color: red">Chi tiết giỏ hàng</h3>
                        <p class="d-flex" style="color: black">
                            <span style="color: green">Tên sản phẩm</span>
                            <span style="color: green; text-align: center">Số lượng mua</span>
                            <span style="color: green; text-align: center">Giá</span>
                        
                        </p>
                        @foreach ($giohang as $gh)
                            <p class="d-flex">
                                <span style="color: black">@php echo $gh->ten_san_pham @endphp</span>
                                <span style="color: black; text-align: center">@php echo $gh->so_luong @endphp</span>
                                <span style="color: black; text-align: center">@php echo $gh->gia * $gh->so_luong @endphp</span>
                            
                            </p>
                        @endforeach
                    </div>  
                    <!-- END -->
                    
                    </br>
                    <div class="col-md-12 d-flex mb-5">
                        <div class="cart-detail cart-total p-3 p-md-4">
                            <h3 class="billing-heading mb-4" style="color: red">Tổng số tiền giỏ hàng</h3>
                            <p class="d-flex">
                                <span style="color: black">Tổng tiền</span>
                                <span style="color: black">@php echo $tongtien @endphp</span>
                                
                                
                            </p>
                            {{-- <p class="d-flex">
                                <span>Vận chuyển</span>
                                <span>$0.00</span>
                            </p> --}}
                            <p class="d-flex">
                                <span style="color: black">Hạ giá</span>
                                <span style="color: black">@php echo $giamgia @endphp</span>
                            </p>
                            <hr>
                            <p class="d-flex total-price">
                                <span style="color: black">Total</span>
                                <span style="color: black">@php echo ($tongtien - $giamgia) @endphp</span>
                            </p>
                        </div>
                    </div>
                    <!-- END -->

                    <div class="col-md-12">
                        <div class="cart-detail p-3 p-md-4">
                            <h3 class="billing-heading mb-4">Phương thức thanh toán</h3>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <div class="radio">
                                        <label><input type="radio" name="optradio" class="mr-2"> Thanh toán qua ví điện tử</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <div class="radio">
                                        <label><input type="radio" name="optradio" class="mr-2">  Thanh toán tiền mặt trực tiếp</label>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="form-group">
                                <div class="col-md-12">
                                    <div class="radio">
                                        <label><input type="radio" name="optradio" class="mr-2"> Paypal</label>
                                    </div>
                                </div>
                            </div> --}}
                           
                            <p><a href="#" class="btn btn-primary py-3 px-4">Đặt hàng</a></p>
                        </div>
                    </div>
                </div>
            </div> 
            <!-- .col-md-8 -->
        </div>
    </div>
</section> 
@endsection