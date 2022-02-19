@extends('layouts.layout')
@section('content')
<div class="hero-wrap hero-bread" style="background-image: url('images/banner-3.png');">
    <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
            <div class="col-md-9 ftco-animate text-center">

                <h1 class="mb-0 bread">Blog</h1>
            </div>
        </div>
    </div>
</div>
<section class="ftco-section ftco-degree-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 ftco-animate">
                <div class="row">
                    <div class="col-md-12 d-flex ftco-animate">
                        <div class="blog-entry align-self-stretch d-md-flex">
                            <a href="/blogdetail" class="block-20" style="background-image: url('images/hamburger.jpg');">
                            </a>
                            <div class="text d-block pl-md-4">
                                <div class="meta mb-3">
                                    <div><a href="#">Tháng 12 09, 2021</a></div>
                                    <div><a href="#">Quản Trị Viên</a></div>
                                    <div><a href="#" class="meta-chat"><span class="icon-chat"></span> 3</a></div>
                                </div>
                                <h3 class="heading"><a href="#">Hamburger</a></h3>
                                <p>Món ăn nhanh Hamburger là một loại thức ăn bao gồm bánh mì kẹp thịt xay (thường là thịt bò) ở giữa.</p>
                                <p><a href="/blogdetail" class="btn btn-primary py-2 px-3">Đọc thêm</a></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 d-flex ftco-animate">
                        <div class="blog-entry align-self-stretch d-md-flex">
                            <a href="/blogdetail" class="block-20" style="background-image: url('images/6.jpg');">
                            </a>
                            <div class="text d-block pl-md-4">
                                <div class="meta mb-3">
                                    <div><a href="#">Tháng 12 09, 2021</a></div>
                                    <div><a href="#">Quản Trị Viên</a></div>
                                    <div><a href="#" class="meta-chat"><span class="icon-chat"></span> 3</a></div>
                                </div>
                                <h3 class="heading"><a href="#">Gà Rán</a></h3>
                                <p>Món ăn nhanh Gà Rán là một món ăn xuất xứ từ miền Nam Hoa Kỳ; nguyên liệu chính là những miếng thịt gà đã được lăn bột rồi chiên trên chảo, chiên ngập dầu, chiên áp suất hoặc chiên chân không.</p>
                                <p><a href="/blogdetail" class="btn btn-primary py-2 px-3">Đọc thêm</a></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 d-flex ftco-animate">
                        <div class="blog-entry align-self-stretch d-md-flex">
                            <a href="/blogdetail" class="block-20" style="background-image: url('images/banhmi.jpg');">
                            </a>
                            <div class="text d-block pl-md-4">
                                <div class="meta mb-3">
                                    <div><a href="#">Tháng 12 09, 2021</a></div>
                                    <div><a href="#">Quản Trị Viên</a></div>
                                    <div><a href="#" class="meta-chat"><span class="icon-chat"></span> 3</a></div>
                                </div>
                                <h3 class="heading"><a href="#">Bánh Mì</a></h3>
                                <p>Món ăn nhanh Bánh Mì là một món ăn của Việt Nam, bao gồm vỏ là một ổ bánh mì nướng có da giòn, ruột mềm, bên trong là phần nhân đa dạng, chẳng hạn như: bò kho, cá mòi hay xíu mại.</p>
                                <p><a href="/blogdetail" class="btn btn-primary py-2 px-3">Đọc thêm</a></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 d-flex ftco-animate">
                        <div class="blog-entry align-self-stretch d-md-flex">
                            <a href="/blogdetail" class="block-20" style="background-image: url('images/khoaitaychien.jpg');">
                            </a>
                            <div class="text d-block pl-md-4">
                                <div class="meta mb-3">
                                    <div><a href="#">Tháng 12 09, 2021</a></div>
                                    <div><a href="#">Quản Trị Viên</a></div>
                                    <div><a href="#" class="meta-chat"><span class="icon-chat"></span> 3</a></div>
                                </div>
                                <h3 class="heading"><a href="#">Khoai Tây Chiên</a></h3>
                                <p>Khoai Tây Chiên là khoai phải có bề ngoài giòn, nhưng phần ruột nóng, mềm bên trong - một sự kết hợp tuyệt vời được tạo thành khi khoai tây được đổ vào chảo dầu nóng.</p>
                                <p><a href="/blogdetail" class="btn btn-primary py-2 px-3">Đọc thêm</a></p>
                            </div>
                        </div>
                    </div>
                </div>

            </div> <!-- .col-md-8 -->
            <div class="col-lg-4 sidebar ftco-animate">
                <div class="sidebar-box">
                    <form action="#" class="search-form">
                        <div class="form-group">
                            <span class="icon ion-ios-search"></span>
                            <input type="text" class="form-control" placeholder="Search...">
                        </div>
                    </form>
                </div>
                <div class="sidebar-box ftco-animate">
                    <h3 class="heading">Thể loại</h3>
                    <ul class="categories">
                        <li><a href="#">Hamburger <span>(12)</span></a></li>
                        <li><a href="#">Gà Rán<span>(22)</span></a></li>
                        <li><a href="#">Bánh Mì <span>(37)</span></a></li>
                        <li><a href="#">Khoai Tây Chiên <span>(42)</span></a></li>
                    </ul>
                </div>

                <div class="sidebar-box ftco-animate">
                    <h3 class="heading">Blog gần đây</h3>
                    <div class="block-21 mb-4 d-flex">
                        <a class="blog-img mr-4" style="background-image: url(images/hamburger.jpg);"></a>
                        <div class="text">
                            <h3 class="heading-1"><a href="#">Món ăn nhanh Hamburger là một loại thức ăn bao gồm bánh mì kẹp thịt xay (thường là thịt bò) ở giữa.<</a></h3>
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
                </div>

            </div>
        </div>
    </div>
</section>
@endsection