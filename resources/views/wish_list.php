@extends('layouts.layout')
@section('content')
<div class="hero-wrap hero-bread" style="background-image: url('images/banner-1.jpg');">
    <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
            <div class="col-md-9 ftco-animate text-center">
                <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home</a></span> <span>Wishlist</span></p>
                <h1 class="mb-0 bread">Danh Sách Yêu Thích Của Tôi</h1>
            </div>
        </div>
    </div>
</div>

<section class="ftco-section ftco-cart">
    <div class="container">
        <div class="row">
            <div class="col-md-12 ftco-animate">
                <div class="cart-list">
                    <table class="table ">
                        <thead class="thead-light">
                            <tr class="text-center">
                                <th>&nbsp;</th>
                                <th>Danh Sách Sản Phẩm Yêu Thích</th>
                                <th>&nbsp;</th>
                                <th>Giá</th>
                                <th>Mua Ngay</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="text-center">
                                <td class="product-remove"><a href="#"><span class="ion-ios-close"></span></a></td>

                                <td class="image-prod"><div class="img" style="background-image:url(images/1.jpg);"></div></td>

                                <td class="product-name">
                                    <h3>Thực Phẩm 1</h3>
                                    <ul>
                                        <li>3 Đùi Gà</li>
                                        <li>1 Li Coca</li>
                                    </ul>
                                </td>

                                <td class="price">130.000 đ</td>
                                <td><a class="btn btn-primary text-white"> Mua Ngay </a></td>

                            </tr><!-- END TR-->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection