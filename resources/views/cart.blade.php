@extends('layouts.layout')
@section('content')

<div class="hero-wrap hero-bread" style="background-image: url('images/banner-1.jpg');">
    <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
            <div class="col-md-9 ftco-animate text-center">
                <div style="background-color: rgba(212, 243, 212, 0.5);">
                    <h1 class="mb-0 bread" style="font-size: 35px; color: rgb(87, 247, 93)">Giỏ Hàng Của Tôi</h1>
                </div>
            </div>
        </div>
    </div>
</div>

<section class="ftco-section ftco-cart">
    <div class="container">
        @if (count($lstgiohang) == 0)
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center">
                <div class="col-md-8 ftco-animate text-center">
                    <div style="background-color: rgba(243, 219, 212, 0.5);">
                        <h1 class="mb-0 bread" style="font-size: 35px; color: rgb(247, 116, 87)">Không Có Sản Phẩm Nào Trong Giỏ Hàng</h1>
                    </div>
                </div>
            </div>
        </div>
        @else
        <div class="row">
            <div class="col-md-12 ftco-animate">
                <p></p>
                <div class="cart-list">
                    <table class="table">
                        <thead class="thead-primary bg-danger">
                            <tr class="text-center">
                                <th>&nbsp;</th>
                                <th>&nbsp;</th>
                                <th>Tên sản phẩm</th>
                                <th>Giá</th>
                                <th>Số lượng</th>
                                <th>Tổng</th>
                            </tr>
                        </thead>
                        <tbody>
                           
                            @foreach($lstgiohang as $gh)
                            <tr class="text-center">
                                <td class="product-remove"><a href="{{ route('deleteProductInCart',['id' => $gh->id]) }}"><span class="ion-ios-close"></span></a></td>

                                <td class="image-prod"><div class="img" style="background-image:url('{{ asset("/images/$gh->hinh") }}');"></div></td>

                                <td class="product-name">
                                    <h3>@php echo $gh->ten_san_pham @endphp</h3>
                                    <p>@php
                                        $mo_ta = explode('.',$gh->mo_ta);
                                        echo $mo_ta[0] . '.';
                                    @endphp</p>
                                 </td>

                                @php
                                    $gia_tam =($gh->gia - (($gh->gia * $gh->chiet_khau) / 100));
                                @endphp
                                <td class="price" name="price" id="price @php echo $gh->id @endphp">{{  number_format(($gh->gia - (($gh->gia * $gh->chiet_khau) / 100)),0,',','.') }} VNĐ</td>
                                
                                <td class="quantity">
                                    <div class="input-group mb-3">
                                        <input type="number" name="quantity" class="quantity" value="@php echo $gh->so_luong @endphp" min="1" max="100" id="@php echo $gh->id @endphp" onchange="sum({{ $gh->id}})">
                                    </div>
                                </td>
                                
                                <input type="hidden" value="{{ Session::get('UserId') }}" name="taikhoanid">
                                <td class="total" id="total @php echo $gh->id @endphp" >@php echo number_format(($gh->so_luong * $gia_tam),0,',','.') @endphp VNĐ</td>
                            </tr>
                            @endforeach
                            
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td> <p style="text-align: center"><a href="{{ route('cart') }}" class="btn btn-primary py-3 px-4 text text-white">Cập Nhật Số Lượng</a></p></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        </br>
        <p style="text-align: center"><a href="{{ route('checkout') }}" class="btn btn-primary py-3 px-4">Thanh Toán Ngay</a></p>
    </div>
    @endif
</section>
<script type="text/javascript">
    let total, checkout;
        function sum(id){
                var quantity = document.getElementById(id).value;
                $.ajaxSetup({
                headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'post',
                    url: "{{ URL::to('capNhatSoLuong') }}",
                    data: {
                        id : id,
                        quantity: quantity
                    },
        
                });
        }   

</script>

@endsection
