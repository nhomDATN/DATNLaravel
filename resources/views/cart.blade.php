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
        <form action="/checkout" method="get">
        <div class="row">
            <div class="col-md-12 ftco-animate">
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
                            @if (!empty($lstgiohang))
                            @foreach($lstgiohang as $gh)
                            <tr class="text-center">
                                <td class="product-remove"><a href="#"><span class="ion-ios-close"></span></a></td>

                                <td class="image-prod"><div class="img" style="background-image:url('{{ asset("/images/$gh->hinh") }}');"></div></td>

                                <td class="product-name">
                                    <h3>@php echo $gh->ten_san_pham @endphp</h3>
                                    <p>@php
                                        $mo_ta = explode('.',$gh->mo_ta);
                                        echo $mo_ta[0] . '.';
                                    @endphp</p>
                                    {{-- <p>Hamburger là một loại thức ăn bao gồm bánh mì kẹp thịt xay (thường là thịt bò) ở giữa.</p> --}}
                                </td>

                                {{-- <td class="price" name="price" id="price @php echo $gh->id @endphp">@php echo number_format($gh->gia, 0, ",", ".") @endphp</td> --}}
                                <td class="price" name="price" id="price @php echo $gh->id @endphp">@php echo $gh->gia @endphp</td>
                                <td class="quantity">
                                    <div class="input-group mb-3">
                                        <input type="text" name="quantity" class="quantity" value="1" min="1" max="100" id="@php echo $gh->id @endphp" onclick="sum(@php echo $gh->id @endphp)">
                                    </div>
                                </td>
                                
                                {{-- <div class="buttons_added">
                                    <input class="minus is-form" type="button" value="-">
                                    <input aria-label="quantity" class="input-qty" max="Số tối đa" min="Số tối thiểu" name="" type="number" value="">
                                    <input class="plus is-form" type="button" value="+">
                                </div> --}}
                                <input type="hidden" value="1" name="taikhoanid">
                                <td class="total" id="total @php echo $gh->id @endphp" onclick="checkout(@php echo $gh->id @endphp)">@php echo $gh->gia @endphp</td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        </br>
        <p style="text-align: center"><button type="submit" class="btn btn-primary py-3 px-4">Thanh Toán Ngay</button></p>
        </form>
    </div>
</section>
<script type="text/javascript">
    
    let total, checkout;
        function sum(id){
            var quantity = document.getElementById(id);
            $(quantity).on('keyup',function(){
                var quantity = document.getElementById(id).value;
                var price = document.getElementById('price '+id).innerHTML;
                total = document.getElementById('total '+ id);
                total.innerHTML = quantity * price;
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
                
            });
        }   

</script>

{{-- <script>
    $('input.input-qty').each(function() {
      var $this = $(this),
        qty = $this.parent().find('.is-form'),
        min = Number($this.attr('min')),
        max = Number($this.attr('max'))
      if (min == 0) {
        var d = 0
      } else d = min
      $(qty).on('click', function() {
        if ($(this).hasClass('minus')) {
          if (d > min) d += -1
        } else if ($(this).hasClass('plus')) {
          var x = Number($this.val()) + 1
          if (x <= max) d += 1
        }
        $this.attr('value', d).val(d)
      })
    })
 </script> --}}
@endsection