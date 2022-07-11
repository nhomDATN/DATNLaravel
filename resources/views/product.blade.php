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
<div class="hero-wrap hero-bread" style="background-image: url('/images/banner-2.png');">
</div>

<section class="ftco-section">
    <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
            <div class="col-md-9 ftco-animate text-center">
                <div style="background-color: rgba(212, 243, 212, 0.5);"> 
                    <h1 class="mb-0 bread" style="font-size: 35px; color: rgb(87, 247, 93)">Thực Phẩm</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="container" id="listProduct">
        {{-- <div class="container">
            <div class="tab">
                <p></p>
                <p class="search"><i class="icon-search"></i></p>
            </div>
            <div class="tab" id="search">
                <div>
                    <i class="icon-search"></i>
                    <input type="text"  placeholder="Nhập tên sản phẩm cần tìm">
                </div>
            </div>
        </div> --}}
        <div class="row justify-content-center">
            <div class="col-md-10 mb-5 text-center">
                <ul class="product-category">
                    @foreach ( Session::get('productType') as $items )
                    <li><a href="{{ route('productpage',['key' => $items,'page' => 1]) }}"id="keysearch"@if ($items == $key) class="active" @endif " > {{ $items }} </a></li>
                    @endforeach
                  
                </ul>
            </div>
        </div>
        <div class="row" >
            @if (!empty($product))
            @foreach ($product as $items)          
            <div class="col-md-6 col-lg-3 ftco-animate">
                <div class="product">
                    <a href="{{ route('productdetail',['id'=>$items->id])}}" class="img-prod">
                        <img class="img-fluid w-100" style="height: 160px;" src="/images/{{ $items->hinh }}" alt="Colorlib Template">
                        @if ($items->khuyen_mai_id != 3)
                        <span class="status">{{ $items->gia_tri }} %</span>
                        @endif
                        <div class="overlay"></div>
                    </a>
                    <div class="text py-3 pb-4 px-3 text-center">
                        <h3><a href="{{ route('productdetail',['id'=>$items->id])}}">{{ $items->ten_san_pham }}</a></h3>
                        @if($items->gia_tri > 0)
                        <div class="d-flex">
                            <div class="pricing">
                                <p class="price priceOld"><span>{{ number_format($items->gia, 0, ",", ".") }} VNĐ</span></p>
                            </div>
                        </div>
                        <div class="d-flex">
                            <div class="pricing">
                                <p class=" priceSales"><span>{{ number_format($items->gia - ($items->gia * $items->gia_tri) / 100, 0, ",", ".") }} VNĐ</span></p>
                            </div>
                        </div>
                        @else
                        <div class="d-flex">
                            <div class="pricing">
                                <p class="price"><span>{{ number_format($items->gia, 0, ",", ".") }} VNĐ</span></p>
                            </div>
                        </div>
                        @endif
                        <div class="bottom-area d-flex px-3">
                            <div class="m-auto d-flex">
                                <a href="{{ route('cart.add',['productId' => $items->id,'quantity' => 1,'price' => $items->gia,'sales' => $items->gia_tri]) }}" class="buy-now d-flex justify-content-center align-items-center mx-1" id="cart">
                                    <span><i class="ion-ios-cart"></i></span>
                                </a>
                                @if(!empty(Session::get('UserId')))
                                    @if (hasLike(Session::get('UserId'),$items->id))
                                        <a href="{{ route('like',['id' => $items->id]) }}"class="heart d-flex justify-content-center align-items-center" style="background-image: linear-gradient(red, white);" id="heart">
                                            <span><i class="ion-ios-heart"></i></span>
                                        </a>
                                    @else
                                    <a href="{{ route('like',['id' => $items->id]) }}"class="heart d-flex justify-content-center align-items-center" id="heart">
                                        <span><i class="ion-ios-heart"></i></span>
                                    </a>
                                    @endif
                                    @else
                                    <a href="{{ route('like',['id' => $items->id]) }}"class="heart d-flex justify-content-center align-items-center" id="heart">
                                        <span><i class="ion-ios-heart"></i></span>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            @else
            <p>Không tồn tại sản phẩm này</p>
            @endif
          
        </div>
        <div class="row mt-5">
            <div class="col text-center">
                <div class="block-27">
                    
                    @if ($maxpage >= 2.0)
                    <ul>
                        @if ($page != 1)
                        <li><a href="{{ route('productpage',['key' => $key,'page' => $page - 1]) }}">&lt;</a></li>
                        @endif
                        @for ($i = 1; $i <= $maxpage; ++$i)
                           @if ($i == $page)
                           <li class="active"><span>{{ $i }}</span></li>
                           @else
                           <li><a href="{{ route('productpage',['key' => $key,'page' => $i]) }}">{{ $i }}</a></li>
                           @endif 
                          
                        @endfor
                        @if ($page != $maxpage)
                         <li><a href="{{ route('productpage',['key' => $key,'page' => $page + 1]) }}">&gt;</a></li>
                        @endif
                        
                    </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <hr>
</section>
<script>
    function searchAjax(active){
                 $.ajax({
                    type: 'get',
                    url: '{{ URL::to('productSearch') }}',
                    data: {
                        'search': active
                    },
                    success: function(data) {
                        $('#listProduct').html(data);
                    }
                });
            }
</script>
<script>
</script>
@endsection