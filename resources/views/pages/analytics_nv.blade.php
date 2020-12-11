@extends('layouts.app')

@section('css')
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Literata:ital,wght@1,300&display=swap" rel="stylesheet">
 
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.js"></script>
@endsection
 

@section('content')
<div class="container">
    <div class="row">
     <div class="col-md-3 analytics-top" >
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
          <span class="view" > $4,647</span>
        </div>
        <div class="col-md-6">
          <p class="analytics-view">+1.000.000 &ensp;<i class="fa fa-money" aria-hidden="true"></i></p> 
        </div>
      </div>

      <div class="row" style="padding: 5px" >
        <div class="col-xs-5" >
          <span class="font-bold text-gray-600">Thanh hóa </span>
        </div>
        <div class="col-xs-7">
          <span><i class="fa fa-eye" aria-hidden="true"> 234523 </i></span> &emsp;
          <span class="description-percentage text-green"><i class="fa fa-caret-up"></i> 17%</span>
        </div>
      </div>
      <div class="row" style="padding: 5px" >
        <div class="col-xs-5" >
          <span class="font-bold text-gray-600">Quảng nam </span>
        </div>
        <div class="col-xs-7">
          <span><i class="fa fa-eye" aria-hidden="true"> 234523 </i></span> &emsp;
          <span class="description-percentage text-green"><i class="fa fa-caret-up"></i> 17%</span>
        </div>
      </div>

      </div>
     </div>

          <div class="col-md-3 analytics-top" >
      <div class="one_col">

        <div class="row nopadding">
        <div class="col-xs-2 col-xs-offset-3">
          <i class="fa fa-line-chart analytics-icon" aria-hidden="true"></i>
        </div>
        <div class="col-xs-6 ">
           <h4 class="analytics-icon">Hôm qua</h4>
        </div>
      </div>

      <div class="row " style="margin-top: 15px; margin-bottom: 20px">
        <div class="col-md-5 col-xs-offset-1">
          <span class="view" > $4,647</span>
        </div>
        <div class="col-md-6">
          <p class="analytics-view">+1.000.000 &ensp;<i class="fa fa-money" aria-hidden="true"></i></p> 
        </div>
      </div>

      <div class="row" style="padding: 5px" >
        <div class="col-xs-5" >
          <span class="font-bold text-gray-600">Thanh hóa </span>
        </div>
        <div class="col-xs-7">
          <span><i class="fa fa-eye" aria-hidden="true"> 234523 </i></span> &emsp;
          <span class="description-percentage text-green"><i class="fa fa-caret-up"></i> 17%</span>
        </div>
      </div>
      <div class="row" style="padding: 5px" >
        <div class="col-xs-5" >
          <span class="font-bold text-gray-600">Quảng nam </span>
        </div>
        <div class="col-xs-7">
          <span><i class="fa fa-eye" aria-hidden="true"> 234523 </i></span> &emsp;
          <span class="description-percentage text-green"><i class="fa fa-caret-up"></i> 17%</span>
        </div>
      </div>

      </div>
     </div>

          <div class="col-md-3 analytics-top" >
      <div class="one_col">

        <div class="row nopadding">
        <div class="col-xs-2 col-xs-offset-3"> 
        <i class="fa fa-bar-chart analytics-icon" aria-hidden="true"></i>
        </div>
        <div class="col-xs-6 ">
           <h4 class="analytics-icon">Tháng này</h4>
        </div>
      </div>

      <div class="row " style="margin-top: 15px; margin-bottom: 20px">
        <div class="col-md-5 col-xs-offset-1">
          <span class="view" > $4,647</span>
        </div>
        <div class="col-md-6">
          <p class="analytics-view">+1.000.000 &ensp;<i class="fa fa-money" aria-hidden="true"></i></p> 
        </div>
      </div>

      <div class="row" style="padding: 5px" >
        <div class="col-xs-5" >
          <span class="font-bold text-gray-600">Thanh hóa </span>
        </div>
        <div class="col-xs-7">
          <span><i class="fa fa-eye" aria-hidden="true"> 234523 </i></span> &emsp;
          <span class="description-percentage text-green"><i class="fa fa-caret-up"></i> 17%</span>
        </div>
      </div>
      <div class="row" style="padding: 5px" >
        <div class="col-xs-5" >
          <span class="font-bold text-gray-600">Quảng nam </span>
        </div>
        <div class="col-xs-7">
          <span><i class="fa fa-eye" aria-hidden="true"> 234523 </i></span> &emsp;
          <span class="description-percentage text-green"><i class="fa fa-caret-up"></i> 17%</span>
        </div>
      </div>

      </div>
     </div>

     <div class="col-md-3 analytics-top text-center" >
        <div class="row">
          <div class="col-xs-1 col-xs-offset-4">
            <i class="fa fa-pie-chart analytics-icon" aria-hidden="true"></i>
          </div>
          <div class="col-xs-4 ">
             <h4 class="analytics-icon">Mục tiêu</h4>
          </div>
        </div>
        <div class="row">
          <div style="margin-top: 10px;">
            <input  type="text" class="knob" value="9" data-width="90" data-height="90" data-fgColor="#FE642E" data-readonly="true">
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
          <span class="font-bold text-gray-600">Đã đạt được: </span>
        </div>
        <div class="col-xs-5">
          <span><i class="fa fa-eye" aria-hidden="true"> 234523 </i></span> &emsp;
        </div>
      </div>
        
    </div>

    </div>
    <div class="row" style=" height: 350px">
      <canvas id="myChart"></canvas>
    </div>

    <div class="row">
      <div class="col-md-6">
         <figure class="highcharts-figure">
        <div id="container2"></div>
      </div>
       <div class="col-md-6">
         <figure class="highcharts-figure">
        <div id="container1"></div>
      </div>
    
