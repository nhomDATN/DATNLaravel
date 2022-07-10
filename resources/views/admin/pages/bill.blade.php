<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <title>PDF</title>
</head>
<style>
    body
    {
        width:100%;
        font-family: DejaVu Sans, sans-serif;
    }
    .container{
        width:100%;
        display: flex;
        text-align: center;
        align-items: center;
        flex-direction: column;
        justify-content: center;
    }
     .header{
        display: flex;
        justify-content: space-around;
        flex-direction: row;
        width: 100%;
    }
    
    .container .time{
        width: 250px;
    }
    table{
        width:100%;
    }
    table tr td{
       text-align: center;
    }
    span{
        font-weight: bold;
    }
    
</style>
<body>
    <div class="container">
        <div class="header">
            <div>
                <h1>CKC FAST FOOD</h1>
                <p>Đ/c: 69 Huỳnh Thúc Kháng, Quận 1, TP.HCM</p>
                <p>Hotline: 0908 123 456</p>
            </div>
        </div>
        <div class="time">
            <p>Ngày bán: {{ explode(' ', $invoice[0]->created_at)[0] }}</p>
        </div>
        
        <div class="body">
            <h2>Hóa Đơn Bán Hàng</h3>
            <h3>{{ $invoice[0]->ma_hoa_don }}</h2>
                <div class="time">
                    <p>Khách hàng: <span> {{ $invoice[0]->nguoi_nhan_hang }}</span></p>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tên sản phẩm</th>
                            <th>Đơn giá</th>
                            <th>Số lượng</th>
                            <th>Thành tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $stt = 0;
                        @endphp
                        @foreach ($invoice_detail as $item)
                        <tr>
                            <td>{{ ++$stt }}</td>
                            <td>{{ $item->ten_san_pham }}</td>
                            <td>{{ number_format($item->gia ,0,',','.') }}</td>
                            <td>{{ $item->so_luong }}</td>
                            <td>{{ number_format($item->gia * $item->so_luong,0,',','.') }} VNĐ</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
        </div>
      
        <hr>
      <div class="footer">
        <div class="checkout">
            <div>
                <p>Phí vận chuyển: @if ($invoice[0]->tong_tien >= 500000)
                    0
                    @else
                    25.000
                @endif</p>
                <p>Tạm tính : {{number_format( $invoice[0]->tong_tien,0,',','.') }}VNĐ</p>
                <p>Chiết khấu : {{ $detail['sale'] }}%</p>
                <p>Voucher sử dụng : {{ $detail['voucher'] }}</p>
                <p>Tiền thanh toán : {{ number_format( $detail['amount'],0,',','.') }}VNĐ</p>
                <p>Phương thức thanh toán : <span>{{ $invoice[0]->phuong_thuc_thanh_toan }}</span>VNĐ</p>
                <p>Mã nhân viên : <span>{{ $invoice[0]->nhan_vien_id }}</span></p>
            </div>
           
            
        </div>
        <h4>Cảm ơn quý khách đã ủng hộ</h4>
      </div>
    </div>
</body>
</html>