@extends('layouts.main-layout')

@section('content')
<script src="{{asset('js/chart.js')}}"></script>
<!-- title content -->
<div id="show-overview">
<body>
  <div class="container">
    <div id="chart-title">
          <div class="upline-title"><span id="dept-id"></span> STATUS</div>
              <div class="line-title">
                <div class="cycle-title"></div>
              </div>
          <div class="bottomline-title">OVERVIEW</div>
    </div>
    <div class="row">
      <div class="col-sm-6 col-sm-offset-3 mepet">
        <div style="background-color:white;width:105%">
          <div id="top-status">
            <span id="status-jam" class="show-date">{{date(" M Y")}}</span>
            <span id="faculty-name">Faculty of Engineering</span><span id="university-name">, Universitas Gadjah Mada</span>
            <script type="text/javascript">date_time('date_time');</script>
          </div>
          <div id="middle-status" style="background-color:#DCEBFF;line-height:1.3em;">
            <span id="left-clock">
              <span style="font-size:1.7em;margin-left:4px" class="show-hour">{{date("H")}}</span><span style="font-size:1.3em;display:inline-block;">:00-</span><span class="show-hour" style="font-size:1.3em;display:inline-block;">{{date("H")}}</span><span style="font-size:1.3em;display:inline-block;">:59</span>
            </span>
            <a href="{{url('/building/')}}/{{$building}}"><span id="dept-name" >Dept. of </span></a>
          </div>

          <div id="status-big">
            <div style="height:8.3em;background:-webkit-linear-gradient(top,#fff,#f6f6f6);background:-moz-linear-gradient(top,#fff,#F1EFEF);">
                <div style="width:20%;font-weight:bold;display:inline-block;text-align:center;color:#999;position:relative;top:0px;font-size:1.4em">1<sup>st</sup> - Today</div>
                <div style="font-size:3.4em;text-align:right;width:55%;display:inline-block;margin-top:25px;color:#707070;font-weight:normal;"><span id="show-energy"> ... </span><span style="font-size:50%;font-weight:lighter;">&nbsp kWh</span></div>
                <div class="box-percentage-status percentage" style="background-color:transparent;margin-top:0.1em"><span style="font-size:1.4em;" id="show_percent_energy">100</span><span style="font-size:40%;">%</span></div>
            </div>
          </div>
          <div id="status-chart-acc">
            <div style="height:2.5em;background:-webkit-linear-gradient(top,#eee,#e0e0e0);background:-moz-linear-gradient(top,#eee,#e0e0e0);">
              <span id="daily-consumed">Daily Consumed Energy Accumulation <span id="daily-energy"> ... </span> kWh</span>
              <span class="text-percentage-status percentage" style="background-color:transparent;line-height:1.6em;display:inline-block;width:8.3em;text-align:center;font-size:0.9em;float:right;margin:8px 6px 4px 6px;color:white;font-weight:bold;">Level 2</span>
            </div>
            <div style="height:40px;line-height:40px;font-size:1.2em;color:#707070;">
              <span style="margin:0 0 0 4px;">Current Demand <span id="show_power"> ... </span> kW</span>
              <span style="float:right;margin-right:4px;">Peak Demand <span id="show_max_power"> ... </span> kW</span>
            </div>
          </div>
          <div id="status-chart-line">

            <div id="chart_container" style="height:200px; width:100%;" >
            </div>
              <span style="margin:0 0 0 4px;"><hr style="background-color:#F5C922;height:3px;float:left;width:20px;margin-top:5px;">&emsp;Warning Level <span id="warning_level"></span> kW</span>
              <span style="float:right;margin-right:4px;"><hr style="background-color:#bc250c;height:3px;float:left;width:20px;margin-top:5px;">&emsp;Alert Level <span id="alert_level"></span> kW</span>
          </div>
          <div id="Donutchart">

          </div>
        </div>
      </div>
      <div class="col-sm-2">
        <div id="show-main-map" style="width:50%">
            <a href="{{url('/')}}"><img src="{{asset('images/home/map-btn.png')}}" style="position:absolute;right:0em;top:25em;cursor: pointer;">
        </div>
      </div>
    </div>
  </div>


