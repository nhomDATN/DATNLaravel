@extends('admin/layouts.app')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Loại Sản Phẩm</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="home">Trang Chủ</a></li>
                            <li class="breadcrumb-item active">Loại Sản Phẩm</li>
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
                                <div style="float: right; margin-left: 20px; margin-top: -0.3rem; width: 100px;">
                                    <a href='{{ route('loaiSanPham.create') }}'>
                                        <button type="button" class="btn btn-block btn-default btn-sm">Thêm</button>
                                    </a>
                                </div>
                                <div class="card-tools">
                                    <div class="input-group input-group-sm" style="width: 200px;">
                                        <input type="text" name="table_search" class="form-control float-right" id="search"
                                            name="search" placeholder="Tìm kiếm theo tên loại SP">

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
                                            <th>ID</th>
                                            <th>Tên Loại SP</th>
                                            <th>Hình Ảnh</th>
                                            {{-- <th>Trạng Thái</th> --}}
                                            <th>Ngày Tạo</th>
                                            <th>Ngày Cập Nhật</th>
                                            <th>Chỉnh sửa</th>
                                            <th>Xóa</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($lstloaisp) > 0)
                                            @foreach ($lstloaisp as $lsp)
                                                <tr>
                                                    <td>{{ $lsp->id }}</td>
                                                    <td>{{ $lsp->ten_loai_san_pham }}</td>
                                                    <td><img src="{{ asset("/images/$lsp->hinh_anh") }}"
                                                            style="width: 100px;"></td>
                                                    {{-- <td><img src="{{ asset("/image/' . $lsp->hinh_anh . '") }}" style="width: 100px;"></td> --}}
                                                    {{-- @if ($lsp->trang_thai  == 1)
                                                        <td>Hoạt Động</td>
                                                    @else
                                                        <td>Ngưng Hoạt Động</td>
                                                    @endif --}}
                                                    <td>{{ $lsp->created_at }}</td>
                                                    <td>{{ $lsp->updated_at }}</td>
                                                    <td style=";width: 20px;">
                                                        <a
                                                            href='{{ route('loaiSanPham.edit', ['loaiSanPham' => $lsp]) }}'>
                                                            <button type="button"
                                                                class="btn btn-default btn-sm checkbox-toggle"><i
                                                                    class="fas fa-edit"></i>
                                                            </button>
                                                        </a>
                                                    </td>
                                                    <td style="width: 20px;">
                                                        <form method="post"
                                                            action="{{ route('loaiSanPham.destroy', ['loaiSanPham' => $lsp]) }}">
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
                                                    Không tìm thấy loại SP
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
        $flag = <?php echo "'I" . request()->has('view_deleted') . "I'"; ?>;
        if ($flag == "II") {
            $flag = 1;
        } else {
            $flag = 0;
        }
        $('#search').on('keyup', function() {
            $value = $(this).val();
            if ($flag == 1){
                $.ajax({
                    type: 'get',
                    url: '{{ URL::to('searchLoaiSanPham') }}',
                    data: {
                        'search': $value
                    },
                    success: function(data) {
                        $('tbody').html(data);
                    }
                });
            }
        })
        $.ajaxSetup({
            headers: {
                'csrftoken': '{{ csrf_token() }}'
            }
        });
    </script>
@endsection
