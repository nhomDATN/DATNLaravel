<!DOCTYPE html>
<html>
<head>
    @php
    $admin = DB::table('tai_khoans')->where('id',Session::get('AdminId'))->get();
    $img = $admin[0]->hinh_anh;
@endphp
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
    <title>CKC FASTFOOD</title>
</head>

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
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ route('homeadmin') }}" class="nav-link">Trang Chủ</a>
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
        <aside class="main-sidebar sidebar-dark-primary elevation-4 bg-red">
            <!-- Brand Logo -->
            <a href="{{ route('homeadmin') }}" class="brand-link">
                <span class="brand-text font-weight-light">Admin CKC FastFood</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <a href=""> <img src="{{ asset("/../../../imageUsers/$img") }}" class="img-circle elevation-2"
                            alt="User Image"></a>
                            {{ $admin[0]->ho_ten }}
                          <a href="{{ route('AdminLogout') }}" style="margin-left:  10px;">Đăng xuất</a> 
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">
                            @auth
                                {{ Auth::user()->hoten }}
                            @endauth
                        </a>
                    </div>
                </div>
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <li class="nav-item">
                        <li class="nav-item">
                            <a href="{{ route('loaiTaiKhoan.index') }}" class="nav-link">
                                <i class="nav-icon fas fa-user"></i>
                                <p>
                                    Loại Tài Khoản
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('taiKhoan.index') }}" class="nav-link">
                                <i class="nav-icon fas fa-user-tag"></i>
                                <p>
                                    Tài Khoản
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('loaiSanPham.index') }}" class="nav-link">
                                <i class="nav-icon fas fa-bold"></i>
                                <p>
                                    Loại Sản Phẩm
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('sanpham.adminShow') }}" class="nav-link">
                                <i class="nav-icon fas fa-palette"></i>
                                <p>
                                    Sản Phẩm
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('nguyenLieu.index') }}" class="nav-link">
                                <i class="nav-icon fas fa-hamburger"></i>
                                <p>
                                    Nguyên Liệu
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('noiLamViec.index') }}" class="nav-link">
                                <i class="nav-icon fas fa-home"></i>
                                <p>
                                    Nơi Làm Việc
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('nhanVien.index') }}" class="nav-link">
                                <i class="nav-icon fas fa-user-tie"></i>
                                <p>
                                    Nhân Viên
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/invoice" class="nav-link">
                                <i class="nav-icon fas fa-file-invoice-dollar"></i>
                                <p>
                                    Hóa Đơn
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('danhGia.index') }}" class="nav-link">
                                <i class="nav-icon fas fa-star"></i>
                                <p>
                                    Đánh Giá 
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('binhLuan.index') }}" class="nav-link">
                                <i class="nav-icon fas fa-comment"></i>
                                <p>
                                    Bình Luận
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('chucVu.index') }}" class="nav-link">
                                <i class="nav-icon fas fa-user-cog"></i>
                                <p>
                                    Chức Vụ
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('loaiKhuyenMai.index') }}" class="nav-link">
                                <i class="nav-icon fas fa-gift"></i>
                                <p>
                                    Loại Khuyến Mãi
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('khuyenMai.index') }}" class="nav-link">
                                <i class="nav-icon fas fa-gift"></i>
                                <p>
                                    Khuyến Mãi
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('donViTinh.index') }}" class="nav-link">
                                <i class="fas fa-balance-scale"></i>
                                <p>
                                    Đơn Vị Tính
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('phanPhoi.index') }}" class="nav-link">
                                <i class="fas fa-balance-scale"></i>
                                <p>
                                    Phân Phối
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
    
</body>

</html>
