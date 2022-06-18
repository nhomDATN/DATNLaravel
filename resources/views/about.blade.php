@extends('layouts.layout')
@section('content')
<div class="hero-wrap hero-bread" style="background-image: url('images/banner-3.png');">
    <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
            <div class="col-md-9 ftco-animate text-center">
                <div style="background-color: rgba(212, 243, 212, 0.5);">   
                    <h1 class="mb-0 bread" style="font-size: 35px; color: rgb(87, 247, 93)">Về Chúng Tôi</h1>
                </div>
            </div>
        </div>
    </div>
</div>

<section class="ftco-section ftco-no-pb ftco-no-pt bg-light">
    <div class="container">
        <div class="row">
            <div class="col-md-5 p-md-5 img img-2 d-flex justify-content-center align-items-center" style="background-image: url(images/1.jpg);">
                <a href="https://vimeo.com/45830194" class="bg-danger icon popup-vimeo d-flex justify-content-center align-items-center">
                    <span class="icon-play"></span>
                </a>
            </div>
            <div class="col-md-7 py-5 wrap-about pb-md-5 ftco-animate">
                <div class="heading-section-bold mb-4 mt-md-5">
                    <div class="ml-md-0">
                        <h2 class="mb-4">Chào mừng bạn đến với CKCFastFood, một trang web Thương mại điện tử</h2>
                    </div>
                </div>
                <div class="pb-md-5">
                    <p>Bạn có dùng thức ăn nhanh? Có nhiều người phàn nàn về nó nhưng thức ăn nhanh đúng là những món ăn ngon! – nghĩa là khi bạn đến trang web CKCFastFood.</p>
                    <p>Thức ăn nhanh là thức ăn hấp dẫn nhất đối với nhiều loại thực phẩm đặc biệt đối với trẻ em và thanh thiếu niên.</p>
                    <p><a href="{{route('productpage',['key' => "Tất cả",'page' => 1]) }}" class="btn btn-danger">Mua ngay</a></p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection