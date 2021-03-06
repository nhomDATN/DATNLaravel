<!DOCTYPE html>
<html lang="en">
<head>
    @php
         $isCart = DB::table('hoa_dons')
        ->where('trang_thai', -1)
        ->where('tai_khoan_id', Session::get('UserId'))
        ->get();
        if(count($isCart) > 0)
            Session::put('cartId', $isCart[0]->id);
        $user = DB::table('tai_khoans')->where('id',Session::get('UserId'))->get();
       
    @endphp
    <title>CKC FASTFOOD</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Amatic+SC:400,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="/css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="/css/animate.css">

    <link rel="stylesheet" href="/css/owl.carousel.min.css">
    <link rel="stylesheet" href="/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="/css/magnific-popup.css">

    <link rel="stylesheet" href="/css/aos.css">

    <link rel="stylesheet" href="/css/ionicons.min.css">

    <link rel="stylesheet" href="/css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="/css/jquery.timepicker.css">


    <link rel="stylesheet" href="/css/flaticon.css">
    <link rel="stylesheet" href="/css/icomoon.css">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/bootstrap/font-awesome.min.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
</head>
@php
    $quantityFoodInCart = DB::table('hoa_dons')
    ->join('chi_tiet_hoa_dons','hoa_don_id','=','hoa_dons.id')
    ->where('hoa_dons.id',Session::get('cartId'))
    ->count('*');
@endphp
<body class="goto-here" id="head">
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
                            <span class="text">ckc_food.dev@email.com</span>
                        </div>
                        @if(empty(Session::get('UserId')))
                        <div class="col-md pr-4 d-flex  align-items-center">

                            <a class="text text-white" href=" {{ route('user.login') }}" > ????ng Nh???p </a>/
                            <a class="text text-white" href="{{ route('register') }}" >????ng K?? </a>
                        </div>
                        @else
                        <div class="col-md pr-4 d-flex  align-items-center">
                            <a href="{{ route('user.info',['id' => Session::get('UserId')]) }}" class="text text-white"><img src="/imageUsers/{{ Session::get('UserPicture') }}" alt="avatar" class="imgUser"></a>
                            <a href="{{ route('user.info',['id' => Session::get('UserId')]) }}" class="text text-white">{{ $user[0]->ho_ten }}</a>/
                            <a class="cookie-logout text text-dark" href="{{ route('user.logout')}}">????ng Xu???t </a>
                        </div>
                        @endif
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
                    <li class="nav-item"><a href="/" class="nav-link" style="font-size: 15px">Trang Ch???</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle"  id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-size: 15px">Mua H??ng</a>
                        <div class="dropdown-menu" aria-labelledby="dropdown04">
                            <a class="dropdown-item" href="{{ route('productpage',['key' => "T???t c???",'page' => 1]) }}" >Mua Th???c Ph???m</a>
                            <a class="dropdown-item" href="/wishlist" >Danh S??ch Y??u Th??ch</a>
                            <a class="dropdown-item" href="{{ route('sale') }}" >??u ????i</a>
                            <a class="dropdown-item" href="{{ route('cart') }}" >Gi??? H??ng</a>
                            <a class="dropdown-item" href="{{ route('checkout') }}" >Thanh To??n</a>
                        </div>
                    </li>
                    <li class="nav-item"><a  href="/about" class="nav-link" style="font-size: 15px">Ch??ng T??i</a></li>
                    <li class="nav-item"><a href="/contact"  class="nav-link" style="font-size: 15px">Li??n H???</a></li>
                    <li class="nav-item "><a href="{{ route('cart') }}"  class="nav-link" style="font-size: 15px"><span class="icon-shopping_cart"></span>[{{ $quantityFoodInCart }}]</a></li>

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
                        <p>Li??n h??? ch??ng t??i qua </p>
                        <ul class="ftco-footer-social list-unstyled float-md-left float-lft mt-5">

                            <li class="ftco-animate"><a href="https://www.facebook.com/profile.php?id=100010403162844"><span class="icon-facebook"></span></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md">
                    <div class="ftco-footer-widget mb-4 ml-md-5">
                        <h2 class="ftco-heading-2">Th???c ????n</h2>
                        <ul class="list-unstyled">
                            <li><a href="{{ route('productpage',['key' => 'G?? R??n','page' => 1]) }}" class="py-2 d-block">G?? Chi??n Gi??n</a></li>
                            <li><a href="{{ route('productpage',['key' => 'Hamburger','page' => 1]) }}" class="py-2 d-block">Hamburger</a></li>
                            <li><a href="{{ route('productpage',['key' => 'B??nh M??','page' => 1]) }}" class="py-2 d-block">B??nh m??</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md">
                    <div class="ftco-footer-widget mb-4">
                        <h2 class="ftco-heading-2">C?? c??u h???i?</h2>
                        <div class="block-23 mb-3">
                            <ul>
                                <li><span class="icon icon-map-marker"></span><span class="text">65 Hu???nh Th??c Kh??ng, B???n Ngh??, Qu???n 1, TP.HCM</span></li>
                                <li><span class="icon icon-phone"></span><span class="text">+84 358 543 210</span></li>
                                <li><span class="icon icon-envelope"></span><span class="text">ckcfood.dev@gmail.cpm</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-center">

                    <p>
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        ????? ??n ???????c l??m b???i L?? C??ng Ti???n - 0306191175 & L?? V??nh T??n - 0306191166
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    </p>
                </div>
            </div>
        </footer>
    </div>


    <div class="goTop">
            <a href="#head" class="mouse-icon" style="background-image:  linear-gradient(red,white);">
                <div class="mouse-wheel"><span class="ion-ios-arrow-up" ></span></div>
            </a> 
    </div>
   
    <!-- loader -->
    <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" /><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00" /></svg></div>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <div class="zalo-chat-widget" data-oaid="3357039300884314541" data-welcome-message="Ch??o b???n! R???t vui khi ???????c h??? tr???b???n!"data-autopopup="0" data-width="350" data-height="420"></div>
    <script src="https://sp.zalo.me/plugins/sdk.js"></script>
    <script src="/js/jquery.min.js"></script>
    <script src="/js/jquery-migrate-3.0.1.min.js"></script>
    <script src="/js/popper.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/jquery.easing.1.3.js"></script>
    <script src="/js/jquery.waypoints.min.js"></script>
    <script src="/js/jquery.stellar.min.js"></script>
    <script src="/js/owl.carousel.min.js"></script>
    <script src="/js/jquery.magnific-popup.min.js"></script>
    <script src="/js/aos.js"></script>
    <script src="/js/jquery.animateNumber.min.js"></script>
    <script src="/js/bootstrap-datepicker.js"></script>
    <script src="/js/scrollax.min.js"></script>
    <script src="/js/main.js"></script>
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
