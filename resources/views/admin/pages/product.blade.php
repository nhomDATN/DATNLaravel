@extends('admin.layouts.app')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Sản phẩm</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="home">Home</a></li>
                            <li class="breadcrumb-item active">Sản phẩm</li>
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
                                    <a href='{{ route('sanPham.create') }}'>
                                        <button type="button" class="btn btn-block btn-default btn-sm">Thêm</button>
                                    </a>
                                </div>
                                <div class="card-tools">
                                    <div class="input-group input-group-sm" style="width: 150px;">
                                        <input type="text" name="table_search" class="form-control float-right"
                                            placeholder="Tìm kiểm với tên" id="search" name="search">
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-default">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-2"style="height: 480px;" id="listProduct">
                                @foreach($lstPD as $item)
                                <div class="card float-left m-1 h-75" style="width:200px" style="float: left;">
                                    <img class="card-img-top" height="200" src="{{ asset("images/$item->hinh") }}" alt="Card image">
                                    <div class="card-body">
                                      <h4 class="card-title">{{ $item->ten_san_pham }}</h4><br><br><br>
                                      <div>
                                        <a href="{{ route('sanpham.detail', ['id' => $item->id]) }}" class="btn btn-primary">Chi tiết</a>
                                        <a href="{{ route('sanpham.destroy',['id'=>$item->id]) }}" class="btn btn-danger">Xóa</a>
                                        <a href="{{ route('sanpham.edit',['id'=>$item->id]) }}"><i class="fas fa-wrench"></i></a>
                                      </div>
                                      </div>
                                    
                                  </div>
                                  @endforeach
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
    </div>
    <script>
 $(document).on('keyup','#search',function(){
            var key = $(this).val();
            $.ajax({
                url: '{{ URL::to('admin/sanpham/search') }}',
                type: 'get',
                data:{
                    keyword: key
                },
                success: function(response)
                {
                    document.getElementById('listProduct').innerHTML = response;
                    
                }
            });

        });
    </script>
@endsection
