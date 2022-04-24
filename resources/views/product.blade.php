@extends('layouts.layout')
@section('content')
<div class="hero-wrap hero-bread" style="background-image: url('/images/banner-2.png');">
    <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
            <div class="col-md-9 ftco-animate text-center">

                <h1 class="mb-0 bread">Thực Phẩm</h1>
            </div>
        </div>
    </div>
</div>

<section class="ftco-section">
    <div class="container" id="listProduct">
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
                        @if ($items->khuyen_mai_id != 1)
                        <span class="status">{{ $items->giatri }} %</span>
                        @endif
                        <div class="overlay"></div>
                    </a>
                    <div class="text py-3 pb-4 px-3 text-center">
                        <h3><a href="#">{{ $items->ten_san_pham }}</a></h3>
                        <div class="d-flex">
                            <div class="pricing">
                                <p class="price"><span>{{ $items->gia }} đ</span></p>
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
@endsection