</body>
</div>

<!-- get data -->
<script type="text/javascript">
function energy_level(real,target){
  var percentage = Math.round((real/target)*100)
  $("#show_percent_energy").html(percentage);
  if(percentage < 85){
    $(".percentage").css("backgroundColor", "#44C049");
    $(".text-percentage-status").html("Level 1");
  }else if(percentage >= 85 && percentage < 93){
    $(".percentage").css("backgroundColor", "#F5C922");
    $(".text-percentage-status").html("Level 2");
  }else{
    $(".percentage").css("backgroundColor", "#F44336");
    $(".text-percentage-status").html("Level 3");
  }
}
startProcess();

// function getOverview(building) {
//   $("#show-maps").hide();
//   $("#show-overview").show();
//   // startProcess();
// // $.blockUI({ message: 'Just a moment...</h1>' });
//   setTimeout(function(){
//     homepage(building).done(function(data){
//       // console.log(data);
//       // $('#aboutus').modal('toggle');
//       // parse data from api and put in html page
//       $("#show-energy").html(data['energy']['total'].toLocaleString());
//       $("#show-energy-map").html(data['energy']['total'].toLocaleString());
//       $("#daily-energy").html(data['energy']['today'].toLocaleString());
//       $("#show_power").html(data['power']['current'].toLocaleString());
//       $("#show_max_power").html(data['power']['max'].toLocaleString());
//       $("#alert_level").html(data['alert']['alert_level'].toLocaleString());
//       $("#warning_level").html(data['alert']['warning_level'].toLocaleString());
//       $("#dept-name").html(data['building']['building_name']);
//       $("#faculty-name").html(data['building']['faculty_name']);
//       energy_level(data['energy']['total'],data['alert']['kwh_target']);
//       // console.log(building);
//       mainchart('chart_container',data);
//       Donutchart('Donutchart',building,data['donutData']);
//       }).complete(function(){endProcess();});
//   },750);
// }

setTimeout(function(){
  overview('{{$building}}').done(function(data){
    console.log(data);
    // $('#aboutus').modal('toggle');
    // parse data from api and put in html page
    $("#dept-id").html('{{$building}}');
    $("#show-energy").html(data['energy']['total'].toLocaleString());
    $("#show-energy-map").html(data['energy']['total'].toLocaleString());
    $("#daily-energy").html(data['energy']['today'].toLocaleString());
    $("#show_power").html(data['power']['current'].toLocaleString());
    $("#show_max_power").html(data['power']['max'].toLocaleString());
    $("#alert_level").html(data['alert']['alert_level'].toLocaleString());
    $("#warning_level").html(data['alert']['warning_level'].toLocaleString());
    $("#dept-name").html(data['building']['building_name']);
    $("#faculty-name").html(data['building']['faculty_name']);
    energy_level(data['energy']['total'],data['alert']['kwh_target']);
    mainchart('chart_container',data);
    Donutchart('Donutchart','{{$building}}',data['donutData']);
    }).complete(function(){endProcess();});
},750);

    setInterval(function(){
      overview('{{$building}}').done(function(data){
        // parse data from api and put in html page
        $("#show-energy").html(data['energy']['total'].toLocaleString());
        $("#show-energy-map").html(data['energy']['total'].toLocaleString());
        $("#daily-energy").html(data['energy']['today'].toLocaleString());
        $("#show_power").html(data['power']['current'].toLocaleString());
        $("#show_max_power").html(data['power']['max'].toLocaleString());
        energy_level(data['energy']['total'],data['alert']['kwh_target']);
        mainchart('chart_container',data);
        Donutchart('Donutchart','EE&IT',data['donutData']);
      });
    }, 5*60000);
</script>

@endsection
