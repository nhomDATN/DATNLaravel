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
        justify-content: space-between;
        flex-direction: row;
        width: 100%;
    }
    .body .content{
        text-align: start;
        width: 850px;
       
    }
    .body .content ul
    {
        float: left;
        padding: 9px 8px;
        width: 200px;
        position: relative;
        border: solid 1px rgb(0,0,0,0.25);
    }
    .body .content ul li{
        list-style: none;
        
    }
    .container .time{
        text-align: start;
        margin-left: 500px;
    }
    .footer{
        width: 800px;
        display: flex;
        flex-direction: row;
        justify-content: space-between;
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
            <div>
                <h2>CKC FASTFOOD</h2>
            </div>
            <div>
                <p>CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM</p>
                <p>Độc lập - Tự do - Hạnh phúc</p>
            </div>
        </div>
        <div class="time">
            <p>HCM, Ngày 20 tháng 2 Năm 2022</p>
        </div>
        
        <div class="body">
            <h2>DOANH THU NĂM 2022</h3>
            <div>
                    <p>Người báo cáo: Lê Công Tiến</p>
            </div>
            <div class="content">
                <h4>Doanh thu từng tháng:</h4>
                <ul>
                    @for($i = 1; $i < 13; $i++)
                    <li> Tháng {{ $i }}: 0</li>
                    @endfor
                    <hr>
                    <li>Tổng: <span>0 VNĐ</span></li>
                    <li>Tháng có thu nhập lớn nhất: <span> Tháng 1</span></li>
                </ul>
                <canvas id="barChart" 
                style="min-height: 250px; height: 250px; max-height: 250px; max-width: 70%;
                 display: block; width: 572px;"
                 width="715" height="400" class="chartjs-render-monitor"></canvas>
            </div>
        </div>
        <hr>
      <div class="footer">
        <div>
            <h4>Giám đốc</h4>
            <p>Ký và ghi rõ họ và tên</p>
        </div>
        <div>
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