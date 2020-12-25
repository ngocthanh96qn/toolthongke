
<!doctype html>
<html lang="en" dir="ltr">
    <head>
        <!-- Meta data -->
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <meta content="Solic – Bootstrap Responsive Modern Simple Dashboard Clean HTML Premium Admin Template" name="description">
        <meta content="Spruko Technologies Private Limited" name="author">
        <meta name="keywords" content=""   />
        <!--favicon -->
<link rel="icon" href="https://laravel.spruko.com/solic/Leftmenu-Icon-Light-Sidebar-ltr/assets/images/brand/favicon.ico" type="image/x-icon"/>
<link rel="shortcut icon" href="https://laravel.spruko.com/solic/Leftmenu-Icon-Light-Sidebar-ltr/assets/images/brand/favicon.ico" type="image/x-icon"/>
<!-- TITLE -->
<title>Thống kê nhân viên</title>
<!-- DASHBOARD CSS -->
<link href="{{ asset('css/style_1.css') }}" rel="stylesheet"/>

<!-- LEFT-MENU CSS -->
<link href="https://laravel.spruko.com/solic/Leftmenu-Icon-Light-Sidebar-ltr/assets/plugins/sidemenu-toggle/sidemenu-toggle.css" rel="stylesheet">
<!--C3.JS CHARTS PLUGIN -->
<link href="https://laravel.spruko.com/solic/Leftmenu-Icon-Light-Sidebar-ltr/assets/plugins/charts-c3/c3-chart.css" rel="stylesheet"/>


<!--- FONT-ICONS CSS -->
<link href="{{ asset('plugins/iconfonts/Pe-icon-7-stroke/Pe-icon-7.css') }}" rel="stylesheet"/>
<link href="{{ asset('plugins/iconfonts/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet"/>

<!-- Skin css-->
<link href="https://laravel.spruko.com/solic/Leftmenu-Icon-Light-Sidebar-ltr/assets/skins/skins-modes/color1.css"  id="theme" rel="stylesheet" type="text/css" media="all" />

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.js"></script>

