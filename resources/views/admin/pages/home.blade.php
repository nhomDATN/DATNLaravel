@extends('admin/layouts.app')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">TRANG CHỦ</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="home">Trang chủ</a></li>
                            <li class="breadcrumb-item active">Chào mừng</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3 id="countInvoice">{{ number_format($donhangmoi,0,',','.') }}</h3>

                                <p>Đơn Hàng</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-bag"></i>
                            </div>
                            {{-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3 id="revenue">{{ number_format($tongdoanhthu,0,',','.')  }}<sup style="font-size: 20px">VNĐ</sup></h3>

                                <p>Doanh Thu</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                            {{-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3 id="countAccount">{{ number_format($taikhoankhachhang,0,',','.') }}</h3>
                                <p>Số Tài Khoản Đăng Ký</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-person-add"></i>
                            </div>
                            {{-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
                        </div>
                    </div>
                    <!-- ./col -->
                </div>
                    <div class="card card-success">
                        <div class="card-header">
                          <h3 class="card-title">Thống kê doanh thu hàng tháng</h3>
          
                          <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                              <i class="fas fa-minus"></i>
                            </button>
                            {{-- <button type="button" class="btn btn-tool" data-card-widget="remove">
                              <i class="fas fa-times"></i>
                            </button> --}}
                          </div>
                        </div>
                        <div class="card-body">
                          <div class="chart"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                            <canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%; display: block; width: 572px;" width="715" height="312" class="chartjs-render-monitor"></canvas>
                            {{-- <button id="exportChart">Export Chart</button> --}}
                        </div>
                        </div>
                        
                        <!-- /.card-body -->
                      </div>
                      <div style="align-content: center; display: flex; align-items: center;text-align: center;justify-content: center">
                        <form action="{{ route('report') }}" method="post">
                            @csrf
                        <select name="year" style="width:100px; height: 30px" onchange="SetYear(this.value)">
                            <option value="{{ now()->year }}">{{ now()->year }}</option>
                            @for($i = now()->year - 1 ; $i > now()->year - 20; $i-- )
                            <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                        <input type="submit" value="Xuất PDF" style="margin-left: 10px;">
                    </form>
                    </div>
            </div><!-- /.container-fluid -->
        </section>
        
        <script type="text/javascript" src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
        <script>
           function SetYear(year)
            {
                $.ajax({
                    type: "get",
                    url: "/getDataWithYear",
                    data:{
                        year: year
                    },
                    dataType: "json",
                    success: function (response) {
                        console.log(response);
                        innerChart(response['doanhthutungthang']);
                        $('#countInvoice').html(`${response['tongdonhang'].toLocaleString('de-DE')}`);
                        $('#countAccount').html(`${response['taikhoankhachhang'].toLocaleString('de-DE')}`);
                        $('#revenue').html(`${response['doanhthu'].toLocaleString('de-DE')}`+'<sup style="font-size: 20px">VNĐ</sup>');
                    }
                });
            }  
        </script>
        <script>
            innerChart(<?php echo json_encode($doanhthutungthang)?>);
            function innerChart(data)
            {
            var temp = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
            var thang = 0;
                var doanhthutemp = data;
            
            doanhthutemp.forEach(element => {
                
                temp[element.month - 1] = element.doanhthu;
            });

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
    @endsection
