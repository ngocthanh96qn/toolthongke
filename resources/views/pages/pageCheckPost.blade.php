
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
                            <a href="{{ route('menu.CheckPost') }}">&emsp; Xem bài đăng của Page</a> 
                        </h4>
                        
                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form> 
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('home') }}" class="btn btn-success">
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
                     <div class="row">
                   @foreach ($data['bieu_do'] as $key => $page)
                   
                        <div class="col-sm-12 col-lg-12 col-xl-6">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">Biểu đồ chi tiết bài đăng theo ngày của {{$page[3]}}</div>
                                </div>
                                <div class="card-body" style="height: 214px !important;" >
                                     <canvas id="myChart{{$page[3]}}"></canvas>
                                </div>
                            </div>

                        </div>
                    @endforeach
                    </div>
                    </div>
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
        type: 'bar',
        data: {
            labels: bieudo[i][0],
            datasets: [{
                label: 'Bài đăng ', // Name the series
                data: bieudo[i][1], // Specify the data values array
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