</head>

    <body class="app sidebar-mini">
        
        <div class="page" >
            <div class="page-main" style="background: #48A384;">
                        
                <!-- CONTAINER -->
                <div class="container-fluid  relative" style="background: #48A384;">
                                            <!-- PAGE-HEADER -->
                    <div class="page-header"  >
                        <h4 class="page-title" > &emsp; Đặng Ngọc Thành </h4>
                        
                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form> 
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ url('/logout') }}" class="btn btn-cyan"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Đăng xuất
                                </a>
                            </li> 
                            &emsp;
                        </ol>  
                    </div>
                    <!-- PAGE-HEADER END -->
                                            <!-- ROW-1 OPEN -->
                    <div class="row">
                        <div class="col-sm-12 col-lg-12 col-xl-8">
                            <div class="row">
                                <div class="col-md-6 col-xl-6">
                                    <div class="card overflow-hidden">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-7 col-md-6">
                                                    <h2 class="mb-1 number-font display-4 font-weight-bold text-dark">{{number_format($data['view_yesterday'],"0",".",".")}}</h2>
                                                    @php
                                                        if($data['view_yesterday'] > $data['view_BeforeYesterday']){
                                                            $x = (($data['view_yesterday'] - $data['view_BeforeYesterday'])/$data['view_BeforeYesterday'])*100;
                                                            $x=number_format($x,"2",".",".");
                                                            echo ('<p class="mb-0 text-muted"><span class="mb-0 text-success fs-13 "><i class="fa fa-long-arrow-up"></i>'.$x.'%</span> so với ngày hôm trước</p>');
                                                        }
                                                        else {
                                                            $x = (($data['view_BeforeYesterday'] - $data['view_yesterday'])/$data['view_BeforeYesterday'])*100;
                                                            $x=number_format($x,"2",".",".");
                                                           echo ('<p class="mb-0 text-muted"><span class="mb-0 text-danger fs-13 "><i class="fa fa-long-arrow-down"></i> '.$x.'%</span> so với ngày hôm trước</p>'); 
                                                        }
                                                    @endphp
                                                    
                                                </div>
                                                <div class="col-5 col-md-6">
                                                    <h6 class="mb-0">Hôm qua</h6>
                                                    <div class="chart-wrapper chart-back">
                                                        <canvas id="bouncerate" class=""></canvas>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-6 col-xl-6">
                                    <div class="card overflow-hidden">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-7 col-md-6">
                                                    <h2 class="mb-1 number-font display-4 font-weight-bold text-dark">{{number_format($data['view_thisMonth'],"0",".",".")}}</h2>
                                                    @php
                                                    $viewBeforeMonth= 0;
                                                    foreach ($data['view_beforeMonth'] as $key => $page) {
                                                        $viewBeforeMonth += $page['viewBeforeMonth'];
                                                    }
                                                        if($data['view_thisMonth'] > $viewBeforeMonth){
                                                            $x = (($data['view_thisMonth'] - $viewBeforeMonth)/$viewBeforeMonth)*100;
                                                            $x=number_format($x,"2",".",".");
                                                            echo ('<p class="mb-0 text-muted"><span class="mb-0 text-success fs-13 "><i class="fa fa-long-arrow-up"></i>'.$x.'%</span> so với tháng trước</p>');
                                                        }
                                                        else {
                                                            $x = (($viewBeforeMonth - $data['view_thisMonth'])/$viewBeforeMonth)*100;
                                                            $x=number_format($x,"2",".",".");
                                                           echo ('<p class="mb-0 text-muted"><span class="mb-0 text-danger fs-13 "><i class="fa fa-long-arrow-down"></i> '.$x.'%</span> so với tháng trước</p>'); 
                                                        }
                                                    @endphp
                                                    
                                                </div>
                                                <div class="col-5 col-md-6">
                                                    <h6 class="mb-0">Tháng này</h6>
                                                    <div class="chart-wrapper chart-back">
                                                        <canvas id="sessions" class=""></canvas>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @php
                                    $colorTheme = ['bg-warning','bg-primary','bg-secondary','bg-danger','bg-info','bg-pink', 'bg-cyan','bg-purple' ];
                                    $ki=0;
                                @endphp
                                    
                                <div class="col-sm-12 col-lg-12 col-xl-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <h3 class="mb-1">THỐNG KÊ TỔNG VIEW THÁNG NÀY</h3>
                                            <p class="text-muted mb-5">Phần trăm view từng page</p>
                                            <div class="row mt-4">
                                                @foreach ($data['view_page_thisMonth'] as $name => $page)
                                                
                                                    <div class="col-md-4 dash-1">
                                                    <h6 class="mb-1"><span class="dot-label {{$colorTheme[$ki]}}"></span>{{$name}}</h6>
                                                    <h2 class="mb-1">{{number_format(($page['view_thisMonth']/$data['view_thisMonth'])*100,"0",".",".")}}%</h2>
                                                    <span class=" mb-0 text-muted"><b>{{number_format($page['view_thisMonth'],"0",".",".")}}</b> View</span>
                                                    </div>
                                                @php
                                                    $ki++;
                                                @endphp
                                                @endforeach
                                                
                                                
                                            </div>
                                            <div class="progress progress-md mt-5">
                                                @php
                                                    $ki=0;
                                                @endphp
                                                @foreach ($data['view_page_thisMonth'] as $name => $page)
                                                <div class="progress-bar {{$colorTheme[$ki]}} w-{{number_format(($page['view_thisMonth']/$data['view_thisMonth'])*100,"0",".",".")}}"></div>
                                                @php
                                                    $ki++;
                                                @endphp
                                                @endforeach
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-12 col-xl-4">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">CHI TIẾT VIEW TỪNG PAGE HÔM QUA</div>
                                </div>
                                <div class="card-body">
                                    @php
                                        $ki=0;
                                    @endphp
                                    @foreach ($data['view_page_yesterday'] as $name => $page)
                                     
                                        <div class="mb-5">
                                        <p class="mb-2">{{$name}}<span class="float-right font-weight-semibold">{{$page['view_yesterday']}}</span></p>
                                        <div class="progress  progress-xs">
                                            <div class="progress-bar {{$colorTheme[$ki]}} w-@php
                                            if ($data['view_yesterday']==0)
                                                {echo(0);}
                                            else
                                                {echo(number_format(($page['view_yesterday']/$data['view_yesterday'])*100,"0",".","."));}
                                            
                                            @endphp" role="progressbar"></div>
                                        </div>
                                    </div>
                                    @php
                                         $ki++;
                                    @endphp
                                    @endforeach
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ROW-1 CLOSED -->

                    <!-- ROW  -->
                    <div class="row">
                        <div class="col-xl-6 col-md-12 col-lg-6">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">CHỈ TIÊU ĐẠT ĐƯỢC THÁNG NÀY</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <span class=" mb-1">TỔNG VIEW ĐẠT ĐƯỢC THÁNG NÀY</span>
                                            <h2 class="mb-3">{{number_format($data['view_thisMonth'],"0",".",".")}} <span class="fs-13 text-muted font-weight-normal">lượt view</span></h2>
                                            <p class="mb-0 text-muted">Số view đạt được trong tháng này của tất cả các trang so với view tháng trước * 20%</p>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="chart-circle overflow-hiddene  mt-sm-0 mb-0 text-left" data-value="{{number_format($data['view_thisMonth']/($viewBeforeMonth*0.2+$viewBeforeMonth),"2",".",".")}}" data-thickness="8" data-color="#21c44c">
                                                <div class="chart-circle-value text-center "><h3 class="mb-0">{{number_format(($data['view_thisMonth']/($viewBeforeMonth*0.2+$viewBeforeMonth))*100,"0",".",".")}}%</h3><small class="fs-11">chỉ tiêu</small></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-md-12 col-lg-6">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">CẦN CỐ GẮNG</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <span class=" mb-1">TỔNG VIEW CẦN CỐ GẮNG THÁNG NÀY</span>
                                            <h2 class="mb-3">{{ number_format(($viewBeforeMonth*0.2+$viewBeforeMonth) - $data['view_thisMonth'],"0",".",".")  }} <span class="fs-13 text-muted font-weight-normal">lượt view</span></h2>
                                            <p class="mb-0 text-muted">Số view cố gắng đạt được đến cuối tháng của tất cả các trang</p>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="chart-circle overflow-hiddene  mt-sm-0 mb-0 text-left" data-value="{{1-number_format($data['view_thisMonth']/($viewBeforeMonth*0.2+$viewBeforeMonth),"2",".",".")}}" data-thickness="8" data-color="#f5334f">
                                                <div class="chart-circle-value text-center "><h3 class="mb-0">{{100-number_format(($data['view_thisMonth']/($viewBeforeMonth*0.2+$viewBeforeMonth))*100,"0",".",".")}}%</h3><small class="fs-11">còn lại</small></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ROW CLOSED -->

                    

                    <!-- ROW-3 OPEN -->
                     @php
                        $ki=0;
                    @endphp
                   @foreach ($data['view_page_yesterday'] as $name => $page)
                    <div class="row">
                        <div class="col-sm-12 col-lg-12 col-xl-8">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">Biểu đồ chi tiết view theo ngày của {{$name}}</div>
                                </div>
                                <div class="card-body" >
                                     <canvas id="myChart{{$name}}"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-12 col-xl-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="">
                                            <h6>Hôm qua </h6>
                                            <h1 class="mt-2 mb-3 display-6 font-weight-bold text-dark">{{number_format($page['view_yesterday'],"0",".",".")}}</h1>
                                            @php
                                                if($page['view_yesterday'] > $page['view_BeforeYesterday']){
                                                    $x = (($page['view_yesterday'] - $page['view_BeforeYesterday'])/$page['view_BeforeYesterday'])*100;
                                                    $x=number_format($x,"2",".",".");
                                                    echo ('<p class="mb-0 text-muted"><span class="mb-0 text-success fs-13 "><i class="fa fa-long-arrow-up"></i>'.$x.'%</span> so với ngày hôm trước</p>');
                                                }
                                                else {
                                                    $x = (($page['view_BeforeYesterday'] - $page['view_yesterday'])/$page['view_BeforeYesterday'])*100;
                                                    $x=number_format($x,"2",".",".");
                                                   echo ('<p class="mb-0 text-muted"><span class="mb-0 text-danger fs-13 "><i class="fa fa-long-arrow-down"></i> '.$x.'%</span> so với ngày hôm trước</p>'); 
                                                }
                                            @endphp
                                            
                                        </div>
                                        <div class="ml-auto">
                                            <div class="feature">
                                                <div class="fa-stack fa-lg fa-2x icon {{$colorTheme[$ki]}}">
                                                    <i class="fa fa-codepen fa-stack-1x text-white"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                               
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="">
                                            <h6>Tháng này</h6>
                                            <h2 class="mt-2 mb-3 display-6 font-weight-bold text-dark">{{number_format($data['view_page_thisMonth'][$name]['view_thisMonth'],"0",".",".")}}</h2>
                                             @php
                                                if($data['view_page_thisMonth'][$name]['view_thisMonth'] > $data['view_beforeMonth'][$name]['viewBeforeMonth']){
                                                    $x = (($data['view_page_thisMonth'][$name]['view_thisMonth'] - $data['view_beforeMonth'][$name]['viewBeforeMonth'])/$data['view_beforeMonth'][$name]['viewBeforeMonth'])*100;
                                                    $x=number_format($x,"2",".",".");
                                                    echo ('<p class="mb-0 text-muted"><span class="mb-0 text-success fs-13 "><i class="fa fa-long-arrow-up"></i>'.$x.'%</span> so với tháng trước</p>');
                                                }
                                                else {
                                                    $x = (($data['view_beforeMonth'][$name]['viewBeforeMonth'] - $data['view_page_thisMonth'][$name]['view_thisMonth'])/$data['view_beforeMonth'][$name]['viewBeforeMonth'])*100;
                                                    $x=number_format($x,"2",".",".");
                                                   echo ('<p class="mb-0 text-muted"><span class="mb-0 text-danger fs-13 "><i class="fa fa-long-arrow-down"></i> '.$x.'%</span> so với tháng trước</p>'); 
                                                }
                                            @endphp
                                            
                                        </div>
                                        <div class="ml-auto">
                                            <div class="feature">
                                                <div class="fa-stack fa-lg fa-2x icon {{$colorTheme[$ki]}}">
                                                    <i class="fa fa-superpowers fa-stack-1x text-white"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    @php
                        $ki++;
                    @endphp
                    @endforeach

                    <!-- ROW-3 CLOSED -->
                     
                    

                </div>
                <!-- CONTAINER CLOSED -->
            </div>
                      
                        
        </div><!-- End Page -->
            <!-- BACK-TO-TOP -->
