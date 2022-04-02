@extends('layouts.layout')
@section('content')
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
                <div class="text px-3 py-1 bg-danger ">
                    <h2 class="mb-0 "><a href="#" class="text-white">Thức ăn</a></h2>
                </div>
            </div>

        </div>

        <div class="col-md-4">
            <div class="category-wrap ftco-animate img mb-4 d-flex align-items-end" style="background-image: url(images/trasua.jpg);height: 300px;">
                <div class="text px-3 py-1 bg-danger ">
                    <h2 class="mb-0 "><a href="#" class="text-white">Thức uống</a></h2>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="category-wrap ftco-animate img mb-4 d-flex align-items-end" style="background-image: url(images/sale.jpg);height: 300px;">
                <div class="text px-3 py-1 bg-danger ">
                    <h2 class="mb-0 "><a href="#" class="text-white">Giảm giá</a></h2>
                </div>
            </div>
        </div>

    </div>
</div>


<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center mb-3 pb-3">
            <div class="col-md-12 heading-section text-center ftco-animate">
                <span class="subheading">Thực Phẩm Chất Lượng</span>
                <h2 class="mb-4">Thực Phẩm Của Chúng Tôi</h2>
                <p style="color: black">Chế biến ngay bán ngay, không để qua ngày</p>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-lg-3 ftco-animate">
                <div class="product">
                    <a href="#" class="img-prod">
                        <img class="img-fluid" src="images/1.jpg" alt="Colorlib Template">

                        <div class="overlay"></div>
                    </a>
                    <div class="text py-3 pb-4 px-3 text-center">
                        <h3><a href="#">Thực Phẩm 1</a></h3>
                        <div class="d-flex">
                            <div class="pricing">
                                <p class="price"><span class="mr-2 price-dc">200.000</span><span class="price-sale">$80.00</span> VNĐ</p>
                            </div>
                        </div>
                        <div class="bottom-area d-flex px-3">
                            <div class="m-auto d-flex">
                                <a href="#" class="add-to-cart d-flex justify-content-center align-items-center text-center">
                                    <span><i class="ion-ios-menu"></i></span>
                                </a>
                                <a href="/cart" class="buy-now d-flex justify-content-center align-items-center mx-1">
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
            <div class="col-md-6 col-lg-3 ftco-animate">
                <div class="product">
                    <a href="#" class="img-prod">
                        <img class="img-fluid" src="images/2.jpg" alt="Colorlib Template">
                        <div class="overlay"></div>
                    </a>
                    <div class="text py-3 pb-4 px-3 text-center">
                        <h3><a href="#">Thực Phẩm 2</a></h3>
                        <div class="d-flex">
                            <div class="pricing">
                                <p class="price"><span>300.000</span></p>
                            </div>
                        </div>
                        <div class="bottom-area d-flex px-3">
                            <div class="m-auto d-flex">
                                <a href="/productdetail" class="add-to-cart d-flex justify-content-center align-items-center text-center">
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
            <div class="col-md-6 col-lg-3 ftco-animate">
                <div class="product">
                    <a href="#" class="img-prod">
                        <img class="img-fluid" src="images/3.jpg" alt="Colorlib Template">
                        <div class="overlay"></div>
                    </a>
                    <div class="text py-3 pb-4 px-3 text-center">
                        <h3><a href="#">Thực Phẩm 3</a></h3>
                        <div class="d-flex">
                            <div class="pricing">
                                <p class="price"><span>400.000</span></p>
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
            <div class="col-md-6 col-lg-3 ftco-animate">
                <div class="product">
                    <a href="#" class="img-prod">
                        <img class="img-fluid" src="images/4.jpg" alt="Colorlib Template">
                        <span class="status">30%</span>
                        <div class="overlay"></div>
                    </a>
                    <div class="text py-3 pb-4 px-3 text-center">
                        <h3><a href="#">Thực Phẩm 4</a></h3>
                        <div class="d-flex">
                            <div class="pricing">
                                <p class="price"><span>500.000</span></p>
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
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-lg-3 ftco-animate">
                        <div class="product">
                            <a href="#" class="img-prod">
                                <img class="img-fluid w-100" style="height: 160px;" src="images/trasua.jpg" alt="Colorlib Template">
                                <div class="overlay"></div>
                            </a>
                            <div class="text py-3 pb-4 px-3 text-center">
                                <h3><a href="#">Thực Phẩm 5</a></h3>
                                <div class="d-flex">
                                    <div class="pricing">
                                        <p class="price"><span>120.000</span></p>
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
                    <div class="col-md-6 col-lg-3 ftco-animate">
                        <div class="product">
                            <a href="#" class="img-prod">
                                <img class="img-fluid" src="images/2.jpg" alt="Colorlib Template">
                                <div class="overlay"></div>
                            </a>
                            <div class="text py-3 pb-4 px-3 text-center">
                                <h3><a href="#">Thực Phẩm 5</a></h3>
                                <div class="d-flex">
                                    <div class="pricing">
                                        <p class="price"><span>120.000</span></p>
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
                    <div class="col-md-6 col-lg-3 ftco-animate">
                        <div class="product">
                            <a href="#" class="img-prod">
                                <img class="img-fluid w-100" style="height: 160px;" src="images/banhmi.jpg" alt="Colorlib Template">
                                <div class="overlay"></div>
                            </a>
                            <div class="text py-3 pb-4 px-3 text-center">
                                <h3><a href="#">Thực Phẩm 6</a></h3>
                                <div class="d-flex">
                                    <div class="pricing">
                                        <p class="price"><span>350.000</span></p>
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
                    <div class="col-md-6 col-lg-3 ftco-animate">
                        <div class="product">
                            <a href="#" class="img-prod">
                                <img class="img-fluid" src="images/4.jpg" alt="Colorlib Template">
                                <span class="status">30%</span>
                                <div class="overlay"></div>
                            </a>
                            <div class="text py-3 pb-4 px-3 text-center">
                                <h3><a href="#">Thực Phẩm 7</a></h3>
                                <div class="d-flex">
                                    <div class="pricing">
                                        <p class="price"><span>780.000</span></p>
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
                    <div class="col-md-6 col-lg-3 ftco-animate">
                        <div class="product">
                            <a href="#" class="img-prod">
                                <img class="img-fluid" src="images/4.jpg" alt="Colorlib Template">
                                <span class="status">30%</span>
                                <div class="overlay"></div>
                            </a>
                            <div class="text py-3 pb-4 px-3 text-center">
                                <h3><a href="#">Thực Phẩm 7</a></h3>
                                <div class="d-flex">
                                    <div class="pricing">
                                        <p class="price"><span>780.000</span></p>
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
                    <div class="col-md-6 col-lg-3 ftco-animate">
                        <div class="product">
                            <a href="#" class="img-prod">
                                <img class="img-fluid" src="images/4.jpg" alt="Colorlib Template">
                                <span class="status">30%</span>
                                <div class="overlay"></div>
                            </a>
                            <div class="text py-3 pb-4 px-3 text-center">
                                <h3><a href="#">Thực Phẩm 7</a></h3>
                                <div class="d-flex">
                                    <div class="pricing">
                                        <p class="price"><span>780.000</span></p>
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
                    <div class="col-md-6 col-lg-3 ftco-animate">
                        <div class="product">
                            <a href="#" class="img-prod">
                                <img class="img-fluid" src="images/4.jpg" alt="Colorlib Template">
                                <span class="status">30%</span>
                                <div class="overlay"></div>
                            </a>
                            <div class="text py-3 pb-4 px-3 text-center">
                                <h3><a href="#">Thực Phẩm 7</a></h3>
                                <div class="d-flex">
                                    <div class="pricing">
                                        <p class="price"><span>780.000</span></p>
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
                    <div class="col-md-6 col-lg-3 ftco-animate">
                        <div class="product">
                            <a href="#" class="img-prod">
                                <img class="img-fluid" src="images/4.jpg" alt="Colorlib Template">
                                <span class="status">30%</span>
                                <div class="overlay"></div>
                            </a>
                            <div class="text py-3 pb-4 px-3 text-center">
                                <h3><a href="#">Thực Phẩm 7</a></h3>
                                <div class="d-flex">
                                    <div class="pricing">
                                        <p class="price"><span>780.000</span></p>
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

                    <div class="container">
                        <div class="row mt-5">
                            <div class="col text-center">
                                <div class="block-27">
                                    <ul>
                                        <li><a href="#">&lt;</a></li>
                                        <li class="active"><span>1</span></li>
                                        <li><a href="#">2</a></li>
                                        <li><a href="#">3</a></li>
                                        <li><a href="#">4</a></li>
                                        <li><a href="#">5</a></li>
                                        <li><a href="#">&gt;</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="container">
                        </br>
                        </br>
                        <section class="ftco-section img font-weight-bold" style="background-image: url(images/1.jpg);">
                            <div class="row justify-content-end" style="margin: inherit;">
                                <div class="col-md-6 heading-section ftco-animate deal-of-the-day ftco-animate" style="background: rgba(141, 243, 148, 0.4)">
                                    <span class="subheading">Giá Tốt Cho Bạn</span>
                                    <h2 class="mb-4">Giảm giá trong ngày</h2>

                                    <ul>
                                        <li style="color: black">3 Đùi Gà</li>
                                        <li style="color: black">Lon pepsi</li>
                                        <li style="color: black">1 Phần Gà nướng</li>
                                    </ul>
                                    <h3><a href="#" style="color: black">Compo 3</a></h3>
                                </br>
                                    <span class="price" style="color: red; font-weight:bold" >Giá 500.000 VNĐ <span style="color: black; font-weight:bold"> giờ chỉ có 300.000 VNĐ. <a href="#" style="color: rgb(74, 74, 250); font-weight:bold; background: orange"> Mua ngay</a></span></span>
                                    {{-- <div id="timer" class="d-flex mt-5">
                                        <div class="time" id="days"></div>
                                        <div class="time pl-3" id="hours"></div>
                                        <div class="time pl-3" id="minutes"></div>
                                        <div class="time pl-3" id="seconds"></div>
                                    </div> --}}
                                </div>
                            </div>

                        </section>
                    </div>
                    <section class="ftco-section testimony-section">
                        <div class="container">
                            <div class="row justify-content-center mb-5 pb-3">
                                <div class="col-md-7 heading-section ftco-animate text-center">
                                    <span class="subheading">Thông tin</span>
                                    <h2 class="mb-4">Một vài thông tin cơ bản</h2>
                                </div>
                            </div>
                            <div class="row ftco-animate">
                                <div class="col-md-12">
                                    <div class="carousel-testimony owl-carousel">
                                        <div class="item">
                                            <div class="testimony-wrap p-4 pb-5">
                                                <div class="user-img mb-5" style="background-image: url(images/person_1.jpg)">
                                                    <span class="quote d-flex align-items-center justify-content-center">
                                                        <i class="icon-quote-left"></i>
                                                    </span>
                                                </div>
                                                <div class="text text-center">
                                                    <p class="mb-5 pl-4 line">Giao Hàng Tận Nơi, Món Ăn Ngon Và Rẻ.</p>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <div class="item">
                                            <div class="testimony-wrap p-4 pb-5">
                                                <div class="user-img mb-5" style="background-image: url(images/person_2.jpg)">
                                                    <span class="quote d-flex align-items-center justify-content-center">
                                                        <i class="icon-quote-left"></i>
                                                    </span>
                                                </div>
                                                <div class="text text-center">
                                                    <p class="mb-5 pl-4 line">Thiết kế giao diện thân thiện, hợp mắt mới người dùng.</p>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <div class="item">
                                            <div class="testimony-wrap p-4 pb-5">
                                                <div class="user-img mb-5" style="background-image: url(images/person_3.jpg)">
                                                    <span class="quote d-flex align-items-center justify-content-center">
                                                        <i class="icon-quote-left"></i>
                                                    </span>
                                                </div>
                                                <div class="text text-center">
                                                    <p class="mb-5 pl-4 line">Thao tác chức năng ổn định, giảm thiếu tối đa sự cố không mong muốn</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
            </div>
</section>

                    <hr>
@endsection