@extends('layouts.layout')
@section('content')
@php
      function hasLike($userId = 0, $id = 0)
    {
        $liked = DB::table('danh_gias')->where('yeu_thich',1)->where('tai_khoan_id', $userId)->where('san_pham_id', $id)->get();
        if(count($liked) > 0)
            return true;
        return false;
    }
@endphp
{{-- _MultiBanner --}}
<div class="container">
    <div id="myCarousel" class="carousel slide" data-ride="carousel">

        <!-- Indicators -->
        <ul class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
        </ul>

        <!-- The slideshow -->
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="images/banner-1.jpg" alt="Compo 1" width="1100" height="500">
            </div>
            <div class="carousel-item">
                <img src="images/banner-2.png" alt="Compo 2" width="1100" height="500">
            </div>
            <div class="carousel-item">
                <img src="images/banner-3.png" alt="Compo 3" width="1100" height="500">
            </div>
        </div>

        <!-- Left and right controls -->
        <a class="carousel-control-prev" href="#myCarousel" data-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </a>
        <a class="carousel-control-next" href="#myCarousel" data-slide="next">
            <span class="carousel-control-next-icon"></span>
        </a>
    </div>
</div>

{{-- Index --}}
<section class="ftco-section">
    <div class="container">
        <div class="row no-gutters ftco-services">
            <div class="col-md-3 text-center d-flex align-self-stretch ftco-animate">
                <div class="media block-6 services mb-md-0 mb-4">
                    <div class="icon bg-color-1 active d-flex justify-content-center align-items-center mb-2">
                        <span class="flaticon-shipped"></span>
                    </div>
                    <div class="media-body">
                        <h3 class="heading">Miễn phí giao hàng</h3>
                        <span style="color: black">Khi mua hơn 500 nghìn đồng</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 text-center d-flex align-self-stretch ftco-animate">
                <div class="media block-6 services mb-md-0 mb-4">
                    <div class="icon bg-color-2 d-flex justify-content-center align-items-center mb-2">
                        <span class="flaticon-box"></span>
                    </div>
                    <div class="media-body">
                        <h3 class="heading">Thực phẩm sạch sẽ</h3>
                        <span style="color: black">Đóng gỏi cẩn thận, không bao ni lông</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 text-center d-flex align-self-stretch ftco-animate">
                <div class="media block-6 services mb-md-0 mb-4">
                    <div class="icon bg-color-3 d-flex justify-content-center align-items-center mb-2">
                        <span class="flaticon-award"></span>
                    </div>
                    <div class="media-body">
                        <h3 class="heading">Siêu Chất Lượng</h3>
                        <span style="color: black">Thực phẩm chất lượng đạt chuẩn ISO</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 text-center d-flex align-self-stretch ftco-animate">
                <div class="media block-6 services mb-md-0 mb-4">
                    <div class="icon bg-color-4 d-flex justify-content-center align-items-center mb-2">
                        <span class="flaticon-customer-service"></span>
                    </div>
                    <div class="media-body">
                        <h3 class="heading">Hỗ Trợ</h3>
                        <span style="color: black"> Hỗ Trợ 24/7</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<div class="container">
    <div class="row">
        <div class="col-md-4">
            <div class="category-wrap ftco-animate img mb-4 d-flex align-items-end" style="background-image: url(images/hamburger.jpg);height: 300px;">
                <div class="text px-3 py-1 bg-danger" id="category">
                    <h2 class="mb-0 "><a href="{{ route('food') }}" class="text-white">Thức ăn</a></h2>
                </div>
            </div>

        </div>

        <div class="col-md-4">
            <div class="category-wrap ftco-animate img mb-4 d-flex align-items-end" style="background-image: url(images/trasua.jpg);height: 300px;" >
                <div class="text px-3 py-1 bg-danger " id="category">
                    <h2 class="mb-0 "><a href="{{ route('drink') }}" class="text-white">Thức uống</a></h2>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="category-wrap ftco-animate img mb-4 d-flex align-items-end" style="background-image: url(images/sale.jpg);height: 300px;">
                <div class="text px-3 py-1 bg-danger" id="category">
                    <h2 class="mb-0 "><a href="{{ route('sale') }}" class="text-white">Giảm giá</a></h2>
                </div>
            </div>
        </div>

    </div>
</div>


