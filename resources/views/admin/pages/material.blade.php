@extends('admin/layouts.app')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Nguyên Liệu</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="home">Trang Chủ</a></li>
                            <li class="breadcrumb-item active">Nguyên Liệu</li>
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
                                <div style="float: right;margin-left:20px;margin-top: -0.3rem;width: 100px;">
                                    <a href='{{ route('nguyenLieu.create') }}'>
                                        <button type="button" class="btn btn-block btn-default btn-sm">Thêm</button>
                                    </a>
                                </div>
                                <div class="card-tools">
                                    <div class="input-group input-group-sm" style="width: 250px;">
                                        <input type="text" name="table_search" class="form-control float-right"
                                            placeholder="Tìm kiếm theo tên nguyên liệu" id="search" name="search">
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
                                            <th>Tên Nguyên Liệu</th>
                                            <th>Đơn Giá</th>
                                            <th>Số Lượng</th>
                                            <th>Đơn Vị Tính</th>
                                            <th>Kho</th>
                                            <th>Trạng Thái</th>
                                            <th>Ngày Tạo</th>
                                            <th>Ngày Sửa</th>
                                            <th>Chỉnh Sửa</th>
                                            <th>Xóa</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $stt = 0;
                                        @endphp
                                        @if (count($lstnguyenlieu) > 0)
                                            @foreach ($lstnguyenlieu as $nguyenlieu)
                                                <tr>
                                                    <td>{{ ++$stt }}</td>
                                                    <td>{{ $nguyenlieu->ten_nguyen_lieu }}</td>
                                                    <td>{{ $nguyenlieu->don_gia }}</td>
                                                    <td>{{ $nguyenlieu->so_luong }}</td>
                                                    <td>{{ $nguyenlieu->ten_don_vi_tinh }}</td>
                                                    <td>{{ $nguyenlieu->ma_noi_lam_viec }}</td>
                                                    @if ($nguyenlieu->trang_thai  == 1)
                                                        <td>Hoạt Động</td>
                                                    @else
                                                        <td>Ngưng Hoạt Động</td>
                                                    @endif
                                                    <td>{{ $nguyenlieu->created_at }}</td>
                                                    <td>{{ $nguyenlieu->updated_at }}</td>
                                                    <td style=";width: 20px;">
                                                        <a href='{{ route('nguyenLieu.edit', ['nguyenLieu' => $nguyenlieu]) }}'>
                                                            <button type="button"
                                                                class="btn btn-default btn-sm checkbox-toggle"><i
                                                                    class="fas fa-edit"></i>
                                                            </button>
                                                        </a>
                                                    </td>
                                                    <td style="width: 20px;">
                                                        <form method="post"
                                                            action="{{ route('nguyenLieu.destroy', ['nguyenLieu' => $nguyenlieu]) }}">
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
                                                    Không tìm thấy nguyên liệu.
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
                url: '{{ URL::to('searchNguyenLieu') }}',
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
