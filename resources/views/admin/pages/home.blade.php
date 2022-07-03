@extends('admin/layouts.app')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Home</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="home">Home</a></li>
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
                                <h3>{{ $donhangmoi }}</h3>

                                <p>Các Hóa Đơn Mới</p>
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
                                <h3>{{ $tongdoanhthu }}<sup style="font-size: 20px">$</sup></h3>

                                <p>Tổng Doanh Thu</p>
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
                                <h3>{{ $taikhoankhachhang }}</h3>

                                <p>Tài Khoản Khách Hàng</p>
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
   
                
            </div><!-- /.container-fluid -->
        </section>

        <script type="text/javascript" src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

        <script>
            var temp = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]
            var thang = 0;
            var doanhthutemp = <?php echo json_encode($doanhthutungthang); ?>;
            
            doanhthutemp.forEach(element => {
                temp[element.month - 1] = element.doanhthu;
               
            });

            var areaChartData = {
                labels  : ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6', 'Tháng 7','Tháng 8','Tháng 9','Tháng 10','Tháng 11','Tháng 12'],
                datasets: [
                    {
                    label               : 'Doanh Thu',
                    backgroundColor     : 'rgba(60,141,188,0.9)',
                    borderColor         : 'rgba(60,141,188,0.8)',
                    pointRadius          : false,
                    pointColor          : '#3b8bba',
                    pointStrokeColor    : 'rgba(60,141,188,1)',
                    pointHighlightFill  : '#fff',
                    pointHighlightStroke: 'rgba(60,141,188,1)',
                    data                : [temp[0], temp[1], temp[2], temp[3], temp[4], temp[5], temp[6], temp[7], temp[8], temp[9], temp[10], temp[11] ]
                    },
                ]
            }
    
            var barChartCanvas = $('#barChart').get(0).getContext('2d')
            var barChartData = $.extend(true, {}, areaChartData)
            var temp0 = areaChartData.datasets[0]
            barChartData.datasets[0] = temp0
    
            var barChartOptions = {
                responsive              : true,
                maintainAspectRatio     : false,
                datasetFill             : false
            }
    
            new Chart(barChartCanvas, {
                type: 'bar',
                data: barChartData,
                options: barChartOptions
            })
        </script>

        // <script>
        //     document.getElementById("exportChart").addEventListener("click",function(){
        //         chart.exportChart({format: "jpg"});
        //     });  
        // </script>
    @endsection
