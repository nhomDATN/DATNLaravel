<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>CKC FastFood | Forgot Password</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('storage/assets/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{ asset('storage/assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('storage/assets/dist/css/adminlte.min.css') }}">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="/"><b>Xác thực tài khoản |</b>CKC FastFood</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Bạn chưa xác thực tài khoản? Vui lòng nhập email để xác thực tài khoản của bạn!.</p>

      <form action="{{ route('sendMailVerifyAccount') }}" method="get">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        @if(session()->has('success'))
        <div class="alert alert-success">
          {{ session()->get('success') }}
        </div>
        @endif
        @if(session()->has('fail'))
        <div class="alert alert-danger">
          {{ session()->get('fail') }}
        </div>
        @endif
        <div class="input-group mb-3">
          <input type="email" class="form-control" placeholder="Email" name="EmailAddress" required >
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block" >Yêu Cầu Xác Thực Tài Khoản</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <p class="mt-3 mb-1">
        <a href="{{ route('user.login') }}">Quay lại đăng nhập</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
</body>
</html>
