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

<div class="container">
  <hr>
    <div class="row">
{{--      <div class="col-md-3 analytics-top" >
      <div class="one_col">

        <div class="row nopadding">
        <div class="col-xs-2 col-xs-offset-3">
          <i class="fa fa-line-chart analytics-icon" aria-hidden="true"></i>
        </div>
        <div class="col-xs-6 ">
           <h4 class="analytics-icon">Hôm nay</h4>
        </div>
      </div>

      <div class="row " style="margin-top: 15px; margin-bottom: 20px">
        <div class="col-md-5 col-xs-offset-1">
          <span class="view" > 
            @php
              $view_today = 0;
              foreach ($data_page as $key => $page) {
                $view_today = $view_today + $page['data'][0][1];
              }
            @endphp
            {{number_format($view_today,"0",".",".")}}
          </span>
        </div>
        <div class="col-md-6">
          <p class="analytics-view">+{{ number_format($view_today*1.5)}} &ensp;<i class="fa fa-money" aria-hidden="true"></i></p> 
        </div>
      </div>

      @foreach ($data_page as $page)
        <div class="row" style="padding: 5px" >
        <div class="col-xs-5" >
          <span class="font-bold text-gray-600">{{$page['name']}} </span>
        </div>
        <div class="col-xs-7">
          <span><i class="fa fa-eye" aria-hidden="true">&emsp; {{$page['data'][0][1]}} </i></span> &emsp;
          {{ <span class="description-percentage text-green"><i class="fa fa-caret-up"></i> 17%</span> --}}
      {{--   </div>
      </div>
      @endforeach
      
      </div>
     </div> --}}

          <div class="col-md-4 analytics-top" >
      <div class="one_col">
      <div class="row " style=" margin-bottom: 20px">
        <div class="col-md-12 col-xs-offset-1">
          <span class="view" >
             @php
              $view_yesterday = 0;
              foreach ($data_page as $key => $page) {
                $view_yesterday = $view_yesterday + $page['data'][1][1];
              }
            @endphp
            {{number_format($view_yesterday,"0",".",".")}}

          </span>
          <span class="day_view">Hôm qua</span>
        </div>
       
      </div>

      @foreach ($data_page as $page)
        <div class="row" style="padding: 5px" >
        <div class="col-xs-5" >
          <span class="font-bold text-gray-600">{{$page['name']}} </span>
        </div>
        <div class="col-xs-7">
          <span><i class="fa fa-eye" aria-hidden="true"> &emsp; {{$page['data'][1][1]}} </i></span> &emsp;
          {{-- <span class="description-percentage text-green"><i class="fa fa-caret-up"></i> 17%</span> --}}
        </div>
      </div>
      @endforeach

      </div>
     </div>

    <div class="col-md-4 analytics-top" >
      <div class="one_col">
      <div class="row " style=" margin-bottom: 20px">
        <div class="col-md-12 col-xs-offset-1">
          <span class="view" >
            @php
              $view_month = 0;
              foreach ($data_page as $key => $page) {
                $view_month = $view_month + $page['view_month'];
              }
            @endphp
             {{number_format($view_month,"0",".",".")}}
          </span>
          <span class="day_view">Tháng này</span>
        </div>
        
      </div>

      @foreach ($data_page as $page)
        <div class="row" style="padding: 5px" >
        <div class="col-xs-5" >
          <span class="font-bold text-gray-600">{{$page['name']}} </span>
        </div>
        <div class="col-xs-7">
          <span><i class="fa fa-eye" aria-hidden="true"> &emsp; {{$page['view_month']}} </i></span>
          {{-- <span class="description-percentage text-green"><i class="fa fa-caret-up"></i> 17%</span> --}}
        </div>
      </div>
      @endforeach
      
      </div>
     </div>

     <div class="col-md-4 analytics-top text-center" >
        
        <div class="row">
          <div style="margin-top: 10px;">
            <input  type="text" class="knob" value="30" data-width="90" data-height="90" data-fgColor="#FE642E" data-readonly="true">
          </div>
        </div>

        <div class="row" style="padding: 5px" >
        <div class="col-xs-7" >
          <span class="font-bold text-gray-600">Mục tiêu đặt ra: </span>
        </div>
        <div class="col-xs-5">
          <span><i class="fa fa-eye" aria-hidden="true"> 234523 </i></span> &emsp;      
        </div>
      </div>
      <div class="row" style="padding: 5px" >
        <div class="col-xs-7" >
          <span class="font-bold text-gray-600"> Đã đạt được: </span>
        </div>
        <div class="col-xs-5">
          <span><i class="fa fa-eye" aria-hidden="true"> 234523 </i></span> &emsp;
        </div>
      </div>
        
    </div>

    </div>
<hr>
    <div class="row" style=" height: 350px">
      <canvas id="myChart"></canvas>
    </div>
<hr>
    <div class="row">
     @foreach ($data_page as $i=>$element)
       <div class="col-md-6">
         <figure class="highcharts-figure">
          <div id="container{{$i}}"></div>
        </figure>
      </div>
     @endforeach   
    </div>

    </div>
@endsection


@push('scripts')
 <!-- jQuery Knob -->
<script src="../../admin-lte/bower_components/jquery-knob/js/jquery.knob.js"></script>
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

    var ctx = document.getElementById("myChart").getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: {!! $data_total['x'] !!},
            datasets: [{
                label: 'Tổng view theo ngày tính từ đầu tháng', // Name the series
                data: {!! $data_total['y'] !!}, // Specify the data values array
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
</script>

<script type="text/javascript">
  var data_page = {!! json_encode($data_page) !!};
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
