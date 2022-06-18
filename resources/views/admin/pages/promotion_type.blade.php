@extends('admin/layouts.app')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Loại Khuyến Mãi</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="home">Trang Chủ</a></li>
                            <li class="breadcrumb-item active">Loại Khuyến Mãi</li>
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
                                    <a href='{{ route('loaiKhuyenMai.create') }}'>
                                        <button type="button" class="btn btn-block btn-default btn-sm">Thêm</button>
                                    </a>
                                </div>
                                <div class="card-tools">
                                    <div class="input-group input-group-sm" style="width: 210px;">
                                        <input type="text" name="table_search" class="form-control float-right" id="search" name="search"
                                            placeholder="Tìm kiếm theo tên loại khuyến mãi">

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
                                            <th>Loại Khuyến Mãi</th>
                                            <th>Ngày Tạo</th>
                                            <th>Ngày Cập Nhật</th>                            
                                            <th>Chỉnh Sửa</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $stt = 0;
                                        @endphp
                                        @if(count($lstlkm) > 0)
                                            @foreach ($lstlkm as $lkm)
                                                <tr>
                                                    <td>{{ ++$stt }}</td>
                                                    <td>{{ $lkm->ten_loai_khuyen_mai }}</td>
                                                    <td>{{ $lkm->created_at }}</td>
                                                    <td>{{ $lkm->updated_at }}</td>

                                                    <td style=";width: 20px;">
                                                        <a href='{{ route('loaiKhuyenMai.edit', ['loaiKhuyenMai' => $lkm]) }}'>
                                                            <button type="button"
                                                                class="btn btn-default btn-sm checkbox-toggle"><i
                                                                    class="fas fa-edit"></i>
                                                            </button>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                        <tr>
                                            <td colspan="100" class="text-center" style="font-style: italic;font-weight: bold;color: #4f5962;">
                                                Không tìm thấy loại khuyến mãi.
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
        $('#search').on('keyup',function(){
            $value = $(this).val();
            $.ajax({
                type: 'get',
                url: '{{ URL::to('searchLoaiKhuyenMai') }}',
                data: {
                    'search': $value
                },
                success:function(data){
                    $('tbody').html(data);
                }
            });
            
        })
        $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
    </script>
@endsection
