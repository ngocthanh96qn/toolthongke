
<!doctype html>
<html lang="en" dir="ltr">
	<head>
		<!-- Meta data -->
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
		<meta content="" name="description">
		<meta content="" name="author">
		<meta name="keywords" content=""   />
		<!--favicon -->
<link rel="icon" href="{{ asset('image/icon.gif') }}" type="image/x-icon"/>
<link rel="shortcut icon" href="{{ asset('image/icon.gif') }}" type="image/x-icon"/>
<!-- TITLE -->
<title>Thống kê nhân viên</title>
<!-- DASHBOARD CSS -->
<link href="{{ asset('solic/css/dashboard.css') }}" rel="stylesheet"/>
<link href="{{ asset('solic/css/dashboard-dark.css') }}" rel="stylesheet"/>
<!--C3.JS CHARTS PLUGIN -->
<link href="https://laravel.spruko.com/solic/Horizontal-Light-ltr/assets/plugins/charts-c3/c3-chart.css" rel="stylesheet"/>
<!-- TABS CSS -->
<link href="https://laravel.spruko.com/solic/Horizontal-Light-ltr/assets/plugins/tabs/style-2.css" rel="stylesheet" type="text/css">
<!-- DATE PICKER CSS -->
<link href="https://laravel.spruko.com/solic/Horizontal-Light-ltr/assets/plugins/date-picker/spectrum.css" rel="stylesheet"/>
<!-- PERFECT SCROLL BAR CSS-->
<link href="https://laravel.spruko.com/solic/Horizontal-Light-ltr/assets/plugins/pscrollbar/perfect-scrollbar.css" rel="stylesheet" />
<!--- FONT-ICONS CSS -->
<link href="{{ asset('plugins/iconfonts/Pe-icon-7-stroke/Pe-icon-7.css') }}" rel="stylesheet"/>
<link href="{{ asset('plugins/iconfonts/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet"/>
<!-- SELECT2 CSS -->
<link href="https://laravel.spruko.com/solic/Horizontal-Light-ltr/assets/plugins/select2/select2.min.css" rel="stylesheet"/>
<!-- Skin css-->
<link href="https://laravel.spruko.com/solic/Horizontal-Light-ltr/assets/skins/skins-modes/color1.css"  id="theme" rel="stylesheet" type="text/css" media="all" />
<link href="{{ asset('css/style_1.css') }}" rel="stylesheet"/>
<link href="{{ asset('css/style.css') }}" rel="stylesheet"/>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.js"></script>
</head>

	<body class="default-header" >
		
		
		
		<div class="page" style="background-image: linear-gradient(to right, #577590 , #D78A76);" >
			<div class="page-main">               
				<!-- CONTAINER -->
				<div class="container-fluid content-area relative">
					<div class="page-header"  >
                        <h4 class="page-title" style="color: black !important"> &emsp; {{Auth::user()->name}} -- MediaNet </h4>
                        
                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form> 
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('home') }}" class="btn btn-warning">
                                Cài đặt	
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
					<!-- ROW-2 OPEN -->
{{-- 					<div class="row">
						
						<div class="col-xl-9 col-md-12 col-lg-12">
						<form action="{{ route('setDay') }}" method="POST" autocomplete="off">
						@csrf
						<div class="card">
								<div class="card-header">
									<div class="card-title">Thống kê theo thời gian tự chọn</div>
								</div>
								<div class="row">
									<div class="col-xl-6 col-md-6 col-lg-6">
										<div class="card-body">
										<div class="wd-200 mg-b-30">
											<div class="input-group" >
												<div class="input-group-prepend" >
													<div class="input-group-text" >
														<i class="fa fa-calendar tx-16 lh-0 op-6" ></i>
													</div>
												</div>
												<input class="form-control fc-datepicker" placeholder="Bắt đầu" type="text" name="startDay" >
											
												<input class="form-control fc-datepicker" placeholder="Kết thúc" type="text" name="endDay">
											</div>
										</div>
										</div>
									</div>
									
									<div class="col-xl-4 col-md-6 col-lg-6">
										<div class="card-body">
										<button type="submit"  class="btn btn-pill btn-warning">XEM</button>
										</div>
									</div>
								</div>
								
							</div>
							</form>
						</div>
						
						
					</div> --}}
					
					@foreach ($data['viewDay'] as $key=>$value)
						<div class="row" style="margin-top: 30px;">
						<div class="col-xl-9 col-md-12 col-lg-12">
							<div class="card">
								<div class="card-header">
									<h3 class="card-title">Tổng View toàn hệ thống của ViewID -- {{$value['view_id']}}</h3>
									<div class="card-options">
										<form action="{{ route('setDay') }}" method="POST" autocomplete="off">
										@csrf
											<div class="input-group">
												
												<input class="form-control form-control-sm fc-datepicker" placeholder="Bắt đầu" type="text" name="startDay" value="{{$value['day']['0']}}">
											
												<input class="form-control form-control-sm fc-datepicker" placeholder="Kết thúc" type="text" name="endDay" value="{{end($value['day'])}}">
												<span class="input-group-btn ml-0">
													<button class="btn-default" style=" border-radius: 5px;" type="submit">
														<i class="fa fa-refresh" aria-hidden="true"></i>
													</button>
												</span>
											</div>
										</form>
									</div>
								</div>
								
								<div class="card-body" style="height: 197px">
                                     <canvas id="myChart{{$value['view_id']}}"></canvas>
                                </div>
							</div>
						</div>
						<div class="col-xl-3 col-md-12 col-lg-12">
							<div class="card">
								
								<div class="row mr-0 ml-0">
									<div class="col-md-12 pr-0 pl-0">
										<div class="card-body" style="height: 126px">
											<div class="d-flex">
												<div>
													<h6 class="mb-2">View ngày hôm qua</h6>
													<h2 class="mb-0 display-6 font-weight-bold" style="color: #1574fb">{{number_format($value['data'][count($value['data'])-2],"0",".",".")}}</h2>
												@php
                                                if($value['data'][count($value['data'])-2] > $value['data'][count($value['data'])-3]){
                                                    if ($value['data'][count($value['data'])-3]==0) {
                                                        $x=0;
                                                    }
                                                    else {
                                                       $x = (($value['data'][count($value['data'])-2] - $value['data'][count($value['data'])-3])/$value['data'][count($value['data'])-3])*100; 
                                                    }
                                                    
                                                    $x=number_format($x,"2",".",".");
                                                    echo ('<p class="mb-0 text-muted"><span class="mb-0 text-success fs-13 "><i class="fa fa-long-arrow-up"></i> '.$x.'%</span> so với ngày hôm trước</p>');
                                                }
                                                else {
                                                    if ($value['data'][count($value['data'])-3]==0) {
                                                        $x=0;
                                                    }
                                                    else {
                                                       $x = (($value['data'][count($value['data'])-3] - $value['data'][count($value['data'])-2])/$value['data'][count($value['data'])-3])*100; 
                                                    }
                                                    
                                                    $x=number_format($x,"2",".",".");
                                                   echo ('<p class="mb-0 text-muted"><span class="mb-0 text-danger fs-13 "><i class="fa fa-long-arrow-down"></i> '.$x.'%</span> so với ngày hôm trước</p>'); 
                                                }
                                            @endphp
												</div>
												
											</div>
										</div>
									</div>
									<div class="col-md-12 pr-0 pl-0 border-top">
										<div class="card-body" style="height: 126px">
											<div class="d-flex">
												<div>
													<h6 class="mb-2">View Tháng này</h6>
													<h2 class="mb-0 display-6 font-weight-bold" style="color: #1574fb">{{number_format($data['totalViewId'][$value['view_id']]['viewThisMonth'],'0','.','.')}} </h2>
													
												@php
                                                if($data['totalViewId'][$value['view_id']]['viewThisMonth'] > $data['totalViewId'][$value['view_id']]['viewBeforeMonth']){
                                                    if ($data['totalViewId'][$value['view_id']]['viewBeforeMonth']==0) {
                                                        $x=100;
                                                    }
                                                    else {
                                                       $x = (($data['totalViewId'][$value['view_id']]['viewThisMonth'] - $data['totalViewId'][$value['view_id']]['viewBeforeMonth'])/$data['totalViewId'][$value['view_id']]['viewBeforeMonth'])*100; 
                                                    }
                                                    
                                                    $x=number_format($x,"2",".",".");
                                                    echo ('<p class="mb-0 text-muted"><span class="mb-0 text-success fs-13 "><i class="fa fa-long-arrow-up"></i> '.$x.'%</span> so với tháng trước</p>');
                                                }
                                                else {
                                                    if ($data['totalViewId'][$value['view_id']]['viewBeforeMonth']==0) {
                                                       $x=100;
                                                    }
                                                    else {
                                                       $x = (($data['totalViewId'][$value['view_id']]['viewBeforeMonth'] - $data['totalViewId'][$value['view_id']]['viewThisMonth'])/$data['totalViewId'][$value['view_id']]['viewBeforeMonth'])*100; 
                                                    }
                                                    
                                                    $x=number_format($x,"2",".",".");
                                                   echo ('<p class="mb-0 text-muted"><span class="mb-0 text-danger fs-13 "><i class="fa fa-long-arrow-down"></i> '.$x.'%</span> so với tháng trước</p>'); 
                                                }
                                            @endphp

												</div>
												
											</div>
										</div>
									</div>
									
								</div>
							</div>
						</div>
					</div>
					@endforeach
					
					<!-- ROW-2 CLOSED -->
						@php
                            $color = ['#f5334f','#564ec1','#f7b731','#21c44c','#f5334f','#564ec1','#f7b731','#21c44c','#f5334f','#564ec1','#f7b731','#21c44c','#f5334f','#564ec1','#f7b731','#21c44c','#f5334f','#564ec1','#f7b731','#21c44c','#f5334f','#564ec1','#f7b731','#21c44c','#f5334f','#564ec1','#f7b731','#21c44c','#f5334f','#564ec1','#f7b731','#21c44c','#f5334f','#564ec1','#f7b731','#21c44c','#f5334f','#564ec1','#f7b731','#21c44c','#f5334f','#564ec1','#f7b731','#21c44c','#f5334f','#564ec1','#f7b731','#21c44c' ];
                            $ki=0;
                        @endphp
					<!-- ROW-1 OPEN -->
					<div class="row" style="margin-top: 30px;" >
						
						<div class="col-xl-3 col-md-12 col-lg-12">
							<div class="card">
								<div class="card-header">
									<div class="card-title">Top View Nhân viên Hôm qua</div>
								</div>
								<div class="row mr-0 ml-0">
									@foreach ($data['rankNvYesterday'] as $nv => $view)
										<div class="col-md-12 pr-0 pl-0">
										<div class="card-body" style="height: 123px;">
											<div class="d-flex">
												<div>
													<h6 class="mb-2"><a href="{{ route('menu.analytic_nv',$data['statisNv'][$nv]['id']) }}">{{$nv}}</a></h6>
													<h2 class="mb-0 display-6 font-weight-bold" style="color: #1574fb">{{number_format($view,'0','.','.')}}</h2>	
												</div>	
											</div>
										</div>
										</div>
									@endforeach
								</div>
							</div>
						</div>
						<div class="col-xl-3 col-md-12 col-lg-12">
							<div class="card">
								<div class="card-header">
									<div class="card-title">Top View Nhân viên Tháng này</div>
								</div>
								<div class="row mr-0 ml-0">
									@foreach ($data['rankNv'] as $nv => $view)
										<div class="col-md-12 pr-0 pl-0">
										<div class="card-body">
											<div class="d-flex">
												<div>
													<h6 class="mb-2"><a href="{{ route('menu.analytic_nv',$data['statisNv'][$nv]['id']) }}">{{$nv}}</a></h6>
													<h2 class="mb-0 display-6 font-weight-bold" style="color: #1574fb">{{number_format($view,'0','.','.')}}</h2>
													@php
                                                if( $view > $data['statisNv'][$nv]['view_nv_beforeMonth'] ){
                                                    if ($data['statisNv'][$nv]['view_nv_beforeMonth']==0) {
                                                        $x=100;
                                                    }
                                                    else {
                                                       $x = (($view - $data['statisNv'][$nv]['view_nv_beforeMonth'])/$data['statisNv'][$nv]['view_nv_beforeMonth'])*100; 
                                                    }
                                                    
                                                    $x=number_format($x,"2",".",".");
                                                    echo ('<p class="mb-0 text-muted"><span class="mb-0 text-success fs-13 "><i class="fa fa-long-arrow-up"></i> '.$x.'%</span> so với tháng trước</p>');
                                                }
                                                else {
                                                    if ($data['statisNv'][$nv]['view_nv_beforeMonth']==0) {
                                                        $x=100;
                                                    }
                                                    else {
                                                       $x = (($data['statisNv'][$nv]['view_nv_beforeMonth']-$view)/$data['statisNv'][$nv]['view_nv_beforeMonth'])*100; 
                                                    }
                                                    
                                                    $x=number_format($x,"2",".",".");
                                                   echo ('<p class="mb-0 text-muted"><span class="mb-0 text-danger fs-13 "><i class="fa fa-long-arrow-down"></i> '.$x.'%</span> so với tháng trước</p>'); 
                                                }
                                            @endphp
												</div>
											<div class="chart-circle chart-circle-md" data-value="
											@if ($data['statisNv'][$nv]['view_nv_beforeMonth']!==0)
												{{($data['statisNv'][$nv]['view_nv_month']/($data['statisNv'][$nv]['view_nv_beforeMonth']*0.2+$data['statisNv'][$nv]['view_nv_beforeMonth']))}}
											@else
											    {{100}}
											@endif
											" 
											data-thickness="10" data-color="#f7b731">
														<div class="chart-circle-value text-center ">
											<h6 class="mb-0">
											@if ($data['statisNv'][$nv]['view_nv_beforeMonth']!==0)
												{{number_format(($data['statisNv'][$nv]['view_nv_month']/($data['statisNv'][$nv]['view_nv_beforeMonth']*0.2+$data['statisNv'][$nv]['view_nv_beforeMonth']))*100,'1','.','.')}}
											@else
												{{100}}
											@endif
											</h6></div>
											</div>
										</div>

										</div>
										
										</div>
									@endforeach
								</div>
							</div>
						</div>
						<div class="col-xl-3 col-md-12 col-lg-12">
							<div class="card">
								<div class="card-header">
									<div class="card-title">Top view các Trang hôm qua</div>
								</div>
								<div class="card-body" style="height: 1107px; overflow-y: scroll;">
									@php
										$k=100;
									@endphp
									@foreach ($data['rankPageYesterday'] as $page => $view)
										<div class="mb-5">
										<p class="mb-2">{{$page}}<span class="float-right font-weight-semibold">{{number_format($view,'0','.','.')}}</span></p>
										<div class="progress  progress-xs">
											<div class="progress-bar  w-{{$k}} " role="progressbar" style="background: {{$color[$ki]}};"></div>
										</div>
									</div>
									@php
										$k-=4;
										$ki++;
									@endphp
									
									@endforeach
								</div>
							</div>
						</div>
						<div class="col-xl-3 col-md-12 col-lg-12">
							<div class="card">
								<div class="card-header">
									<div class="card-title">Top view các Trang Tháng này</div>
								</div>
								<div class="card-body" style="height: 1107px; overflow-y: scroll;">
									@php
										$ki=0;
										$k=100;
									@endphp
									@foreach ($data['rankPage'] as $page => $view)
										<div class="mb-5">
										<p class="mb-2">{{$page}}<span class="float-right font-weight-semibold">{{number_format($view,'0','.','.')}}</span></p>
										<div class="progress  progress-xs">
											<div class="progress-bar  w-{{$k}} " role="progressbar" style="background: {{$color[$ki]}};"></div>
										</div>
									</div>
									@php
										$k-=4;
										$ki++;
									@endphp
									
									@endforeach
								</div>
							</div>
						</div>

						

					</div>
					<!-- ROW-1 CLOSED -->

				</div>
				<!-- CONTAINER CLOSED -->
			</div>

            			<!-- FOOTER -->