<a href="#top" id="back-to-top"><i class="fa fa-long-arrow-up"></i></a>
<!-- JQUERY SCRIPTS -->
<script src="https://laravel.spruko.com/solic/Leftmenu-Icon-Light-Sidebar-ltr/assets/js/vendors/jquery-3.2.1.min.js"></script>
<!-- BOOTSTRAP SCRIPTS -->
<script src="https://laravel.spruko.com/solic/Leftmenu-Icon-Light-Sidebar-ltr/assets/js/vendors/bootstrap.bundle.min.js"></script>

<!-- CHART-CIRCLE -->
<script src="https://laravel.spruko.com/solic/Leftmenu-Icon-Light-Sidebar-ltr/assets/js/vendors/circle-progress.min.js"></script>
<!-- RATING STAR -->
<script src="https://laravel.spruko.com/solic/Leftmenu-Icon-Light-Sidebar-ltr/assets/plugins/rating/jquery.rating-stars.js"></script>  
<!-- CHARTJS CHART -->
<script src="https://laravel.spruko.com/solic/Leftmenu-Icon-Light-Sidebar-ltr/assets/plugins/chart/Chart.bundle.js"></script>
<script src="https://laravel.spruko.com/solic/Leftmenu-Icon-Light-Sidebar-ltr/assets/plugins/chart/utils.js"></script>
<!-- INDEX-SCRIPTS -->
 <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.js"></script>
