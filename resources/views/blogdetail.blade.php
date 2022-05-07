@extends('layouts.layout')
@section('content')
<div class="hero-wrap hero-bread" style="background-image: url('images/banner-2.png');">
    <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
            <div class="col-md-9 ftco-animate text-center">
                <div style="background-color: rgba(212, 243, 212, 0.5);">
                    <h1 class="mb-0 bread" style="font-size: 35px; color: rgb(87, 247, 93)">Blog Detail</h1>
                </div>
            </div>
        </div>
    </div>
</div>

<section class="ftco-section ftco-degree-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 ftco-animate">
                @php
                    $dem = 0;
                @endphp
                @foreach ($lstsp as $sp)
                <div class="col-lg-8 ftco-animate">
                    <h2 class="mb-3" style="color: red">@php
                        $dem += 1;
                         echo  '#' . $dem. '. ' . $sp->ten_san_pham; 
                         
                         @endphp</h2>
                    <p style="color: black; font-size:18px">@php 
                        $mo_ta =  explode(".",$sp->mo_ta);
                        echo $mo_ta[0].'.';
                    @endphp</p>
                    <p>
                        <img src="{{ asset("/images/$sp->hinh") }}" alt="" class="img-fluid">
                    </p>
                    <p style="color: black; font-size:18px">@php 
                        $mo_ta =  explode(".",$sp->mo_ta);
                        echo $mo_ta[1]. '.' .'<br />'.'<br />';
                        
                        echo $mo_ta[2]. '.'.'<br />'.'<br />';
                            
                        echo $mo_ta[3];
                    @endphp</p>
                    <!-- -->
                </div>
                @endforeach

                {{-- <div class="about-author d-flex p-4 bg-light">
                    <div class="bio align-self-md-center mr-4">
                        <img src="images/person_1.jpg" alt="Image placeholder" class="img-fluid mb-4">
                    </div>
                    <div class="desc align-self-md-center">
                        <h3>Quản Trị Viên</h3>
                        <p>Đối với tôi, điều thú vị nhất là được thưởng thức những món ăn mà mình yêu thích. Trong số các món ăn yêu thích của tôi, không thể không kể tới các món ăn nhanh như Gà Rán, Hamburger, Bánh Mì và Khoai Tây Chiên.</p>
                    </div>
                </div> --}}
                <!-- -->

                {{-- <div class="pt-5 mt-5">
                    <h3 class="mb-5">6 Bình Luận</h3>
                    <ul class="comment-list">
                        <li class="comment">
                            <div class="vcard bio">
                                <img src="images/person_1.jpg" alt="Image placeholder">
                            </div>
                            <div class="comment-body">
                                <h3>User 1</h3>
                                <div class="meta">Tháng 12 5 2021</div>
                                <p>Những món ăn nhanh khá hợp với một người bận công việc và khá ít thời gian rảnh để chuẩn bị món ăn, vì thế món ăn nhanh giúp tôi có được bữa ăn ngon và còn nạp lượng calo lớn để tiếp tục làm việc.</p>
                            </div>   
                        </li>
                    </ul>
                    <!-- END comment-list -->
                    <div class="comment-form-wrap pt-5">
                        <h3 class="mb-5">Để lại bình luận</h3>
                        <form action="#" class="p-5 bg-light">
                            <div class="form-group">
                                <label for="name">Tên *</label>
                                <input type="text" class="form-control" id="name">
                            </div>
                            <div class="form-group">
                                <label for="email">Email *</label>
                                <input type="email" class="form-control" id="email">
                            </div>
                            <div class="form-group">
                                <label for="message">Nội dung tin nhắn</label>
                                <textarea name="" id="message" cols="30" rows="10" class="form-control"></textarea>
                            </div>
                            <div class="form-group">
                                <input type="submit" value="Đăng bình luận" class="btn py-3 px-4 btn-primary">
                            </div>
                        </form>
                    </div>
                </div> --}}
            </div> 
            <!-- .col-md-8 -->


            <div class="col-lg-4 sidebar ftco-animate">
                <div class="sidebar-box">
                    <form action="#" class="search-form">
                        <div class="form-group">
                            <span class="icon ion-ios-search"></span>
                            <input type="text" class="form-control" placeholder="Search...">
                        </div>
                    </form>
                </div>
                @php
                    $dem_thuc_an = 0;
                    $dem_thuc_uong = 0;
                @endphp
                @foreach ($lstsp as $sp)
                    @if ($sp->loai_san_pham_id == 1)
                        @php
                            $dem_thuc_an += 1;
                        @endphp  
                    @elseif ($sp->loai_san_pham_id == 2)
                        @php
                            $dem_thuc_uong += 1;
                        @endphp
                    @endif
                @endforeach
                <div class="sidebar-box ftco-animate">
                    <h3 class="heading">Loại</h3>
                    <ul class="categories">
                        <li><a href="/product">Thức ăn <span style="font-size: 15px; color:black">@php echo ($dem_thuc_an) @endphp</span></a></li>
                        <li><a href="/product">Thức uống<span style="font-size: 15px; color:black">@php echo ($dem_thuc_uong) @endphp</span></a></li>
                    </ul>
                </div>

                {{-- <div class="sidebar-box ftco-animate">
                    <h3 class="heading">Blog gần đây</h3>
                    <div class="block-21 mb-4 d-flex">
                        <a class="blog-img mr-4" style="background-image: url(images/image_1.jpg);"></a>
                        <div class="text">
                            <h3 class="heading-1"><a href="#">Món ăn nhanh Hamburger là một loại thức ăn bao gồm bánh mì kẹp thịt xay (thường là thịt bò) ở giữa.</a></h3>
                            <div class="meta">
                                <div><a href="#"><span class="icon-calendar"></span> Tháng 12 09, 2021</a></div>
                                <div><a href="#"><span class="icon-person"></span> Quản Trị Viên</a></div>
                                <div><a href="#"><span class="icon-chat"></span> 19</a></div>
                            </div>
                        </div>
                    </div>
                    <div class="block-21 mb-4 d-flex">
                        <a class="blog-img mr-4" style="background-image: url(images/image_2.jpg);"></a>
                        <div class="text">
                            <h3 class="heading-1"><a href="#">Khoai Tây Chiên là khoai phải có bề ngoài giòn, nhưng phần ruột nóng, mềm bên trong - một sự kết hợp tuyệt vời được tạo thành khi khoai tây được đổ vào chảo dầu nóng.</a></h3>
                            <div class="meta">
                                <div><a href="#"><span class="icon-calendar"></span> Tháng 12 09, 2021</a></div>
                                <div><a href="#"><span class="icon-person"></span> Quản Trị Viên</a></div>
                                <div><a href="#"><span class="icon-chat"></span> 19</a></div>
                            </div>
                        </div>
                    </div>
                </div> --}}

                <div class="sidebar-box ftco-animate">
                    <h3 class="heading">Tag Cloud</h3>
                    <div class="tagcloud">
                        <a href="#" class="tag-cloud-link">Hamburger</a>
                        <a href="#" class="tag-cloud-link">Gà Rán</a>
                        <a href="#" class="tag-cloud-link">Bánh Mì</a>
                        <a href="#" class="tag-cloud-link">Khoai Tây Chiên</a>
                    </div>
                </div>

                <div class="sidebar-box ftco-animate">
                    <h3 class="heading">Các Thẻ</h3>
                    <p>Hỗ trợ cho việc bạn có thể tìm hiểu thêm về các loại thức ăn có trên web!</p>
                </div>
            </div>

        </div>
    </div>
</section>
{{-- <script type="text/javascript">
    $flag = <?php echo "'I" . request()->has('view') ."I'" ?>;
    if ($flag == "II") {
        $flag = 1;
    } else {
        $flag = 0;
    }
    $('#search').on('keyup', function() {
        $value = $(this).val();
        $.ajax({
            type: 'get',
            url: '{{ URL::to('searchSanPham') }}',
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
</script> --}}
@endsection