
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
<link rel="icon" href="{{ asset('image/icon.gif') }}" type="image/x-icon"/>
<link rel="shortcut icon" href="{{ asset('image/icon.gif') }}" type="image/x-icon"/>
<!-- TITLE -->
<title>Thống kê nhân viên</title>
<!-- DASHBOARD CSS -->
<link href="{{ asset('/css/style_1.css?v=').time()}}" rel="stylesheet"/>

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
            <div class="page-main" style="background-image: linear-gradient(to right, #577590 , #D78A76);">
                        
                <!-- CONTAINER -->
                <div class="container-fluid  relative" style="background-image: linear-gradient(to right, #577590 , #D78A76);">
                                            <!-- PAGE-HEADER -->
                    <div class="page-header"  >
                        &emsp;
                        <h4 class="page-title" style="color: black !important;"> 
                            <img alt="User Avatar" class="rounded-circle avatar-lg mr-2" src="https://banner2.cleanpng.com/20180723/qxp/kisspng-computer-icons-desktop-wallpaper-user-avatar-employee-engagement-5b557fd67ec249.2716105815323299425192.jpg">  
                            <a href="{{ route('menu.analytic_nv',$data['id']) }}">&emsp; {{$data['name']}} -- MediaNet</a> 
                        </h4>
                        
                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form> 
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('menu.analytic_total') }}" class="btn btn-success">
                                Trang chủ
                                </a>
                            </li>
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
                                                <div class="col-8 col-md-8">
                                                    <h2 class="mb-1 number-font display-4 font-weight-bold text-dark" style="color:#1574fb !important;">{{number_format($data['view_yesterday'],"0",".",".")}}</h2>
                                                    @php
                                                        if($data['view_yesterday'] > $data['view_BeforeYesterday']){
                                                            if ($data['view_BeforeYesterday']==0) {
                                                               $x=0;
                                                            }
                                                            else {
                                                                $x = (($data['view_yesterday'] - $data['view_BeforeYesterday'])/$data['view_BeforeYesterday'])*100;
                                                                $x=number_format($x,"2",".",".");
                                                            }
                                                            
                                                            echo ('<p class="mb-0 text-muted"><span class="mb-0 text-success fs-13 "><i class="fa fa-long-arrow-up"></i> '.$x.'%</span> so với ngày hôm trước</p>');
                                                        }
                                                        else {
                                                            if ($data['view_BeforeYesterday']==0) {
                                                                $x=0;
                                                            }
                                                            else {
                                                                $x = (($data['view_BeforeYesterday'] - $data['view_yesterday'])/$data['view_BeforeYesterday'])*100;
                                                            $x=number_format($x,"2",".",".");
                                                            }
                                                            
                                                           echo ('<p class="mb-0 text-muted"><span class="mb-0 text-danger fs-13 "><i class="fa fa-long-arrow-down"></i> '.$x.'%</span> so với ngày hôm trước</p>'); 
                                                        }
                                                    @endphp
                                                    
                                                </div>
                                                <div class="col-4 col-md-4">
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
                                                <div class="col-8 col-md-8">
                                                    <h2 class="mb-1 number-font display-4 font-weight-bold text-dark" style="color:#1574fb !important; ">{{number_format($data['view_thisMonth'],"0",".",".")}}</h2>
                                                    @php
                                                    $viewBeforeMonth= 0;
                                                    foreach ($data['view_beforeMonth'] as $key => $page) {
                                                        $viewBeforeMonth += $page['viewBeforeMonth'];
                                                    }
                                                        if($data['view_thisMonth'] > $viewBeforeMonth){
                                                            if ($viewBeforeMonth!==0) {
                                                               $x = (($data['view_thisMonth'] - $viewBeforeMonth)/$viewBeforeMonth)*100;
                                                            $x=number_format($x,"2",".",".");
                                                            }
                                                            else {
                                                                $x=100;
                                                            }
                                                            
                                                            echo ('<p class="mb-0 text-muted"><span class="mb-0 text-success fs-13 "><i class="fa fa-long-arrow-up"></i> '.$x.'%</span> so với tháng trước</p>');
                                                        }
                                                        else {
                                                            if ($viewBeforeMonth!==0) {
                                                               $x = (($viewBeforeMonth - $data['view_thisMonth'])/$viewBeforeMonth)*100;
                                                            $x=number_format($x,"2",".",".");
                                                            }
                                                            else {
                                                                $x=100;
                                                            }
                                                            
                                                           echo ('<p class="mb-0 text-muted"><span class="mb-0 text-danger fs-13 "><i class="fa fa-long-arrow-down"></i> '.$x.'%</span> so với tháng trước</p>'); 
                                                        }
                                                    @endphp
                                                    
                                                </div>
                                                <div class="col-4 col-md-4">
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
                                    $colorTheme = ['bg-warning','bg-primary','bg-secondary','bg-danger','bg-info','bg-pink', 'bg-cyan','bg-purple','bg-warning','bg-primary','bg-secondary','bg-danger','bg-info','bg-pink', 'bg-cyan','bg-purple' ];
                                    $ki=0;
                                @endphp
                                    
                                <div class="col-sm-12 col-lg-12 col-xl-12">
                                    {{-- <div class="card">
                                        <div class="card-body">
                                            <h3 class="mb-1">CHI TIẾT TỔNG VIEW THÁNG NÀY</h3>
                                            <p class="text-muted mb-5">Phần trăm view từng page so với tổng view của tháng</p>
                                            <div class="row mt-4">
                                                @foreach ($data['view_page_thisMonth'] as $name => $page)
                                                
                                                    <div class="col-md-3 dash-1" style="margin-top: 15px;">
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
                                    </div> --}}
                                    <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">View Theo ngày</h3>
                                    <div class="card-options">
                                        <form action="{{ route('setDayNv') }}" method="POST" autocomplete="off">
                                        @csrf
                                            <div class="input-group">
                                                
                                                <input class="form-control form-control-sm fc-datepicker" placeholder="Bắt đầu" type="text" name="startDay" value="{{end($data['viewDay']['day'])}}" style="border-color: rgb(36, 196, 180);">
                                            
                                                <input class="form-control form-control-sm fc-datepicker" placeholder="Kết thúc" type="text" name="endDay" value="{{$data['viewDay']['day'][0]}}" style="border-color: rgb(36, 196, 180);">
                                                <input type="hidden" name="id" value="{{$data['id']}}">
                                                <span class="input-group-btn ml-0">
                                                    <button class="btn" style=" border-radius: 50%;background: white" type="submit">
                                                        <i class="fa fa-refresh" aria-hidden="true"></i>
                                                    </button>
                                                </span>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                
                                <div class="card-body" style="height: 197px">
                                     <canvas id="myChartNhv"></canvas>
                                </div>
                            </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-xl-4 col-md-12 col-lg-4">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">CHỈ TIÊU ĐẠT ĐƯỢC THÁNG NÀY</h3>
                                </div>
                                <div class="card-body" style="line-height: 87px;">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <span class=" mb-1">TỔNG VIEW ĐẠT ĐƯỢC THÁNG NÀY</span>
                                            <h2 class="mb-3">{{number_format($data['view_thisMonth'],"0",".",".")}} <span class="fs-13 text-muted font-weight-normal">lượt view</span></h2>
                                            <p class="mb-0 text-muted">Chỉ tiêu được tính dựa trên số view của tháng này so với view tháng trước * 20%</p>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="chart-circle overflow-hiddene  mt-sm-0 mb-0 text-left" data-value="
                                            @if ($viewBeforeMonth!==0)
                                                 {{number_format($data['view_thisMonth']/($viewBeforeMonth*0.2+$viewBeforeMonth),"2",".",".")}}
                                            @else
                                                {{100}}
                                            @endif
                                           " data-thickness="8" data-color="#21c44c">
                                                <div class="chart-circle-value text-center "><h3 class="mb-0">
                                                @if ($viewBeforeMonth!==0)
                                                 {{number_format(($data['view_thisMonth']/($viewBeforeMonth*0.2+$viewBeforeMonth))*100,"0",".",".")}}
                                            @else
                                                {{100}}
                                            @endif
                                        %</h3><small class="fs-11">chỉ tiêu</small></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>  
                    </div>
                    <!-- ROW-1 CLOSED -->

                    <!-- ROW  -->
                    <div class="row ">
                        <hr>
                        <br>
                       
                    </div>
                    <!-- ROW CLOSED -->

                    

                    <!-- ROW-3 OPEN -->
                     @php
                        $ki=0;
                    @endphp
                   @foreach ($data['view_page_yesterday'] as $name => $page)
                    <div class="row">
                        <div class="col-sm-12 col-lg-12 col-xl-6">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title"> {{$name}}</div>
                                    <div class="card-options">
                                       
                                            <div class="input-group">    
                                            <h5 class="mt-2 mb-3 display-6  text-dark" style="font-family: sans-serif;">Tháng này: <b style="color:#1574fb;">{{number_format($data['view_page_thisMonth'][$name]['view_thisMonth'],"0",".",".")}}</b></h5> &emsp;
                                             @php
                                                if($data['view_page_thisMonth'][$name]['view_thisMonth'] > $data['view_beforeMonth'][$name]['viewBeforeMonth']){
                                                    if ($data['view_beforeMonth'][$name]['viewBeforeMonth']==0) {
                                                        $x=100;
                                                    } else {
                                                       $x = (($data['view_page_thisMonth'][$name]['view_thisMonth'] - $data['view_beforeMonth'][$name]['viewBeforeMonth'])/$data['view_beforeMonth'][$name]['viewBeforeMonth'])*100;
                                                    }
                                                    
                                                    
                                                    $x=number_format($x,"2",".",".");
                                                    echo ('<p class="mb-0 text-muted"><span class="mb-0 text-success fs-13 "><i class="fa fa-long-arrow-up"></i> '.$x.'%</span> so với tháng trước</p>');
                                                }
                                                else {
                                                    if ($data['view_beforeMonth'][$name]['viewBeforeMonth']==0) {
                                                        $x=100;
                                                    } else {
                                                       $x = (($data['view_beforeMonth'][$name]['viewBeforeMonth'] - $data['view_page_thisMonth'][$name]['view_thisMonth'])/$data['view_beforeMonth'][$name]['viewBeforeMonth'])*100;
                                                    }
                                                    
                                                    
                                                    $x=number_format($x,"2",".",".");
                                                   echo ('<p class="mb-0 text-muted"><span class="mb-0 text-danger fs-13 "><i class="fa fa-long-arrow-down"></i> '.$x.'%</span> so với tháng trước</p>'); 
                                                }
                                            @endphp
                                            </div>
                                       
                                    </div>
                                </div>
                                <div class="card-body" style="height: 214px !important;" >
                                     <canvas id="myChart{{$name}}"></canvas>
                                </div>
                            </div>

                        </div>
                        <div class="col-sm-12 col-lg-12 col-xl-6">
                            {{-- <div class="card">
                                <div class="card-body" style="padding: 0.5rem 1.5rem; line-height: 2.5rem !important;">
                                    <div class="d-flex">
                                        <div class="">
                                            <h6>Hôm qua </h6>
                                            <h1 class="mt-2 mb-3 display-6 font-weight-bold text-dark">{{number_format($page['view_yesterday'],"0",".",".")}}</h1>
                                            @php
                                                if($page['view_yesterday'] > $page['view_BeforeYesterday']){
                                                    if ($page['view_BeforeYesterday']==0) {
                                                        $x=0;
                                                    }
                                                    else {
                                                       $x = (($page['view_yesterday'] - $page['view_BeforeYesterday'])/$page['view_BeforeYesterday'])*100; 
                                                    }
                                                    
                                                    $x=number_format($x,"2",".",".");
                                                    echo ('<p class="mb-0 text-muted"><span class="mb-0 text-success fs-13 "><i class="fa fa-long-arrow-up"></i> '.$x.'%</span> so với ngày hôm trước</p>');
                                                }
                                                else {
                                                    if ($page['view_BeforeYesterday']==0) {
                                                       $x=0;
                                                    }
                                                    else {
                                                       $x = (($page['view_BeforeYesterday'] - $page['view_yesterday'])/$page['view_BeforeYesterday'])*100; 
                                                    }
                                                    
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
                                <div class="card-body" style="padding: 0.5rem 1.5rem; line-height: 2.5rem !important;">
                                    <div class="d-flex">
                                        <div class="">
                                            <h6>Tháng này</h6>
                                            <h2 class="mt-2 mb-3 display-6 font-weight-bold text-dark">{{number_format($data['view_page_thisMonth'][$name]['view_thisMonth'],"0",".",".")}}</h2>
                                             @php
                                                if($data['view_page_thisMonth'][$name]['view_thisMonth'] > $data['view_beforeMonth'][$name]['viewBeforeMonth']){
                                                    if ($data['view_beforeMonth'][$name]['viewBeforeMonth']==0) {
                                                        $x=100;
                                                    } else {
                                                       $x = (($data['view_page_thisMonth'][$name]['view_thisMonth'] - $data['view_beforeMonth'][$name]['viewBeforeMonth'])/$data['view_beforeMonth'][$name]['viewBeforeMonth'])*100;
                                                    }
                                                    
                                                    
                                                    $x=number_format($x,"2",".",".");
                                                    echo ('<p class="mb-0 text-muted"><span class="mb-0 text-success fs-13 "><i class="fa fa-long-arrow-up"></i> '.$x.'%</span> so với tháng trước</p>');
                                                }
                                                else {
                                                    if ($data['view_beforeMonth'][$name]['viewBeforeMonth']==0) {
                                                        $x=100;
                                                    } else {
                                                       $x = (($data['view_beforeMonth'][$name]['viewBeforeMonth'] - $data['view_page_thisMonth'][$name]['view_thisMonth'])/$data['view_beforeMonth'][$name]['viewBeforeMonth'])*100;
                                                    }
                                                    
                                                    
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
                                
                            </div> --}}
                            
                            @php
                                $check=0;
                            @endphp
                   
                        @foreach ($data['bieu_do_post'] as $key => $page)
                        @if ($page[3]==$name)
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title"> <a href="https://facebook.com/{{$page[4]}}" target="_blank" style="color: red">{{$page[3]}}</a></div>
                                </div>
                                <div class="card-body" style="height: 214px !important;" >
                                     <canvas id="myChart1{{$page[3]}}"></canvas>
                                </div>
                            </div>
                           
                            @php
                                $check=1;
                            @endphp
                        @endif
                         
                        @endforeach 
                        @if ($check == 0)
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title"> <a href="#" target="_blank" style="color: red">Null</a></div>
                                </div>
                                <div class="card-body" style="height: 214px !important;" >
                                     <canvas id="null"></canvas>
                                </div>
                            </div>
                            
                        @endif  
                        </div>
                    </div>
                    @php
                        $ki++;
                    @endphp
                    @endforeach

                    <!-- ROW-3 CLOSED -->
                    {{-- <div class="row">
                   @foreach ($data['bieu_do_post'] as $key => $page)
                   
                        <div class="col-sm-12 col-lg-12 col-xl-6">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">Biểu đồ chi tiết bài đăng theo ngày của <a href="https://facebook.com/{{$page[4]}}" target="_blank" style="color: red">{{$page[3]}}</a></div>
                                </div>
                                <div class="card-body" style="height: 214px !important;" >
                                     <canvas id="myChart1{{$page[3]}}"></canvas>
                                </div>
                            </div>

                        </div>
                    @endforeach
                    </div> --}}
                    

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
<script src="{{ asset('solic/jquery-ui.js') }}"></script>
<!-- CHART-CIRCLE -->
<script src="https://laravel.spruko.com/solic/Leftmenu-Icon-Light-Sidebar-ltr/assets/js/vendors/circle-progress.min.js"></script>
<!-- RATING STAR -->
<script src="https://laravel.spruko.com/solic/Leftmenu-Icon-Light-Sidebar-ltr/assets/plugins/rating/jquery.rating-stars.js"></script>  
<!-- CHARTJS CHART -->
<script src="https://laravel.spruko.com/solic/Leftmenu-Icon-Light-Sidebar-ltr/assets/plugins/chart/Chart.bundle.js"></script>
<script src="https://laravel.spruko.com/solic/Leftmenu-Icon-Light-Sidebar-ltr/assets/plugins/chart/utils.js"></script>
<!-- INDEX-SCRIPTS -->
 <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.js"></script>
<script src="{{ asset('js/index.js?v=').time() }}"></script>
<!-- CUSTOM JS -->
<script src="https://laravel.spruko.com/solic/Leftmenu-Icon-Light-Sidebar-ltr/assets/js/custom.js"></script>

<script type="text/javascript">
///////////////////////////////////////////////
var bieudo =  {!! json_encode($data['bieu_do']) !!};
console.log(bieudo);
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
<script type="text/javascript">
///////////////////////////////////////////////
var data = {!! json_encode($data['viewDay']) !!};
// console.log(data);
var color =  ['#f7b731','#564ec1','#04cad0','#f5334f','#26c2f7','#fc5296','#007ea7'];


    var ctx = document.getElementById("myChartNhv").getContext('2d');
    var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: data['day'].reverse(),
        datasets: [{
            label: 'view', // Name the series
            data: data['data'].reverse(), // Specify the data values array
            fill: false,
            borderColor: color[0], // Add custom color border (Line)
            backgroundColor: color[0], // Add custom color background (Points and Fill)
            borderWidth: 1, // Specify bar border width
            

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
            callbacks: { 
               label: function(tooltipItem, data) { 
                   return tooltipItem.yLabel.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","); }, 
               },
            legend: { 
             display: false 
            }, 
            tooltips: { 
               mode: 'label', 
               label: 'mylabel', 
               callbacks: { 
                   label: function(tooltipItem, data) { 
                       return tooltipItem.yLabel.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."); }, }, 
            }, 
            scales: {
              xAxes: [{
                display: false
              }],
              yAxes: [{
                display: true,
               ticks: {
                        callback: function(label, index, labels) {
                            return label/1000+'k';
                        }
                    },

                    scaleLabel: {
                        display: false,
                        labelString: '1k = 1000'
                    },
              }],
            }
        }
});

</script>
<script>
    $(function() {
    $('.fc-datepicker').datepicker({
        showOtherMonths: true,
        selectOtherMonths: true,
        dateFormat: 'dd-mm-yy'
    }); 
});
</script>
<script type="text/javascript">
///////////////////////////////////////////////
var bieudo_post =  {!! json_encode($data['bieu_do_post']) !!};
console.log(bieudo_post);
var color =  ['#f7b731','#564ec1','#04cad0','#f5334f','#26c2f7','#fc5296','#007ea7'];
console.log(color[0]);
for (var i = 0; i < bieudo_post.length; i++) {
        var ctx = document.getElementById("myChart1"+bieudo_post[i][3]).getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: bieudo_post[i][0],
            datasets: [{
                label: 'Bài đăng ', // Name the series
                data: bieudo_post[i][1], // Specify the data values array
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
            callbacks: { 
               label: function(tooltipItem, data) { 
                   return tooltipItem.yLabel.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","); }, 
               },
            legend: { 
             display: false 
            }, 
            tooltips: { 
               mode: 'label', 
               label: 'mylabel', 
               callbacks: { 
                   label: function(tooltipItem, data) { 
                       return tooltipItem.yLabel.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."); }, }, 
            }, 
            scales: {
              xAxes: [{
                display: false
              }],
              yAxes: [{
                display: true,
               ticks: {
                        callback: function(label, index, labels) {
                            return label+'Post';
                        },
                        beginAtZero: true
                    },

                    scaleLabel: {
                        display: false,
                        labelString: '1k = 1000'
                    },
              }],
            }
        }

    });
}

</script>
    </body>
</html>