<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center mb-3 pb-3">
            <div class="col-md-12 heading-section text-center ftco-animate">
                <span class="subheading">THỰC PHẨM CHẤT LƯỢNG</span>
                <h2 class="mb-4">Thực Phẩm Của Chúng Tôi</h2>
                <p style="color: black">Chế biến ngay bán ngay, không để qua ngày</p>
                <div class="tab">
                    <div style="border-radius: 0 24px 0 0; background-color: rgba(255, 255, 250);box-shadow: 3px 1px rgba(0, 0, 0, 0.5); width: auto ; height: 60px">
                        <img src="images/hot.png" alt="hot" width="50px" style="float: left; background: transparent;">
                        <p style="color: red;float: left;font-size: 25px; padding-left: 5px; margin-top:15px; float: right">Được Yêu Thích Nhiều</p>
                    </div>
                    <a href="{{ route('productpage',['key' => "Tất cả",'page' => 1]) }}" class="see-more">Mua thêm</a>
                </div>
               
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row" id="listSP" >
            @foreach ($lstsp as $sp)
                <div id="idsp" class="carousel-item active" style="margin-right: 0; width: 25%;">
                    
                    <div class="col-md-6 col-lg-3 ftco-animate" style="max-width: 100%;">
                        <div class="product">
                            <a href="{{ route('productdetail',['id'=>$sp->id]) }}" class="img-prod">
                                <img class="img-fluid w-100" style="height: 160px;" src="{{ asset("/images/$sp->hinh") }}" alt="Colorlib Template">
                                @if($sp->khuyen_mai_id != 3)
                                    <span class="status">{{ $sp->gia_tri }}%</span>
                                @endif
                                <div class="overlay"></div>
                            </a>
                            <div class="text py-3 pb-4 px-3 text-center">
                                <h3><a href="{{ route('productdetail',['id'=>$sp->id]) }}">{{ $sp->ten_san_pham }}</a></h3>
                                @if($sp->gia_tri > 0)
                                <div class="d-flex">
                                    <div class="pricing">
                                        <p class="price priceOld"><span>{{ number_format($sp->gia, 0, ",", ".") }} VNĐ</span></p>
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <div class="pricing">
                                        <p class=" priceSales"><span>{{ number_format($sp->gia - ($sp->gia * $sp->gia_tri) / 100, 0, ",", ".") }} VNĐ</span></p>
                                    </div>
                                </div>
                                @else
                                <div class="d-flex">
                                    <div class="pricing">
                                        <p class="price"><span>{{ number_format($sp->gia, 0, ",", ".") }} VNĐ</span></p>
                                    </div>
                                </div>
                                @endif
                                <div class="bottom-area d-flex px-3">
                                    <div class="m-auto d-flex">
                                        <a href="{{ route('cart.add',['productId' => $sp->id,'quantity' => 1,'price' => $sp->gia,'sales' => $sp->gia_tri]) }}" class="buy-now d-flex justify-content-center align-items-center mx-1" id="cart">
                                            <span><i class="ion-ios-cart"></i></span>
                                        </a>
                                        @if(!empty(Session::get('UserId')))
                                            @if (hasLike(Session::get('UserId'),$sp->id))
                                                <a href="{{ route('like',['id' => $sp->id]) }}"class="heart d-flex justify-content-center align-items-center" style="background-image: linear-gradient(red, white);" id="heart">
                                                    <span><i class="ion-ios-heart"></i></span>
                                                </a>
                                            @else
                                            <a href="{{ route('like',['id' => $sp->id]) }}"class="heart d-flex justify-content-center align-items-center" id="heart">
                                                <span><i class="ion-ios-heart"></i></span>
                                            </a>
                                            @endif
                                            @else
                                            <a href="{{ route('like',['id' => $sp->id]) }}"class="heart d-flex justify-content-center align-items-center" id="heart">
                                                <span><i class="ion-ios-heart"></i></span>
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="container">
        <div class="row justify-content-center mb-3 pb-3">
            <div class="col-md-12 heading-section text-center ftco-animate">
                <div class="tab">
                    <div style="border-radius: 0 24px 0 0; background-color: rgba(255, 255, 250);box-shadow: 3px 1px rgba(0, 0, 0, 0.5); width: auto ; height: 60px">
                        <img src="images/hot.png" alt="hot" width="50px" style="float: left; background: transparent;">
                        <p style="color: red;float: left;font-size: 25px; padding-left: 5px; margin-top:15px; float: right">Mua nhiều</p>
                    </div>
                </div>
               
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            @foreach ($lstsp2 as $sp)
                <div id="idsp" class="carousel-item active" style="margin-right: 0; width: 25%;">
                    
                    <div class="col-md-6 col-lg-3 ftco-animate" style="max-width: 100%;">
                        <div class="product">
                            <a href="{{ route('productdetail',['id'=>$sp->id]) }}" class="img-prod">
                                <img class="img-fluid w-100" style="height: 160px;" src="{{ asset("/images/$sp->hinh") }}" alt="Colorlib Template">
                                @if($sp->khuyen_mai_id != 3)
                                    <span class="status">{{ $sp->gia_tri }}%</span>
                                @endif
                                <div class="overlay"></div>
                            </a>
                            <div class="text py-3 pb-4 px-3 text-center">
                                <h3><a href="{{ route('productdetail',['id'=>$sp->id]) }}">{{ $sp->ten_san_pham }}</a></h3>
                                @if($sp->gia_tri > 0)
                                <div class="d-flex">
                                    <div class="pricing">
                                        <p class="price priceOld"><span>{{ number_format($sp->gia, 0, ",", ".") }} VNĐ</span></p>
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <div class="pricing">
                                        <p class=" priceSales"><span>{{ number_format($sp->gia - ($sp->gia * $sp->gia_tri) / 100, 0, ",", ".") }} VNĐ</span></p>
                                    </div>
                                </div>
                                @else
                                <div class="d-flex">
                                    <div class="pricing">
                                        <p class="price"><span>{{ number_format($sp->gia, 0, ",", ".") }} VNĐ</span></p>
                                    </div>
                                </div>
                                @endif
                                <div class="bottom-area d-flex px-3">
                                    <div class="m-auto d-flex">
                                        <a href="{{ route('cart.add',['productId' => $sp->id,'quantity' => 1,'price' => $sp->gia,'sales' => $sp->gia_tri]) }}" class="buy-now d-flex justify-content-center align-items-center mx-1" id="cart">
                                            <span><i class="ion-ios-cart"></i></span>
                                        </a>
                                        @if(!empty(Session::get('UserId')))
                                            @if (hasLike(Session::get('UserId'),$sp->id))
                                                <a href="{{ route('like',['id' => $sp->id]) }}"class="heart d-flex justify-content-center align-items-center" style="background-image: linear-gradient(red, white);" id="heart">
                                                    <span><i class="ion-ios-heart"></i></span>
                                                </a>
                                            @else
                                            <a href="{{ route('like',['id' => $sp->id]) }}"class="heart d-flex justify-content-center align-items-center" id="heart">
                                                <span><i class="ion-ios-heart"></i></span>
                                            </a>
                                            @endif
                                            @else
                                            <a href="{{ route('like',['id' => $sp->id]) }}"class="heart d-flex justify-content-center align-items-center" id="heart">
                                                <span><i class="ion-ios-heart"></i></span>
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="container">
        <div class="row mt-5">
            <div class="col text-center">
                <div class="block-27">
                        <a href="{{ route('productpage',['key' => "Tất cả",'page' => 1]) }}" class="see-more">Mua thêm</a> 
                </div>
            </div>
        </div>
    </div>