<script src="{{ asset('js/index.js') }}"></script>
<!-- CUSTOM JS -->
<script src="https://laravel.spruko.com/solic/Leftmenu-Icon-Light-Sidebar-ltr/assets/js/custom.js"></script>

<script type="text/javascript">
///////////////////////////////////////////////
var bieudo =  {!! json_encode($data['bieu_do']) !!};
var color =  ['#f7b731','#564ec1','#04cad0','#f5334f','#26c2f7','#fc5296','#007ea7'];
console.log(color[0]);
for (var i = 0; i < bieudo.length; i++) {
        var ctx = document.getElementById("myChart"+bieudo[i][3]).getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: bieudo[i][0].reverse(),
            datasets: [{
                label: 'view ', // Name the series
                data: bieudo[i][1].reverse(), // Specify the data values array
                fill: false,
                borderColor: color[i], // Add custom color border (Line)
                backgroundColor: color[i], // Add custom color background (Points and Fill)
                borderWidth: 3, // Specify bar border width

            }]},
        options: {
          responsive: true, // Instruct chart js to respond nicely.
          maintainAspectRatio: false, // Add to prevent default behaviour of full-width/height
          elements: {
            line: {
                tension: 0 // disables bezier curves
            }
          },
          label: {
            display: false,
            text: 'Biểu đồ View Theo Ngày'
        },
           title: {
            display: false,
            text: 'Biểu đồ View Theo Ngày'
        },
        scales: {
          xAxes: [{
            display: false
          }],
          yAxes: [{
            display: true
          }],
        }
        }

    });
}

</script>

    </body>
</html>