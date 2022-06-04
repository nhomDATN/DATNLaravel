@extends('layouts.layout')
@section('content')
<div class="hero-wrap hero-bread" style="background-image: url('images/banner-2.png');">
    <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
            <div class="col-md-9 ftco-animate text-center">
                <div style="background-color: rgba(212, 243, 212, 0.5);">
                    <h1 class="mb-0 bread" style="color: rgb(87, 247, 93)">Thức Uống</h1>
                </div>
            </div>  
        </div>
    </div>
</div>

<section class="ftco-section">
    <div class="container">
        <div class="row">
            @foreach($lstsp as $sp)
            <div class="col-md-6 col-lg-3 ftco-animate">
                <div class="product">
                    <a href="{{ route('productdetail',['id'=>$sp->id]) }}" class="img-prod">
                        <img class="img-fluid w-100" style="height: 160px;" src="{{ asset("/images/$sp->hinh") }}" alt="Colorlib Template">
                        @if($sp->khuyen_mai_id != 3)
                        <span class="status">{{ $sp->gia_tri }}%</span>
                        @endif
                    </a>
                    <div class="text py-3 pb-4 px-3 text-center">
                        <h3><a href="#">{{ $sp->ten_san_pham }}</a></h3>
                        <div class="d-flex">
                            <div class="pricing">
                                <p class="price"><span>{{ number_format($sp->gia, 0, ",", ".") }} VNĐ</span></p>
                            </div>
                        </div>
                        <div class="bottom-area d-flex px-3">
                            <div class="m-auto d-flex">
                                <a href="{{ route('cart.add',['productId' => $sp->id,'quantity' => 1]) }}" class="buy-now d-flex justify-content-center align-items-center mx-1" id="cart">
                                    <span><i class="ion-ios-cart"></i></span>
                                </a>
                                <a href="{{ route('like',['id' => $sp->id]) }}" class="heart d-flex justify-content-center align-items-center ">
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
    <hr>
</section>
@endsection