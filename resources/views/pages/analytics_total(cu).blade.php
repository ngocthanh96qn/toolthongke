@extends('layouts.app')

@section('css')
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@500&display=swap" rel="stylesheet">
 
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.js"></script>
@endsection
 

@section('content')

<div class="container ">
  <div class="row analytics-top">
    <a href="{{ route('setup_total') }}"><button class="btn btn-warning btn-block add_page"  data-toggle="modal" data-target="#modal-new"> CẤU HÌNH </button></a>
  </div>
  <hr>
    <div class="row">

          <div class="col-md-4 analytics-top" >
      <div class="one_col">
      <div class="row " style=" margin-bottom: 20px">
        <div class="col-md-12 col-xs-offset-1">
          <span class="view" >
             
            {{number_format($data['yesterday'],"0",".",".")}}

          </span>
          <span class="day_view">Hôm qua</span>
        </div>
       
      </div>

    {{--   @foreach ($data_page as $page)
        <div class="row" style="padding: 5px" >
        <div class="col-xs-5" >
          <span class="font-bold text-gray-600">{{$page['name']}} </span>
        </div>
        <div class="col-xs-7">
          <span><i class="fa fa-eye" aria-hidden="true"> &emsp; {{$page['data'][1][1]}} </i></span> &emsp; --}}
          {{-- <span class="description-percentage text-green"><i class="fa fa-caret-up"></i> 17%</span> --}}
   {{--      </div>
      </div>
      @endforeach --}}

      </div>
     </div>

    <div class="col-md-4 analytics-top" >
      <div class="one_col">
      <div class="row " style=" margin-bottom: 20px">
        <div class="col-md-12 col-xs-offset-1">
          <span class="view" >
             {{number_format($data['thisMonth'],"0",".",".")}}
          </span>
          <span class="day_view">Tháng này</span>
        </div> 
      </div>
        <div class="row" style="padding: 5px" >
        <div class="col-xs-5" >
          <span class="font-bold text-gray-600">  </span>
        </div>
        <div class="col-xs-7">
          {{-- <span><i class="fa fa-eye" aria-hidden="true"> &emsp; {{$page['view_month']}} </i></span> --}}
          {{-- <span class="description-percentage text-green"><i class="fa fa-caret-up"></i> 17%</span> --}}
        </div>
      </div>     
      </div>
     </div>

     <div class="col-md-4 analytics-top text-center" >
        
        <div class="row">
          <div style="margin-top: 10px;">
            @php
              $before = $data['beforeMonth']+$data['beforeMonth']*0.2;
              $phantram = ($data['thisMonth']/$before)*100;
            @endphp
            <input  type="text" class="knob" value="{{number_format($phantram,"0")}}}" data-width="90" data-height="90" data-fgColor="#FE642E" data-readonly="true">
          </div>
        </div>

        <div class="row" style="padding: 5px" >
        <div class="col-xs-7" >
          <span class="font-bold text-gray-600"> Mục tiêu đặt ra: </span>
        </div>
        <div class="col-xs-5">
          <span><i class="fa fa-eye" aria-hidden="true"> {{number_format($data['beforeMonth']+$data['beforeMonth']*0.2,"0",".",".")}} </i></span> &emsp;      
        </div>
      </div>
      <div class="row" style="padding: 5px" >
        <div class="col-xs-7" >
          <span class="font-bold text-gray-600"> Đã đạt được: </span>
        </div>
        <div class="col-xs-5">
          <span><i class="fa fa-eye" aria-hidden="true">  {{number_format($data['thisMonth'],"0",".",".")}} </i></span> &emsp;
        </div>
      </div>
        
    </div>

    </div>
    <div class="row">
      <canvas id="myChart" style=" height: 350px"></canvas>
    </div>
<hr>
    <div class="row"  >
      <div class="col-md-4 col-md-offset-2 " >
        <h4 class="text-center">Thống kê nhân viên Hôm qua</h4>
        <canvas id="myChart1"></canvas>
      </div>
      <div class="col-md-4 col-md-offset-2">
        <h4 class="text-center">Thống kê Nhân viên Tháng này</h4>
        <canvas id="myChart2" ></canvas>
      </div>
    </div>
<hr>
    
    <div class="row"  >
      <div class="col-md-4 col-md-offset-2 " >
        <h4 class="text-center">Thống kê Trang Hôm qua</h4>
        <canvas id="myChart3"></canvas>
      </div>
      <div class="col-md-4 col-md-offset-2">
        <h4 class="text-center">Thống kê Trang Tháng này</h4>
        <canvas id="myChart4" ></canvas>
      </div>
    </div>

    <div class="row">
     {{-- @foreach ($data_page as $i=>$element)
       <div class="col-md-6">
         <figure class="highcharts-figure">
          <div id="container{{$i}}"></div>
        </figure>
      </div>
     @endforeach  --}}  
    </div>

    </div>
@endsection


@push('scripts')
 <!-- jQuery Knob -->
