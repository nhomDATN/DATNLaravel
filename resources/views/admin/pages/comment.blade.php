@extends('admin/layouts.app')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Bình Luận</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="home">Trang Chủ</a></li>
                            <li class="breadcrumb-item active">Bình Luận</li>
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
                                <div class="card-tools">
                                    <div class="input-group input-group-sm" style="width: 200px;">
                                        <input type="text" name="table_search" class="form-control float-right" id="search" name="search"
                                            placeholder="Tìm kiếm theo tên sản phẩm">
                                            
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
                                            <th>Nội Dung</th>
                                            <th>Email</th>
                                            <th>Tên Sản Phẩm</th>
                                            <th>Trạng Thái</th>
                                            <th>Ngày Tạo</th>
                                            <th>Ngày Cập Nhật</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $stt = 0;
                                        @endphp
                                        @if(count($lstbl) > 0)
                                        @foreach ($lstbl as $bl)
                                            <tr>
                                                <td>{{ ++$stt }}</td>
                                                <td>{{ $bl->noi_dung }}</td>
                                                <td>{{ $bl->email }}</td>
                                                <td>{{ $bl->ten_san_pham }}</td>
                                                @if ($bl->trang_thai  == 1)
                                                    <td>Hoạt Động</td>
                                                @else
                                                    <td>Ngưng Hoạt Động</td>
                                                @endif
                                                <td>{{ $bl->created_at }}</td>
                                                <td>{{ $bl->updated_at }}</td>
                                            </tr>
                                        @endforeach
                                        @else
                                        <tr>
                                            <td colspan="100" class="text-center" style="font-style: italic;font-weight: bold;color: #4f5962;">
                                                Không tìm thấy bình luận.
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
                    url: '{{ URL::to('searchBinhLuan') }}',
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
