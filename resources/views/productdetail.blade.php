﻿@extends('layouts.layout')
@section('content')
<div class="hero-wrap hero-bread" style="background-image: url('/images/banner-1.jpg');">
    <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
            <div class="col-md-9 ftco-animate text-center">

                <h1 class="mb-0 bread">Chi Tiết Sản Phẩm</h1>
            </div>
        </div>
    </div>
</div>

<section class="ftco-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 mb-5 ftco-animate">
                <a href="/images/{{ $product[0]->hinh }}" class="image-popup"><img src="/images/{{ $product[0]->hinh }}" class="img-fluid w-100" alt="Colorlib Template"></a>
            </div>
            <div class="col-lg-6 product-details pl-md-5 ftco-animate">
                <h3>{{ $product[0]->ten_san_pham }}</h3>
                <div class="rating d-flex">
                    <p class="text-left mr-4">
                        <a href="#" class="mr-2">5.0</a>
                        <a href="#"><span class="ion-ios-star-half"></span></a>
                        <a href="#"><span class="ion-ios-star-outline"></span></a>
                        <a href="#"><span class="ion-ios-star-outline"></span></a>
                        <a href="#"><span class="ion-ios-star-outline"></span></a>
                        <a href="#"><span class="ion-ios-star-outline"></span></a>
                    </p>
                    <p class="text-left mr-4">
                        <a href="#" class="mr-2" style="color: #000;">100 <span style="color: #bbb;">Bình Chọn</span></a>
                    </p>
                    <p class="text-left">
                        <a href="#" class="mr-2" style="color: #000;">500 <span style="color: #bbb;">Đã Bán</span></a>
                    </p>
                </div>
                <p class="price"><span>{{ $product[0]->gia }}đ</span></p>
                <p>{{ $product[0]->mo_ta }}</p>
                <div class="row mt-4">
                    <div class="col-md-6">
                        <div class="form-group d-flex">
                            <!--<div class="select-wrap">
                              <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                              <select name="" id="" class="form-control">
                                <option value="">Small</option>
                                <option value="">Medium</option>
                                <option value="">Large</option>
                                <option value="">Extra Large</option>
                              </select>
                            </div>-->
                        </div>
                    </div>
                    <div class="w-100"></div>
                    <div class="input-group col-md-6 d-flex mb-3">
                       
                        
                   
                            <span class="input-group-btn mr-2">
                                <button type="button" class="quantity-left-minus btn" data-type="minus"  data-field=""onclick="minus()">
                                    <i class="ion-ios-remove" ></i>
                                </button>
                            </span>
                        <input type="text" id="quantity" name="quantity" class="form-control input-number" onchange="quantity()" value="1" min="1" max="100">
                        <span class="input-group-btn ml-2">
                            <button type="button" class="quantity-right-plus btn" data-type="plus"  data-field="" onclick="plus()">
                                <i class="ion-ios-add"></i>
                            </button>
                        </span>
                    </div>
                    <div class="w-100"></div>

                </div>
                <p  ><a href="cart.html" class="addCart">Thêm vào giỏ hàng</a></p>
            </div>
                   
                        <script>
                          function plus() {
                              document.getElementById("quantity").value++;
                          }
                          function minus() {
                              if(document.getElementById("quantity").value > 1)
                              document.getElementById("quantity").value--;
                          }
                          function quantity()
                          {
                            if(document.getElementById("quantity").value < 1)
                              {
                                  alert("Số lượng bạn thêm không thể nhỏ hơn 1");
                                  document.getElementById("quantity").value = 1;
                              }
                          }
                        </script>
                    
        </div>
    </div>
</section>

<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center mb-3 pb-3">
            <div class="col-md-12 heading-section text-center ftco-animate">
                <span class="subheading">Thực Phẩm</span>
                <h2 class="mb-4">Thực Phẩm Liên Quan</h2>
                <p>Ngon Ngon Giòn Giòn, Đã Quá Pepsi ơi</p>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            @foreach ($listProduct as $item )  
            <div class="col-md-6 col-lg-3 ftco-animate">
                <div class="product">
                    <a href="{{ route('productdetail',['key' => $key, 'id' => $item->id]) }}" class="img-prod">
                        <img class="img-fluid w-100" style="height: 160px;" src="/images/{{ $item->hinh }}" alt="Colorlib Template">
                        <div class="overlay"></div>
                    </a>
                    <div class="text py-3 pb-4 px-3 text-center">
                        <h3><a href="#">{{ $item->ten_san_pham }}</a></h3>
                        <div class="d-flex">
                            <div class="pricing">
                                <p class="price"><span>{{ $item->gia }} đ</span></p>
                            </div>
                        </div>
                        <div class="bottom-area d-flex px-3">
                            <div class="m-auto d-flex">
                                <a href="#" class="add-to-cart d-flex justify-content-center align-items-center text-center">
                                    <span><i class="ion-ios-menu"></i></span>
                                </a>
                                <a href="#" class="buy-now d-flex justify-content-center align-items-center mx-1">
                                    <span><i class="ion-ios-cart"></i></span>
                                </a>
                                <a href="#" class="heart d-flex justify-content-center align-items-center ">
                                    <span><i class="ion-ios-heart"></i></span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection