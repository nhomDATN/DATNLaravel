@extends('admin/layouts.app')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Nhân Viên</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="home">Trang Chủ</a></li>
                        <li class="breadcrumb-item active">Nhân Viên</li>
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
                                <a href='{{ route('nhanVien.create') }}'>
                                    <button type="button" class="btn btn-block btn-default btn-sm">Thêm</button>
                                </a>
                            </div>
                            <div class="card-tools">
                                <div class="input-group input-group-sm" style="width: 180px;">
                                    <input type="text" name="table_search" class="form-control float-right" id="search" name="search"
                                        placeholder="Tìm kiếm theo CCCD">

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
                                        <th>Tên Nhân Viên</th>
                                        <th>Địa Chỉ</th>
                                        <th>Ngày Sinh</th>
                                        <th>SĐT</th>
                                        <th>CCCD</th>
                                        <th>Lương</th>
                                        <th>Thưởng Tháng</th>
                                        <th>Nơi Làm Việc</th>
                                        <th>Chức Vụ</th>
                                        <th>Trạng Thái</th>
                                        <th>Ngày Tạo</th>
                                        <th>Ngày Cập Nhật</th>
                                        <th>Chỉnh Sửa</th>
                                        <th>Xóa</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php 
                                        $stt = 0;
                                    @endphp
                                    @if(count($lstnv) > 0)
                                        @foreach ($lstnv as $nv)
                                        <tr>
                                            <td>{{ ++$stt }}</td>
                                            <td>{{ $nv->ten_nhan_vien }}</td>
                                            <td>{{ $nv->dia_chi }}</td>
                                            <td>{{ $nv->ngay_sinh }}</td>
                                            <td>{{ $nv->sdt }}</td>
                                            <td>{{ $nv->CCCD }}</td>
                                            <td>{{ $nv->luong }}</td>
                                            <td>{{ $nv->thuong_thang }}</td>
                                            <td>{{ $nv->ma_noi_lam_viec }}</td>
                                            <td>{{ $nv->ten_chuc_vu }}</td>
                                            @if ($nv->trang_thai  == 1)
                                                <td>Hoạt Động</td>
                                            @else
                                                <td>Ngưng Hoạt Động</td>
                                            @endif
                                            <td>{{ $nv->created_at }}</td>
                                            <td>{{ $nv->updated_at }}</td>
                                            <td style=";width: 20px;">
                                                <a href='{{ route('nhanVien.edit', ['nhanVien' => $nv]) }}'>
                                                    <button type="button"
                                                        class="btn btn-default btn-sm checkbox-toggle"><i
                                                            class="fas fa-edit"></i>
                                                    </button>
                                                </a>
                                            </td>
                                            <td style="width: 20px;">
                                                <form method="post"
                                                    action="{{ route('nhanVien.destroy', ['nhanVien' => $nv]) }}">
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
                                                Không tìm thấy nhân viên.
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
            url: '{{ URL::to('searchNhanVien') }}',
            data: {
                'search': $value
            },
            success:function(data){
                $('tbody').html(data);
            }
        });
        $.ajaxSetup({ 
            headers: { 
                'csrftoken' : '{{ csrf_token() }}' 
            } 
        });
    })
    </script>
@endsection