</section>
@if(isset($_GET['success']))

<div class="modal-assess" id="modal">
    <div class="form">
        <div class="modal-header">
            <img src="/images/kfc.jpg" width="30px" alt="logo">
            <div class="modal-exit">X</div>
        </div>
        <div class="star">
        <p>Cảm ơn quý khách đã ủng hộ!</p>
    </div>
    <div class="star">
        <p>Tổng số tiền của hóa đơn:</p>
    </div>
    <div class="star">
        <p style="font-weight: bold">{{ number_format($_GET['amount'],0,',','.') }} VNĐ</p>
    </div>
    <div class="content">
        <p>Người nhận hàng:</p>
        <p style=" width:150px; font-weight: bold">{{$_GET['getter'] }}</p>
    </div>
    <div class="content">
        <p>Địa chỉ:</p>
        <p style=" width:150px; font-weight: bold;">{{ $_GET['address'] }}</p>
    </div>
    <div class="content">
        <p>SĐT:</p>
        <p style=" width:150px; font-weight: bold">{{ $_GET['phone']}}</p>
    </div>
</div>
</div>
<script>
    $('.modal-assess').css('display', 'flex');
</script>
<script>
        $('.modal-exit').on('click',function(){
            $('.modal-assess').css('display', 'none')
        });
</script>
@endif
<hr>
@endsection
