<!DOCTYPE html>
<html>
<head>
    <meta name="_token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('/../../../storage/assets/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
        href="{{ asset('/../../../storage/assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('/../../../storage/assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ asset('/../../../storage/assets/plugins/jqvmap/jqvmap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('/../../../storage/assets/dist/css/adminlte.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('/../../../storage/assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('/../../../storage/assets/plugins/daterangepicker/daterangepicker.css') }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('/../../../storage/assets/plugins/summernote/summernote-bs4.min.css') }}">

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="{{ asset('/../../../storage/assets/plugins/chart.js/Chart.min.js') }}"></script>
    <title>CKC Fast Food</title>
</head>
<style>
    .modal{
        z-index: 10000000;
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height:100%;
        background-color:rgb(0, 0, 0,0.5);
        align-items: center;
        text-align: center;
        justify-content: center;
        
    }
    .form-comment
    {
        padding: 12px 24px;
        width: 500px;
        height: 500px;
        background: white;
        border-radius: 30px;
    }
    .form-header span {
        cursor: pointer;
    }
    .form-header{
        display: flex;
        justify-content: space-between;
        flex-direction: row;
        align-content: center;
        text-align: center;
    }
    .form-body textarea{
        margin-top: 20px;
        padding: 8px;
        outline: none;
        border:solid 1px rgb(0, 0, 0,0.5);
    }
    .form-footer{
       display: flex;
       flex-direction: row;
       text-align: end;
       align-content: center;
       justify-content: end;
    }
    .form-footer p,.form-footer button{
        color:white;
        border-radius: 4px;
        border: solid 1px rgb(0, 0, 0,0.5);
        margin: 5px;
        padding: 5px 8px;
    }
    .form-footer p
    {
        cursor: pointer;
        background: red;
        color: white;
    }
    .form-footer p:hover
    {
        border: solid 1px red;
        background: white;
        color: red;
    }
    .form-footer button
    {
        background: blue;
        color: white;
    }
    .form-footer button:hover
    {
        border: solid 1px blue;
        background: white;
        color: blue;
    }
    .get-star
    {
        display: flex;
        flex-direction: row;
    }
    .get-star i
    {
        cursor: pointer;
    }
</style>
<body class="hold-transition sidebar-mini layout-fixed">
    <div class='wrapper'>
        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="{{ asset('/../../../storage/assets/dist/img/AdminLTELogo.png') }}" alt="AdminLTELogo"
                height="60" width="60">
        </div>
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->
        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="home" class="brand-link">
                <span class="brand-text font-weight-light">Admin CKC FastFood</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <li class="nav-item">
                        <li class="nav-item">
                            <a href="{{ route('user.info',['id'=>Session::get('UserId')]) }}" class="nav-link">
                                <i class="nav-icon fas fa-user"></i>
                                <p>
                                    Thông tin người dùng
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('user.info.update_info',['id'=>Session::get('UserId')]) }}" class="nav-link">
                                <i class="nav-icon fas fa-wrench"></i>
                                <p>
                                    Cập nhật thông tin
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('user.info.replace_password',['id'=>Session::get('UserId')]) }}" class="nav-link">
                                <i class="nav-icon fas fa-key"></i>
                                <p>
                                    Đổi mật khẩu
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('user.info.history_order',['id' => Session::get('UserId')]) }}" class="nav-link">
                                <i class="nav-icon fas fa-history"></i>
                                <p>
                                    Lịch sử đặt hàng
                                </p>
                            </a>
                        </li>
                       
                        <li class="nav-item">
                            <a href="{{ route('user.logout') }}" class="nav-link">
                                <i class="nav-icon fas fa-sign-out-alt"></i>
                                <p>
                                    Đăng xuất
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('homeuser') }}" class="nav-link">
                                <i class="nav-icon fas fa-reply"></i>
                                <p>
                                    Về lại trang chủ
                                </p>
                            </a>
                        </li>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>
        @yield('content')

    </div>
    <footer class="main-footer">
        Sản phẩm được phát triển bởi <strong>Lê Công Tiến</strong> và <strong>Lê Vĩnh Tân</strong>
        <div class="float-right d-none d-sm-inline-block">
            <b>Trang Quản Lý</b>
        </div>
    </footer>
    <script>
        const currentLocation = location.href;
            const menuItem = document.querySelectorAll('a.nav-link');
            const menuLength = menuItem.length;
            for (let i = 0; i < menuLength; i++) {
                if (menuItem[i].href == currentLocation) {
                    c = menuItem[i].childNodes;
                    c[1].className = "far fa-check-circle nav-icon";
                }
            }
    </script>
    <!-- jQuery -->
    <script src="{{ asset('/../../../storage/assets/plugins/jquery/jquery.min.js') }}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('/../../../storage/assets/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('/../../../storage/assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- ChartJS -->
    
    <!-- Sparkline -->
    <script src="{{ asset('/../../../storage/assets/plugins/sparklines/sparkline.js') }}"></script>
    <!-- JQVMap -->
    <script src="{{ asset('/../../../storage/assets/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('/../../../storage/assets/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{ asset('/../../../storage/assets/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
    <!-- daterangepicker -->
    <script src="{{ asset('/../../../storage/assets/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('/../../../storage/assets/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('/../../../storage/assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <!-- Summernote -->
    <script src="{{ asset('/../../../storage/assets/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('/../../../storage/assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('/../../../storage/assets/dist/js/adminlte.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('/../../../storage/assets/dist/js/demo.js') }}"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{ asset('/../../../storage/assets/dist/js/pages/dashboard.js') }}"></script>
    <!-- bs-custom-file-input -->
    <script src="{{ asset('/../../../storage/assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    <script>
        $(function() {
            bsCustomFileInput.init();
        });
    </script>
    <div class="modal">
        <div class="form-comment">
            <div class="form-header">
                <p>Đánh giá sản phẩm</p>
                <span id="close">X</span>
            </div>
            <form action="{{ route('comment') }}" method="post">
                @csrf
            <div class="form-body">
                <input type="hidden" name="id" value="">
                <input type="hidden" name="star" value="">
                <div class="get-star" id="list-star">
                    <a ><i class=" ion-ios-star" onclick="getStar(1)" style="color: orange; font-size:24px"> </i></a>
                    <a ><i class=" ion-ios-star" onclick="getStar(2)" style="color: orange; font-size:24px"> </i></a>
                    <a ><i class=" ion-ios-star" onclick="getStar(3)" style="color: orange; font-size:24px"> </i></a>
                    <a ><i class=" ion-ios-star" onclick="getStar(4)" style="color: orange; font-size:24px"> </i></a>
                    <a ><i class=" ion-ios-star" onclick="getStar(5)" style="color: orange; font-size:24px"> </i></a>
                </div>
                <textarea name="danh_gia" cols="57" rows="10" placeholder="Đánh giá của bạn..."></textarea>
            </div>
            <div class="form-footer">
                <p id="closeH">Hủy</p>
                <button type="submit" id="submit">Xác nhận</button>
            </div>
            </form>
        </div>
    </div>
    <script>
       submit.addEventListener('click', function(e) {
        if($('textarea[name="danh_gia"]').val() == "")
        {
            alert('Vui lòng để lại đánh giá của bạn để cho chúng tôi biết để cải thiện, cảm ơn!');
            e.preventDefault();
        }
       })

    </script>
</body>
</html>
