@extends('layouts.layout')
@section('content')
<div class="hero-wrap hero-bread" style="background-image: url('images/banner-3.png');">
    <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
            <div class="col-md-9 ftco-animate text-center">
                <div style="background-color: rgba(212, 243, 212, 0.5);">   
                    <h1 class="mb-0 bread" style="font-size: 35px; color: rgb(87, 247, 93)">Blog</h1>
                </div>
            </div>
        </div>
    </div>
</div>
<section class="ftco-section ftco-degree-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 ftco-animate">
                <div class="row">
                    @foreach ($lstsp as $sp)
                    <div class="col-md-12 d-flex ftco-animate">
                        <div class="blog-entry align-self-stretch d-md-flex">
                            <a href="/blogdetail" class="block-20" style="background-image: url('{{ asset("/images/$sp->hinh") }}');">
                            </a>
                            <div class="text d-block pl-md-4">
                                <div class="meta mb-3">
                                    <div style="color: black; font-size: 15px">@php echo $sp->created_at @endphp</div>
                                    <div style="color: black; font-size: 15px">Quản Trị Viên</div>
                                    {{-- <div><a href="#" class="meta-chat"><span class="icon-chat"></span>3</a></div> --}}
                                </div>
                                <h3 class="heading"><a href="#">@php echo $sp->ten_san_pham @endphp</a></h3>
                                
                                <p>@php 
                                    $mo_ta =  explode(".",$sp->mo_ta);
                                    echo $mo_ta[0] . '...';
                                @endphp</p>
                                <p><a href="/blogdetail" class="btn btn-primary py-2 px-3">Đọc thêm</a></p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div> 
            <!-- .col-md-8 -->

            <div class="col-lg-4 sidebar ftco-animate">
                <div class="sidebar-box">
                    <form action="#" class="search-form">
                        <div class="form-group">
                            <span class="icon ion-ios-search"></span>
                            <input type="text" class="form-control" placeholder="Search...">
                        </div>
                    </form>
                </div>
                @php
                    $dem_thuc_an = 0;
                    $dem_thuc_uong = 0;
                @endphp
                @foreach ($lstsp as $sp)
                    @if ($sp->loai_san_pham_id == 1)
                        @php
                            $dem_thuc_an += 1;
                        @endphp  
                    @elseif ($sp->loai_san_pham_id == 2)
                        @php
                            $dem_thuc_uong += 1;
                        @endphp
                    @endif
                @endforeach
                <div class="sidebar-box ftco-animate">
                    <h3 class="heading">Loại</h3>
                    <ul class="categories">
                        <li><a href="/product">Thức ăn <span style="font-size: 15px; color:black">@php echo ($dem_thuc_an) @endphp</span></a></li>
                        <li><a href="/product">Thức uống<span style="font-size: 15px; color:black">@php echo ($dem_thuc_uong) @endphp</span></a></li>
                    </ul>
                </div>

                {{-- <div class="sidebar-box ftco-animate">
                    <h3 class="heading">Blog gần đây</h3>
                    
                    <div class="block-21 mb-4 d-flex">
                        <a class="blog-img mr-4" style="background-image: url(images/hamburger.jpg);"></a>
                        <div class="text">
                            <h3 class="heading-1"><a href="#">@php echo $mo_ta[0] @endphp</a></h3>
                            <div class="meta">
                                <div><a href="#"><span class="icon-calendar"></span> Tháng 12 09, 2021</a></div>
                                <div><a href="#"><span class="icon-person"></span> Quản Trị Viên</a></div>
                                <div><a href="#"><span class="icon-chat"></span> 19</a></div>
                            </div>
                        </div>
                    </div>
                    <div class="block-21 mb-4 d-flex">
                        <a class="blog-img mr-4" style="background-image: url(images/khoaitaychien.jpg);"></a>
                        <div class="text">
                            <h3 class="heading-1"><a href="#">Khoai Tây Chiên là khoai phải có bề ngoài giòn, nhưng phần ruột nóng, mềm bên trong - một sự kết hợp tuyệt vời được tạo thành khi khoai tây được đổ vào chảo dầu nóng.</a></h3>
                            <div class="meta">
                                <div><a href="#"><span class="icon-calendar"></span> Tháng 12 09, 2021</a></div>
                                <div><a href="#"><span class="icon-person"></span> Quản Trị Viên</a></div>
                                <div><a href="#"><span class="icon-chat"></span> 19</a></div>
                            </div>
                        </div>
                    </div>

                    <div class="sidebar-box ftco-animate">
                        <h3 class="heading">Các Thẻ</h3>
                        <div class="tagcloud">
                            <a href="#" class="tag-cloud-link">Hamburger</a>
                            <a href="#" class="tag-cloud-link">Gà Rán</a>
                            <a href="#" class="tag-cloud-link">Bánh Mì</a>
                            <a href="#" class="tag-cloud-link">Khoai Tây Chiên</a>
                        </div>
                    </div>

                    <div class="sidebar-box ftco-animate">
                        <h3 class="heading">Đoạn văn</h3>
                        <p>Hỗ trợ cho việc bạn có thể tìm hiểu thêm về các loại thức ăn có trên web!</p>
                    </div>
                </div> --}}

            </div>
        </div>
    </div>
</section>
@endsection