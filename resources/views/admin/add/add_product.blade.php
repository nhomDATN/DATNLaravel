@extends('admin.layouts.app')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Add Product</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('sanPham.index') }}">Product</a></li>
                            <li class="breadcrumb-item active">Add Product</li>
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
                            <h3 class="card-title">Form Add Product</h3>
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
                                    <label for="InputFile">H??nh ???nh</label>
                                    <div class="custom-file">
                                      <input type="file" class="custom-file-input" id="customFile" accept="image/*" name="image"required>
                                      <label class="custom-file-label" for="customFile">Ch???n T???p</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">T??n s???n ph???m</label>
                                    <input type="text" class="form-control" name="tensp"
                                        placeholder="T??n s???n ph???m" required>
                                        <p style="color:red;display:none;" id="errorName">Vui l??ng nh???p t??n s???n ph???m!</p>
                                </div>
                                <div class="form-group">
                                    <label for="">M?? t???</label>
                                    <textarea class="form-control" rows="3" placeholder="M?? t??? ..." name="mota" required></textarea>
                                    <p style="color:red;display:none;" id="errorDes">Vui l??ng nh???p m?? t???!</p>
                                </div>
                                <div class="form-group">
                                    <label for="">????n gi??</label>
                                    <input type="number" class="form-control" name="gia"
                                        placeholder="Price Product" min="1000" value="1000">
                                        <p style="color:red;display:none;" id="errorPrice">????n gi?? ph???i l???n h??n 1000!</p>
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
                                    <label for="">Lo???i s???n ph???m</label>
                                    <select class="form-control" name="loaisp">
                                        @foreach ($lstloai as $loai)
                                            <option value="{{ $loai->id }}">
                                                {{ $loai->ten_loai_san_pham }}
                                            </option>
                                        @endforeach
                                      </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Khuy???n m??i s???n ph???m</label>
                                    <select class="form-control" name="khuyenmai" required>
                                        @foreach ($lstKM as $km)
                                            <option value="{{ $km->id }}">
                                                {{ $km->gia_tri .'%'}}
                                            </option>
                                        @endforeach
                                      </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Nguy??n li???u s??? d???ng</label>
                                    <p style="color:red;display:none;" id="errorNL">Vui l??ng ch???n nguy??n li???u cho s???n ph???m!</p>
                                </div>
                                <div class="form-group">
                                    @foreach ($lstNL as $item)
                                    <input type="checkbox" name="listNL[]" value="{{ $item->id }}"> <label> {{ $item->ten_nguyen_lieu }}</label> <br>
                                    @endforeach
                                   
                                </div>
                                <input type="hidden" name="key" value="">
                                <div class="form-group">
                                    <label for="">Keyword t??m ki???m</label>
                                    <div class="form-group">
                                    <textarea name="key" id="" cols="111" rows="5"  placeholder="Nh???p keyword..." required></textarea>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" id="submitForm" class="btn btn-primary" style="width: 100%">Th??m</button>
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