<script src="../../admin-lte/bower_components/jquery-knob/js/jquery.knob.js"></script>
{{-- <script src="../../admin-lte/bower_components/chart.js/Chart.js"></script> --}}
<script type="text/javascript">
   $(function () {
    /* jQueryKnob */

    $(".knob").knob({
      draw: function () {

        // "tron" case
        if (this.$.data('skin') == 'tron') {

          var a = this.angle(this.cv)  // Angle
              , sa = this.startAngle          // Previous start angle
              , sat = this.startAngle         // Start angle
              , ea                            // Previous end angle
              , eat = sat + a                 // End angle
              , r = true;

          this.g.lineWidth = this.lineWidth;

          this.o.cursor
          && (sat = eat - 0.3)
          && (eat = eat + 0.3);

          if (this.o.displayPrevious) {
            ea = this.startAngle + this.angle(this.value);
            this.o.cursor
            && (sa = ea - 0.3)
            && (ea = ea + 0.3);
            this.g.beginPath();
            this.g.strokeStyle = this.previousColor;
            this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sa, ea, false);
            this.g.stroke();
          }

          this.g.beginPath();
          this.g.strokeStyle = r ? this.o.fgColor : this.fgColor;
          this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sat, eat, false);
          this.g.stroke();

          this.g.lineWidth = 2;
          this.g.beginPath();
          this.g.strokeStyle = this.o.fgColor;
          this.g.arc(this.xy, this.xy, this.radius - this.lineWidth + 1 + this.lineWidth * 2 / 3, 0, 2 * Math.PI, false);
          this.g.stroke();

          return false;
        }
      }
    });
    /* END JQUERY KNOB */

    //INITIALIZE SPARKLINE CHARTS
    $(".sparkline").each(function () {
      var $this = $(this);
      $this.sparkline('html', $this.data());
    });
  });
///////////////////////////////////////////////
    var color = ['#0967D2','#F7C948','#EF4E4E','#F9703E','#0D0E10','#3AE7E1'];
    var ctx = document.getElementById("myChart").getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: {!! json_encode($data['viewDay']['day']) !!},
            datasets: [{
                label: 'View', // Name the series
                data: {!! json_encode($data['viewDay']['data'])!!}, // Specify the data values array
                fill: false,
                borderColor: '#2196f3', // Add custom color border (Line)
                backgroundColor: '#2196f3', // Add custom color background (Points and Fill)
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
            display: true,
            text: 'Biểu đồ View Theo Ngày'
        },
           title: {
            display: true,
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
    ////
    var ctx = document.getElementById("myChart1").getContext('2d');
    var myChart1 = new Chart(ctx, {
        type: 'doughnut',
  data: {
    labels: {!! json_encode($data['statisNv'][0][0])!!},
    datasets: [{
     
      data: {!! json_encode($data['statisNv'][0][1])!!},
      backgroundColor: color,
      borderColor: color,
      borderWidth: 1
    }]
  },
  options: {
    //cutoutPercentage: 40,
    responsive: false,
     legend: {
          display: false
        }
  }
    });
    ///
    var ctx = document.getElementById("myChart2").getContext('2d');
    var myChart2 = new Chart(ctx, {
        type: 'doughnut',
  data: {
    labels:  {!! json_encode($data['statisNv'][1][0])!!},
    datasets: [{
      label: '# of Tomatoes',
      data:  {!! json_encode($data['statisNv'][1][1])!!},
      backgroundColor: color,
      borderColor: color,
      borderWidth: 1
    }]
  },
  options: {
    //cutoutPercentage: 40,
    responsive: false,
    legend: {
          display: false
        }
  }
    });
    //////
        var ctx = document.getElementById("myChart3").getContext('2d');
    var myChart3 = new Chart(ctx, {
        type: 'doughnut',
  data: {
    labels:  {!! json_encode($data['statisPage'][0][0])!!},
    datasets: [{
      label: '# of Tomatoes',
      data:  {!! json_encode($data['statisPage'][0][1])!!},
      backgroundColor: color,
      borderColor:color,
      borderWidth: 1
    }]
  },
  options: {
    //cutoutPercentage: 40,
    responsive: false,
    legend: {
          display: false
        }
  }
    });
    ////
        var ctx = document.getElementById("myChart4").getContext('2d');
    var myChart4 = new Chart(ctx, {
        type: 'doughnut',
  data: {
    labels:  {!! json_encode($data['statisPage'][1][0])!!},
    datasets: [{
      label: '# of Tomatoes',
      data:  {!! json_encode($data['statisPage'][1][1])!!},
      backgroundColor:color,
      borderColor: color,
      borderWidth: 1
    }]
  },
  options: {
    //cutoutPercentage: 40,
    responsive: false,
    legend: {
          display: false
        }
  }
    });
</script>

<script type="text/javascript">
  var data_page = {name:'fdsl',data:'23019'};
for (var i = 0; i < data_page.length; i++) {

  var data = data_page[i].data.splice(7);

  Highcharts.chart('container'+i, {
    chart: {
        type: 'column'
    },
    title: {
        text: data_page[i].name
    },
    subtitle: {
        text: ''
    },
    xAxis: {
        type: 'category',
        labels: {
            rotation: -45,
            style: {
                fontSize: '11px',
                fontFamily: 'Verdana, sans-serif'
            }
        }
    },
    yAxis: {
        min: 0,
        title: {
            text: ''
        }
    },
    legend: {
        enabled: false
    },
    tooltip: {
        pointFormat: 'Lượt View: <b>{point.y:.0f} </b>'
    },

    series: [{
        name: 'Lượt View',
        data:  data_page[i].data.reverse(),
        color: '#FEC35C',
        dataLabels: {
            enabled: false,
            rotation: -90,
            color: '#ffffff',
            align: 'right',
            format: '{point.y:.0f}', // one decimal
            y: 10, // 10 pixels down from the top
            style: {
                fontSize: '10px',
                fontFamily: 'Verdana, sans-serif'
            }
        }
    }]
});
}
 
 $(".highcharts-credits").html(""); 
 $(".highcharts-axis-labels").html(""); 
  
   
</script>

    
@endpush