<!-- FOOTER END -->	</div><!-- End Page -->
			<!-- BACK-TO-TOP -->
<a href="#top" id="back-to-top"><i class="fa fa-long-arrow-up"></i></a>
<!-- JQUERY SCRIPTS -->
<script src="https://laravel.spruko.com/solic/Horizontal-Light-ltr/assets/js/vendors/jquery-3.2.1.min.js"></script>
<!-- BOOTSTRAP SCRIPTS -->
<script src="https://laravel.spruko.com/solic/Horizontal-Light-ltr/assets/js/vendors/bootstrap.bundle.min.js"></script>
<!-- TIMEPICKER JS -->
<script src="https://laravel.spruko.com/solic/Horizontal-Light-ltr/assets/plugins/time-picker/jquery.timepicker.js"></script>
<script src="https://laravel.spruko.com/solic/Horizontal-Light-ltr/assets/plugins/time-picker/toggles.min.js"></script>
<!-- DATEPICKER JS -->
<script src="https://laravel.spruko.com/solic/Horizontal-Light-ltr/assets/plugins/date-picker/spectrum.js"></script>
<script src="{{ asset('solic/jquery-ui.js') }}"></script>
<script src="https://laravel.spruko.com/solic/Horizontal-Light-ltr/assets/plugins/input-mask/jquery.maskedinput.js"></script>
<!-- SPARKLINE -->
<script src="https://laravel.spruko.com/solic/Horizontal-Light-ltr/assets/js/vendors/jquery.sparkline.min.js"></script>
<!-- CHART-CIRCLE -->
<script src="https://laravel.spruko.com/solic/Horizontal-Light-ltr/assets/js/vendors/circle-progress.min.js"></script>
<!-- RATING STAR -->
<script src="https://laravel.spruko.com/solic/Horizontal-Light-ltr/assets/plugins/rating/jquery.rating-stars.js"></script>
<!-- HORIZONTAL-MENU -->
<script src="https://laravel.spruko.com/solic/Horizontal-Light-ltr/assets/plugins/horizontal-menu/horizontal-menu.js"></script>
<!-- PERFECT SCROLL BAR JS-->
<script src="https://laravel.spruko.com/solic/Horizontal-Light-ltr/assets/plugins/pscrollbar/perfect-scrollbar.js"></script>
<script src="https://laravel.spruko.com/solic/Horizontal-Light-ltr/assets/plugins/pscrollbar/pscroll-1.js"></script>
<!-- SIDEBAR JS -->
<script src="https://laravel.spruko.com/solic/Horizontal-Light-ltr/assets/plugins/sidebar/sidebar.js"></script>
<!-- SELECT2 JS -->
<script src="https://laravel.spruko.com/solic/Horizontal-Light-ltr/assets/plugins/select2/select2.full.min.js"></script>
<script src="https://laravel.spruko.com/solic/Horizontal-Light-ltr/assets/js/select2.js"></script>
<!-- CHARTJS CHART -->
<script src="https://laravel.spruko.com/solic/Horizontal-Light-ltr/assets/plugins/chart/Chart.bundle.js"></script>
<script src="https://laravel.spruko.com/solic/Horizontal-Light-ltr/assets/plugins/chart/utils.js"></script>
<!-- C3.JS CHART PLUGIN -->
<script src="https://laravel.spruko.com/solic/Horizontal-Light-ltr/assets/plugins/charts-c3/d3.v5.min.js"></script>
<script src="https://laravel.spruko.com/solic/Horizontal-Light-ltr/assets/plugins/charts-c3/c3-chart.js"></script>
<!-- INPUT MASK PLUGIN-->
<script src="https://laravel.spruko.com/solic/Horizontal-Light-ltr/assets/plugins/input-mask/jquery.mask.min.js"></script>
<!-- PIETY CHART -->
<script src="https://laravel.spruko.com/solic/Horizontal-Light-ltr/assets/plugins/peitychart/jquery.peity.min.js"></script>
<script src="https://laravel.spruko.com/solic/Horizontal-Light-ltr/assets/plugins/peitychart/peitychart.init.js"></script>
<!-- INDEX-SCRIPTS -->
<script src="https://laravel.spruko.com/solic/Horizontal-Light-ltr/assets/js/index4.js"></script>
<!-- ECHART JS -->
<script src="https://laravel.spruko.com/solic/Horizontal-Light-ltr/assets/plugins/echarts/echarts.js"></script>
<!-- APEX-CHARTS JS -->
<script src="https://laravel.spruko.com/solic/Horizontal-Light-ltr/assets/plugins/apexcharts/apexcharts.js"></script>
<script src="https://laravel.spruko.com/solic/Horizontal-Light-ltr/assets/plugins/apexcharts/irregular-data-series.js"></script>
<!-- STICKY JS -->
<script src="https://laravel.spruko.com/solic/Horizontal-Light-ltr/assets/js/stiky.js"></script>
<!-- CUSTOM JS -->
<script src="https://laravel.spruko.com/solic/Horizontal-Light-ltr/assets/js/custom.js"></script>
<script type="text/javascript">
///////////////////////////////////////////////
var data = {!! json_encode($data['viewDay']) !!};
console.log(data[0]);
var color =  ['#f7b731','#564ec1','#04cad0','#f5334f','#26c2f7','#fc5296','#007ea7'];

for (var i = 0; i < data.length; i++) {
	var ctx = document.getElementById("myChart"+data[i]['view_id']).getContext('2d');
	var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: data[i]['day'],
        datasets: [{
            label: 'view', // Name the series
            data: data[i]['data'], // Specify the data values array
            fill: false,
            borderColor: color[i], // Add custom color border (Line)
            backgroundColor: color[i], // Add custom color background (Points and Fill)
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
}
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

	</body>
</html>