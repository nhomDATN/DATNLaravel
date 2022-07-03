@extends('layouts.layout')
@section('content')
<div class="hero-wrap hero-bread" style="background-image: url('images/banner-1.jpg');">
</div>

<section class="ftco-section ftco-cart">
    <div class="container">
        @if(count($wishList) == 0)
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center">
                <div class="col-md-9 ftco-animate text-center">
                    <div style="background-color: rgba(212, 243, 212, 0.5);">
                    <h1 class="mb-0 bread" style="font-size: 35px; color: rgb(87, 247, 93)">Danh Sách Yêu Thích Của Tôi</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center">
                <div class="col-md-8 ftco-animate text-center">
                    <div style="background-color: rgba(243, 219, 212, 0.5);">
                        <h1 class="mb-0 bread" style="font-size: 35px; color: rgb(247, 116, 87)">Không Có Sản Phẩm Nào Được Yêu Thích</h1>
                    </div>
                </div>
            </div>
        </div>
        @else
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center">
                <div class="col-md-9 ftco-animate text-center">
                    <div style="background-color: rgba(212, 243, 212, 0.5);">
                    <h1 class="mb-0 bread" style="font-size: 35px; color: rgb(87, 247, 93)">Danh Sách Yêu Thích Của Tôi</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="justify-content-lg-start align-content-center">
                <input type="checkbox" id="deleteCheckBox">
                <label for="delete">Xóa nhiều</label>
            </div>
        </div>
        <form action="{{ route('notLikeAlot') }}" method="get" id="form">
        <div class="container hide" id="container-deleteAll">
            <div class="justify-content-lg-start align-content-center">
                <input type="checkbox" id="deleteAll">
                <label for="deleteAll">Xóa hết</label>
               <button type="button" name="delete" id="trash" style="max-height: 25px;"><i class="icon-delete" style="color: black;"></i></button>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 ftco-animate">
                <div class="cart-list">
                    <table class="table ">
                        <thead class="thead-light">
                            <tr class="text-center">
                                <th>&nbsp;</th>
                                <th>Danh Sách Sản Phẩm Yêu Thích</th>
                                <th>&nbsp;</th>
                                <th>Giá</th>
                                <th>&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($wishList as $item)
                            <tr class="text-center">
                                <td class="product-remove" id="deleteOnly">
                                    <a href="{{ route('notLike',['id'=>$item->id]) }}" id="deleteX"><span class="ion-ios-close"></span></a>
                                </td>
                                <td class="product-removeAll hide" id="deleteAlot">
                                    <input type="checkbox" value="{{ $item->id }}" name="deleteCheck[]">
                                </td>
                                <td class="image-prod"><div class="img" style="background-image:url(images/{{ $item->hinh }});"></div></td>

                                <td class="product-name">
                                    <h3>{{ $item->ten_san_pham }}</h3>
                                    <div  style="display: flex;text-align: start;">
                                        <p>@php 
                                            $mo_ta =  explode(".",$item->mo_ta);
                                            echo $mo_ta[0] . '...';
                                        @endphp</p>
                                    </div>
                                </td>

                                <td class="price">{{ number_format($item->gia, 0, ",", ".") }} VNĐ</td>
                                <td><a href="{{ route('productdetail',['id' => $item->id]) }}" class="btn btn-primary text-white"> Mua Ngay </a></td>

                            </tr><!-- END TR-->
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div> 
        </div>
        @endif
    </form>
    </div>
</section>
<script>
    var deleteCheckBox = $('#deleteCheckBox');
    var container_deleteAll = $('#container-deleteAll');
    var deleteOnly = $('.product-remove');
    var deleteAlot = $('.product-removeAll');
    var checkAll = $('#deleteAll');
    var checkBox = $('input[name="deleteCheck[]"]');
    
    deleteCheckBox.change(function() {
        if(deleteCheckBox.prop('checked'))
        {
            container_deleteAll.removeClass('hide');
            deleteOnly.addClass('hide');
            deleteAlot.removeClass('hide');
        }
        else
        {
            container_deleteAll.addClass('hide');
            deleteOnly.removeClass('hide');
            deleteAlot.addClass('hide');
        }
    });
    checkAll.change(function(){
        var isCheckAll = $(this).prop('checked');
        checkBox.prop('checked',isCheckAll);
    });
    checkBox.change(function(){
        var isCheckedAll = checkBox.length === $('input[name="deleteCheck[]"]:checked').length;
        checkAll.prop('checked',isCheckedAll);
    });
    
    trash.addEventListener('click',function(e){
        console.log('1');
        var length = $('input[name="deleteCheck[]"]:checked').length;
        console.log(length);
        if(length == 0)
        {
            alert('Vui lòng chọn sản phẩm yêu thích bạn cần xóa!');
            e.preventDefault();
            console.log('1');
        }
        else
            form.submit();
    });
</script>
@endsection
