<!DOCTYPE html>
<html lang="en">
<head>
    <title>Index</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Amatic+SC:400,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="css/animate.css">

    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">

    <link rel="stylesheet" href="css/aos.css">

    <link rel="stylesheet" href="css/ionicons.min.css">

    <link rel="stylesheet" href="css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="css/jquery.timepicker.css">


    <link rel="stylesheet" href="css/flaticon.css">
    <link rel="stylesheet" href="css/icomoon.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bootstrap/font-awesome.min.css">
    <style>
        .goTop{
            display: flex;
            justify-content: center;
            width: 55px;
            height: 55px;
            bottom: 120px;
            right: 55px;
            position: fixed;     
            border-radius: 50%;
            align-items: center;
        }
        
    </style>
</head>
<body class="goto-here" id="head" style=" background-image: url(images/background.png);
background-repeat:no-repeat;" >
    <div class="py-1 bg-danger">
        <div class="container">
            <div class="row no-gutters d-flex align-items-start align-items-center px-md-0">
                <div class="col-lg-12 d-block">
                    <div class="row d-flex">
                        <div class="col-md pr-4 d-flex topper align-items-center">
                            <div class="icon mr-2 d-flex justify-content-center align-items-center"><span class="icon-phone2"></span></div>
                            <span class="text">+ 090 000 9999</span>
                        </div>
                        <div class="col-md pr-4 d-flex topper align-items-center">
                            <div class="icon mr-2 d-flex justify-content-center align-items-center"><span class="icon-paper-plane"></span></div>
                            <span class="text">ckc_fastfood@email.com</span>
                        </div>
                        <div class="col-md pr-4 d-flex  align-items-center">

                            <a class="text text-white" href="/login" > Đăng Nhập </a>/
                            <a class="text text-white" href="/register" >Đăng Ký </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <nav class="navbar navbar-expand-lg ftco_navbar ftco-navbar-light" id="ftco-navbar">
        <div class="container">
            <a class="navbar-brand text-danger" href="/" >CKC FastFood</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="oi oi-menu"></span> Menu
            </button>

            <div class="collapse navbar-collapse" id="ftco-nav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active"><a href="/" class="nav-link" style="font-size: 15px">Trang Chủ</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle"  id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-size: 15px">Mua Hàng</a>
                        <div class="dropdown-menu" aria-labelledby="dropdown04">
                            <a class="dropdown-item" href="/product" >Mua Thực Phẩm</a>
                            <a class="dropdown-item" href="/wishlist" >Danh Sách Yêu Thích</a>
                            <a class="dropdown-item" href="/sale" >Ưu Đãi</a>
                            <a class="dropdown-item" href="/cart" >Giỏ Hàng</a>
                            <a class="dropdown-item" href="/checkout" >Thanh Toán</a>
                        </div>
                    </li>
                    <li class="nav-item"><a  href="/about" class="nav-link" style="font-size: 15px">Chúng Tôi</a></li>
                    <li class="nav-item"><a href="/blog"  class="nav-link" style="font-size: 15px">Blog</a></li>
                    <li class="nav-item"><a href="/contact"  class="nav-link" style="font-size: 15px">Liên Hệ</a></li>
                    <li class="nav-item cta cta-colored"><a href="/cart"  class="nav-link" style="font-size: 15px"><span class="icon-shopping_cart"></span>[0]</a></li>

                </ul>
            </div>
        </div>
    </nav>

    <!-- -->
    @yield('content');
    <!-- -->

    <div class="container py-4">
        <footer class="ftco-footer ftco-section">
            <div class="row mb-5">
                <div class="col-md">
                    <div class="ftco-footer-widget mb-4">
                        <h2 class="ftco-heading-2">CKCFastFoods</h2>
                        <p>Liên hệ chúng tôi qua </p>
                        <ul class="ftco-footer-social list-unstyled float-md-left float-lft mt-5">

                            <li class="ftco-animate"><a href="#"><span class="icon-facebook"></span></a></li>
                            <li class="ftco-animate"><a href="#"><span class="icon-instagram"></span></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md">
                    <div class="ftco-footer-widget mb-4 ml-md-5">
                        <h2 class="ftco-heading-2">Thực Đơn</h2>
                        <ul class="list-unstyled">
                            <li><a href="#" class="py-2 d-block">Gà Chiên Giòn</a></li>
                            <li><a href="#" class="py-2 d-block">Cơm</a></li>
                            <li><a href="#" class="py-2 d-block">Hamburger</a></li>
                            <li><a href="#" class="py-2 d-block">Bánh mì</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="ftco-footer-widget mb-4">
                        <h2 class="ftco-heading-2">Hỗ Trợ</h2>
                        <div class="d-flex">
                            <ul class="list-unstyled mr-l-5 pr-l-3 mr-4">
                                <li><a href="#" class="py-2 d-block">Thông tin giao hàng</a></li>
                            </ul>
                            <ul class="list-unstyled">
                                <li><a href="#" class="py-2 d-block">FAQs</a></li>
                                <li><a href="#" class="py-2 d-block">Liên Hệ</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md">
                    <div class="ftco-footer-widget mb-4">
                        <h2 class="ftco-heading-2">Có câu hỏi?</h2>
                        <div class="block-23 mb-3">
                            <ul>
                                <li><span class="icon icon-map-marker"></span><span class="text">65 Huỳnh Thúc Kháng, Bến Nghé, Quận 1, TP.HCM</span></li>
                                <li><a href="#"><span class="icon icon-phone"></span><span class="text">+2 392 3929 210</span></a></li>
                                <li><a href="#"><span class="icon icon-envelope"></span><span class="text">caothang@caothang.edu.vn</span></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-center">

                    <p>
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        Đồ án được làm bởi Lê Công Tiến - 0306191175 & Lê Vĩnh Tân - 0306191166
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    </p>
                </div>
            </div>
        </footer>
    </div>


    <div class="goTop">
            <a href="#head" class="mouse-icon">
                <div class="mouse-wheel"><span class="ion-ios-arrow-up" ></span></div>
            </a> 
    </div>
   
    <!-- loader -->
    <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" /><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00" /></svg></div>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <div class="zalo-chat-widget" data-oaid="1558126983899774468" data-welcome-message="Chào bạn! Rất vui khi được hỗ trợbạn!"data-autopopup="0" data-width="350" data-height="420"></div>
    <script src="https://sp.zalo.me/plugins/sdk.js"></script>
    <script src="js/jquery.min.js"></script>
    <script src="js/jquery-migrate-3.0.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.easing.1.3.js"></script>
    <script src="js/jquery.waypoints.min.js"></script>
    <script src="js/jquery.stellar.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/aos.js"></script>
    <script src="js/jquery.animateNumber.min.js"></script>
    <script src="js/bootstrap-datepicker.js"></script>
    <script src="js/scrollax.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
    <script src="js/google-map.js"></script>
    <script src="js/main.js"></script>
    <script>
        $(document).ready(function(){
            $(window).scroll(function(){
                if($(this).scrollTop())
                {
                    $('.goTop').fadeIn();
                } else{
                    $('.goTop').fadeOut();
                }
            });
        });
    </script>
</body>
</html>