</figure>
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
                label: 'Tổng view theo ngày', // Name the series
                data: {!! $data_total['y'] !!}, // Specify the data values array
                fill: false,
                borderColor: '#2196f3', // Add custom color border (Line)
                backgroundColor: '#2196f3', // Add custom color background (Points and Fill)
                borderWidth: 3 // Specify bar border width
            }]},
        options: {
          responsive: true, // Instruct chart js to respond nicely.
          maintainAspectRatio: false, // Add to prevent default behaviour of full-width/height 
        }
    });
</script>

<script type="text/javascript">
  for (var i = 1; i < 3; i++) {
    Highcharts.chart('container'+i, {
    chart: {
        type: 'column'
    },
    title: {
        text: 'World\'s largest cities per 2017'
    },
    subtitle: {
        text: 'Source: <a href="http://en.wikipedia.org/wiki/List_of_cities_proper_by_population">Wikipedia</a>'
    },
    xAxis: {
        type: 'category',
        labels: {
            rotation: -45,
            style: {
                fontSize: '13px',
                fontFamily: 'Verdana, sans-serif'
            }
        }
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Population (millions)'
        }
    },
    legend: {
        enabled: false
    },
    tooltip: {
        pointFormat: 'Population in 2017: <b>{point.y:.1f} millions</b>'
    },
    series: [{
        name: 'Population',
        data: [
            ['Shanghai', 24.2],
            ['Beijing', 20.8],
            ['Karachi', 14.9],
            ['Shenzhen', 13.7],
            ['Guangzhou', 13.1],
            ['Istanbul', 12.7],
            ['Mumbai', 12.4],
            ['Moscow', 12.2],
            ['São Paulo', 12.0],
            ['Delhi', 11.7],
            ['Kinshasa', 11.5],
            ['Tianjin', 11.2],
            ['Lahore', 11.1],
            ['Jakarta', 10.6],
            ['Dongguan', 10.6],
            ['Lagos', 10.6],
            ['Bengaluru', 10.3],
            ['Seoul', 9.8],
            ['Foshan', 9.3],
            ['Tokyo', 9.3]
        ],
        dataLabels: {
            enabled: true,
            rotation: -90,
            color: '#FFFFFF',
            align: 'right',
            format: '{point.y:.1f}', // one decimal
            y: 10, // 10 pixels down from the top
            style: {
                fontSize: '13px',
                fontFamily: 'Verdana, sans-serif'
            }
        }
    }]
});
  }
  

 
</script>

    
@endpush
