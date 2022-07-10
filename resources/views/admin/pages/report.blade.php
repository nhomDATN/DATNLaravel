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
    p{
        font-weight: default;
    }
    .container{
        width:100%;
    }
     .header{
        display: flex;
        justify-content: space-between;
        flex-direction: row;
        width: 100%;
    }
    .content{
        text-align: start;
        width: 850px;
    }
    .content h4{
        width: 400px;
        position: relative;
    }
    ul
    {
        display: flex;
        padding: 9px 8px;
        width: 400px;
        position: relative;
        border: solid 1px rgb(0,0,0,0.25);
        text-align: start;
        justify-content: start;
        left: 0;
    }
    ul li{
        list-style: none;
        font-weight: default;
    }
    .container .time{
        text-align: start;
        margin-left: 400px;
    }
    .footer{
        position: relative;
        width: 800px;
        text-align: end;
    }
    .footer p{
        font-style: italic;
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
            <div style="position: relative; float: left;">
                <h2>CKC FASTFOOD</h2>
            </div>
            <div style="position: relative; margin-left: 100px;display: flex;
            text-align: center;
            align-items: center;
            flex-direction: column;
            justify-content: center;">
                <p>CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM</p>
                <p>Độc lập - Tự do - Hạnh phúc</p>
            </div>
        </div>
        <div class="time">
            @php
             $time = explode(' ',$data['time'])[0];
             $time = explode('-',$time);
            @endphp
            <p>HCM, Ngày {{ $time[2] }} tháng {{ $time[1] }} Năm {{ $time[0] }}</p>
        </div>
        
        <div class="body">
            <div style="display: flex;
            text-align: center;
            align-items: center;
            flex-direction: column;
            justify-content: center;">
            <h2>DOANH THU NĂM {{ $time[0] }}</h3>
                <div>
                        <p>Người báo cáo: <span>{{ $data['admin']; }}</span></p>
                </div>
            </div>
            <div class="content">
                <h4>Doanh thu từng tháng:</h4>
                <ul>
                    @php
                        $stt = 1;
                    @endphp
                   @foreach ($data['data'] as $item)
                   <li> Tháng {{ $stt++ }}: {{ $item }}</li>
                   @endforeach
                    <hr>
                    <li>Tổng: <span>{{ array_sum($data['data']); }} VNĐ</span></li>
                    <li>Tháng có thu nhập lớn nhất: <span> Tháng {{ array_search(max($data['data']),$data['data']) + 1; }}</span></li>
                </ul>
            </div>
        </div>
        <hr>
      <div class="footer">
        <div style="position: relative;float: left;display: flex;
        text-align: center;
        align-items: center;
        flex-direction: column;
        justify-content: center;">
            <h4>Giám đốc</h4>
            <p>Ký và ghi rõ họ và tên</p>
        </div>
        <div style="margin-left: 250px;display: flex;
        text-align: center;
        align-items: center;
        flex-direction: column;
        justify-content: center;">
            <h4>Người lập báo cáo</h4>
            <p>Ký và ghi rõ họ và tên</p>
        </div>
      </div>
    </div>
    <script src="{{ asset('/../../../storage/assets/plugins/jquery/jquery.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        innerChart(0);
            function innerChart(data)
            {
            var temp = [0, 30, 0, 0, 20, 0, 0, 0, 0, 0, 0, 0];
            var thang = 0;
            var doanhthutemp = data;
            
            // doanhthutemp.forEach(element => {
                
            //     temp[element.month - 1] = element.doanhthu;
            // });

            var areaChartData = {
                labels  : ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6', 'Tháng 7','Tháng 8','Tháng 9','Tháng 10','Tháng 11','Tháng 12'],
                datasets: [
                    {
                    label               : 'Doanh Thu',
                    backgroundColor     : 'rgba(60,141,188,0.25)',
                    borderColor         : 'rgba(60,141,188,0.8)',
                    pointRadius         : false,
                    pointColor          : '#3b8bba',
                    pointStrokeColor    : 'rgba(60,141,188,0.5)',
                    pointHighlightFill  : '#fff',
                    pointHighlightStroke: 'rgba(60,141,188,1)',
                    data                : [temp[0], temp[1], temp[2], temp[3], temp[4], temp[5], temp[6], temp[7], temp[8], temp[9], temp[10], temp[11] ]
                    },
                ]
            };
            var barChartCanvas = $('#barChart').get(0).getContext('2d');
            var barChartData = $.extend(true, {}, areaChartData);
            var temp0 = areaChartData.datasets[0];
            barChartData.datasets[0] = temp0;
    
            var barChartOptions = {
                responsive              : true,
                maintainAspectRatio     : false,
                datasetFill             : true,
                scales:
                    {
                        y: {
                            beginAtZero: true
                        }
                    }
            };
            new Chart(barChartCanvas, {
                type: 'line',
                data: barChartData,
                options: barChartOptions,
                plugins: 
                    {
                        legend: 
                            {
                                display: false,
                            }
                    },
            });
            }
    </script>
     

</body>
</html>