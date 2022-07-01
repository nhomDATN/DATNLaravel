@extends('admin/layouts.app')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Tài Khoản</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="home">Home</a></li>
                            <li class="breadcrumb-item active">Tài Khoản</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                            {{-- @if (request()->has('view_deleted'))
                                <a href="{{ route('taiKhoan.index') }}" class="btn btn-info"
                                    style="margin-left:20px;margin-top: -0.3rem;">Thông Tin Các Tài Khoản</a>
                                <a href="{{ route('taiKhoan.restore.all', 0) }}" class="btn btn-success"
                                    style="margin-left:20px;margin-top: -0.3rem;">Khôi Phục Tất Cả</a>
                            @else
                                <a href="{{ route('taiKhoan.index', ['view_deleted' => 'DeletedRecords']) }}"
                                    class="btn btn-primary">Thùng Rác</a>
                            @endif --}}
                              
                                <div style="float: right; margin-left: 20px; margin-top: -0.3rem; width: 100px;">
                                    <a href='{{ route('taiKhoan.create') }}'>
                                        <button type="button" class="btn btn-block btn-default btn-sm">Thêm</button>
                                    </a>
                                </div>
                                <div class="card-tools">
                                    <div class="input-group input-group-sm" style="width: 200px;">
                                        <input type="text" name="table_search" class="form-control float-right" id="search"
                                            name="search" placeholder="Tìm kiếm theo email">

                                        <div class="input-group-append">

                                            <button type="submit" class="btn btn-default">
                                                <i class="fas fa-search"></i>
                                            </button>

                                        </div>
                                    </div>
                                </div>

                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0" style="height: 480px;">
                                <table class="table table-head-fixed text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>STT</th>
                                            <th>Email</th>
                                            <th>Ảnh đại diện</th>
                                            <th>Họ tên</th>
                                            <th>Địa chỉ</th>
                                            <th>Ngày sinh</th>
                                            <th>SĐT</th>
                                            <th>Loại Tài Khoản</th>
                                            <th>Trạng Thái</th>
                                            <th>Ngày Tạo</th>
                                            <th>Ngày Cập Nhật</th>
                                            {{-- @if (request()->has('view_deleted'))
                                                <th>Restore</th>
                                            @else --}}
                                            <th>Chỉnh Sửa</th>
                                            <th>Xóa</th>
                                          
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php 
                                            $stt = 0
                                        @endphp
                                        @if (count($lsttk) > 0)
                                            @foreach ($lsttk as $tk)
                                                <tr>
                                                    <td>{{ ++$stt }}</td>
                                                    <td>{{ $tk->email }}</td>
                                                    <td><img src="{{ asset("/imageUsers/$tk->hinh_anh") }}"
                                                        style="width: 100px;"></td>
                                                    <td>{{ $tk->ho_ten }}</td>
                                                    <td>{{ $tk->dia_chi }}</td>
                                                    <td>{{ $tk->ngay_sinh }}</td>
                                                    <td>{{ $tk->sdt }}</td>
                                                    <td>{{ $tk->ten_loai_tai_khoan }}</td>
                                                    @if ($tk->trang_thai  == 1)
                                                        <td style="color:green;">Đang hoạt động</td>
                                                    @elseif ($tk->trang_thai  == 0)
                                                        <td  style="color:red;">Chưa kích hoạt</td>
                                                    @elseif ($tk->trang_thai  == -1)
                                                        <td  style="color:red;">Đã bị khóa</td>
                                                    @endif
                                                    <td>{{ $tk->created_at }}</td>
                                                    <td>{{ $tk->updated_at }}</td>
                                                    
                                                    <td style=";width: 20px;">
                                                        <a href='{{ route('taiKhoan.edit', ['taiKhoan' => $tk]) }}'>
                                                            <button type="button"
                                                                class="btn btn-default btn-sm checkbox-toggle"><i
                                                                    class="fas fa-edit"></i>
                                                            </button>
                                                        </a>
                                                    </td>
                                                    <td style="width: 20px;">
                                                        <form method="post"
                                                            action="{{ route('taiKhoan.destroy', ['taiKhoan' => $tk]) }}">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="btn btn-default btn-sm checkbox-toggle"><i
                                                                    class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="100" class="text-center" style="font-style: italic;font-weight: bold;color: #4f5962;">
                                                    Không tìm thấy tài khoản
                                                </td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
    </div>

    <script type="text/javascript">
        $('#search').on('keyup', function() {
            $value = $(this).val();
                $.ajax({
                    type: 'get',
                    url: '{{ URL::to('searchTaiKhoan') }}',
                    data: {
                        'search': $value
                    },
                    success: function(data) {
                        $('tbody').html(data);
                    }
                });
        })
        $.ajaxSetup({
            headers: {
                'csrftoken': '{{ csrf_token() }}'
            }
        });
    </script>
@endsection