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
<div class="hero-wrap hero-bread" style="background-image: url('/images/banner-1.jpg');">
</div>
<section class="ftco-section">
    <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
            <div class="col-md-9 ftco-animate text-center">
                <div style="background-color: rgba(212, 243, 212, 0.5);"> 
                    <h1 class="mb-0 bread" style="font-size: 35px; color: rgb(87, 247, 93)">Chi Tiết Sản Phẩm</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-6 mb-5 ftco-animate">
                <a href="/images/{{ $product[0]->hinh }}" class="image-popup"><img src="/images/{{ $product[0]->hinh }}" class="img-fluid w-100" alt="Colorlib Template"></a>
            </div>
            <div class="col-lg-6 product-details pl-md-5 ftco-animate">
                <h3>{{ $product[0]->ten_san_pham }}</h3>
                <div class="rating d-flex">
                    <p class="text-left mr-4">
                        <a class="mr-2" id="countStar">{{ number_format($so_sao,1,',','.') }}</a>
                        @for ($i = 1; $i <= 5;$i++)
                        <a style="color: rgb(216, 216, 39);"><span class="
                            @if ($i < $so_sao)
                            ion-ios-star 
                            @elseif ( $i > $so_sao && $i < $so_sao + 1)
                            ion-ios-star-half
                            @else
                            ion-ios-star-outline
                        @endif"></span></a>
                        @endfor
                       
                       
                    </p>
                    <p class="text-left mr-4">
                        <a href="#" class="mr-2" style="color: #000;">{{ $binhchon }} <span style="color: #bbb;">Bình Chọn</span></a>
                    </p>
                    <p class="text-left">
                        <a href="#" class="mr-2" style="color: #000;">{{ $daban }} <span style="color: #bbb;">Đã Bán</span></a>
                    </p>
                </div>
                @if($product[0]->gia_tri > 0)
                <p class="priceOld"><span>{{ number_format($product[0]->gia, 0, ",", ".") }} VNĐ</span></p>
                <p class="priceSales"><span>{{ number_format(($product[0]->gia - ($product[0]->gia * $product[0]->gia_tri)/100), 0, ",", ".") }} VNĐ</span></p>
                @else
                <p class="price"><span>{{ number_format($product[0]->gia, 0, ",", ".") }} VNĐ</span></p>
                @endif
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
                       
                        
                   <form action="{{ route('cart.add') }}" method="get" > 
                       <input type="hidden" value="{{ $product[0]->id }}" name = "productId">
                       <input type="hidden" value="
                            @if ($product[0]->gia_tri == 0)
                                0
                            @else
                                {{ $product[0]->gia_tri }}
                            @endif
                                " name = "sales">
                       <input type="hidden" value="{{ $product[0]->gia }}" name = "price">
                            <span class="input-group-btn mr-2">
                                <button style="z-index: 2000;" type="button" class="quantity-left-minus btn" data-type="minus"  data-field=""onclick="minus()">
                                    <i class="ion-ios-remove" ></i>
                                </button>
                            </span>
                        <input  type="number" id="quantity" name="quantity" class="form-control input-number" onchange="quantity()" value="1" min="1" max="100">
                        <span class="input-group-btn ml-2">
                            <button  type="button" class="quantity-right-plus btn" data-type="plus"  data-field="" onclick="plus()" style="margin-left: 202px;">
                                <i class="ion-ios-add"></i>
                            </button>
                        </span>
                    </div>
                    <div class="w-100"></div>
                </div>
               <button type="submit" class="addCart">Thêm vào giỏ hàng</button>
            </form>
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
    @if(!empty($listProduct))
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
            @foreach ($listProduct as $items)  
            <div class="col-md-6 col-lg-3 ftco-animate">
                <div class="product">
                    <a href="{{ route('productdetail',['id'=>$items->id])}}" class="img-prod">
                        <img class="img-fluid w-100" style="height: 160px;" src="/images/{{ $items->hinh }}" alt="Colorlib Template">
                        @if ($items->gia_tri > 0)
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
            @endif
        </div>
        <div class="container">
            <h3>Đánh giá</h3>
            <hr>
            @if (!empty($comment))
                @foreach ($comment as $item)
                <div style="border: solid 1px rgb(0,0,0,0.25); height:auto; width:50%; padding: 12px 5px; margin-bottom: 10px;">
                    <img src="{{ asset("imageUsers/$item->hinh_anh")}}" height="50px" style="border-radius:50%; float: left">
                    <div style="padding:  0 5px; margin-bottom:0; margin-left: 58px;">
                        @for ($i= 1; $i <= 5; $i++)
                        <i class="@if($i <= $item->so_sao) ion-ios-star @else ion-ios-star-outline  @endif" style="color: rgb(216, 216, 39); user-select: none"></i>
                        @endfor
                    </div>
                    <p style="padding:  0 5px; margin-bottom:0; margin-left: 58px;">{{ $item->noi_dung }}</p>
                </div>
                @endforeach
            @endif
            
        </div>
    </div>
    <script>
    //    function assess(id,star){
    //     $('.modal-assess').css('display', 'flex');
    //     var modal = ` <div class="form">
    //     <div class="modal-header">
    //         <img src="/images/kfc.jpg" width="30px" alt="logo">
    //         <div class="modal-exit">X</div>
    //     </div>
    //    <div class="star">`;
    //     for (var i = 0; i < 5 ;i++)
    //     {
    //         if(i < star)
    //         {
    //             modal +=`<a><span class="ion-ios-star"  onclick="(assess(${id},${i + 1}))"></span></a>`;
    //         }
    //     else
    //     {
    //         modal +=`<a><span class="ion-ios-star-outline"  onclick="(assess(${id}, ${i + 1}))"></span></a>`;
    //     } 
    //     }
    //     modal +=`  </div>
    //     <form action="" method="post">
    //         @csrf
    //             <input type="hidden" name="id" value="${id}">
    //             <input type="text" name="content" placeholder="Đánh giá sản phẩm">
    //             <button type="submit">Đánh giá</button>
    //         </form>
    //         </div>
    //     </div>`; 
    // document.getElementById("modal").innerHTML = modal;
    // $('.modal-exit').click(function(){
    //         $('.modal-assess').css('display', 'none')
    //     });
    //    }
    </script>
</section>
@endsection
<div class="modal-assess" id="modal">
</div>