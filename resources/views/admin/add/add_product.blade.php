@extends('admin.layouts.app')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Thêm Sản Phẩm</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('sanPham.index') }}">Sản Phẩm</a></li>
                            <li class="breadcrumb-item active">Thêm Sản Phẩm</li>
                        </ol>
                    </div>
                    <!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">Mẫu Thêm Sản Phẩm</h3>
                        </div>
                        @if(session('alert'))
                        <section class='alert alert-danger'>{{session('alert')}}</section>
                        @endif
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form id="form" method="post" action="{{ route('sanPham.store') }} " enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                {{-- <div class="form-group">
                                    <label for="">ID</label>
                                    <input type="id" class="form-control" id=""
                                        value="2" readonly>
                                </div> --}}
                                <div class="form-group">
                                    <label for="InputFile">Hình Ảnh</label>
                                    <div class="custom-file">
                                      <input type="file" class="custom-file-input" id="customFile" accept="image/*" name="image"required>
                                      <label class="custom-file-label" for="customFile">Chọn Tệp</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">Tên sản phẩm</label>
                                    <input type="text" class="form-control" name="tensp"
                                        placeholder="Tên sản phẩm" required>
                                        <p style="color:red;display:none;" id="errorName">Vui lòng nhập tên sản phẩm!</p>
                                </div>
                                <div class="form-group">
                                    <label for="">Mô tả</label>
                                    <textarea class="form-control" rows="3" placeholder="Mô tả ..." name="mota" required></textarea>
                                    <p style="color:red;display:none;" id="errorDes">Vui lòng nhập mô tả!</p>
                                </div>
                                <div class="form-group">
                                    <label for="">Đơn giá</label>
                                    <input type="number" class="form-control" name="gia"
                                        placeholder="Price Product" min="1000" value="1000">
                                        <p style="color:red;display:none;" id="errorPrice">Đơn giá phải lớn hơn 1000!</p>
                                </div>
                                {{-- <div class="form-group">
                                    <label for="InputFile">File Picture Input</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="InputFile">
                                            <label class="custom-file-label" for="InputFile">Choose file</label>
                                        </div>
                                        <div class="input-group-append">
                                            <span class="input-group-text">Upload</span>
                                        </div>
                                    </div>
                                </div> --}}
                                <div class="form-group">
                                    <label for="">Loại sản phẩm</label>
                                    <select class="form-control" name="loaisp">
                                        @foreach ($lstloai as $loai)
                                            <option value="{{ $loai->id }}">
                                                {{ $loai->ten_loai_san_pham }}
                                            </option>
                                        @endforeach
                                      </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Khuyến mãi sản phẩm</label>
                                    <select class="form-control" name="khuyenmai" required>
                                        @foreach ($lstKM as $km)
                                            <option value="{{ $km->id }}">
                                                {{ $km->gia_tri .'%'}}
                                            </option>
                                        @endforeach
                                      </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Nguyên liệu sử dụng</label>
                                    <p style="color:red;display:none;" id="errorNL">Vui lòng chọn nguyên liệu cho sản phẩm!</p>
                                </div>
                                <div class="form-group">
                                    @foreach ($lstNL as $item)
                                    <input type="checkbox" name="listNL[]" value="{{ $item->id }}"> <label> {{ $item->ten_nguyen_lieu }}</label> <br>
                                    @endforeach
                                   
                                </div>
                                <input type="hidden" name="key" value="">
                                <div class="form-group">
                                    <label for="">Keyword tìm kiếm</label>
                                    <div class="form-group">
                                    <textarea name="key" id="" cols="111" rows="5"  placeholder="Nhập keyword..." required></textarea>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" id="submitForm" class="btn btn-primary" style="width: 100%">Thêm</button>
                            </div>
                        </form>
                    </div>
            </div><!-- /.container-fluid -->
        </section>
    </div>
    <script>
       submitForm.addEventListener('click', function(e){
        var length = $('input[name="listNL[]"]:checked').length;
        if(length == 0)
        {
            $('#errorNL').css('display', 'block');
            e.preventDefault();
        }
        else
        e.submit();
       });
    </script>
@endsection
