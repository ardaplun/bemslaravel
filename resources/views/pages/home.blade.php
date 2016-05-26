@extends('layouts.layout')

@section('content')
<script src="{{asset('js/chart.js')}}"></script>
<script type="text/javascript">
</script>
<!-- title content -->
<div id="chart-title">
      <div class="upline-title">STATUS</div>
          <div class="line-title">
            <div class="cycle-title"></div>
          </div>
      <div class="bottomline-title">OVERVIEW</div>
</div>

<body>
  <div class="container">
    <div class="row">
      <div class="col-sm-8 col-sm-offset-2">
        <div style="background-color:white;">
          <div id="top-status">
            <span id="status-jam" class="show-date">lol</span>
            <span id="faculty-name" >Faculty of Engineering, Universitas Gadjah Mada</span>
          </div>
          <div id="middle-status" style="background-color:#F8DAE6;">
            <span id="left-clock">
            <span style="font-size:1em;margin:4px 0 0 4px;">88</span>
            <span style="font-size:1em;display:inline-block;">:00-99:59</span>
            </span>
            <span id="dept-name">Dept. Electrical Engineering and Information Technology</span>
          </div>
          <!-- generate status overview -->
          <div id="status-big">
            <div style="height:6.5em;background:-webkit-linear-gradient(top,#fff,#f6f6f6);background:-moz-linear-gradient(top,#fff,#F1EFEF);">
                <div style="width:20%;font-weight:bold;display:inline-block;text-align:center;color:#999;position:relative;top:0px;font-size:1em">1<sup>st</sup> - Today</div>
                <div style="font-size:2.5em;text-align:right;width:50%;display:inline-block;margin-top:20px;color:#707070;font-weight:bold;"><span id="show-energy" >12.345,67&nbsp</span><span style="font-size:50%;font-weight:lighter;">kWh</span></div>
                <div class="box-percentage-status" style="background-color:#F5C922;margin-top:0.1em"><span id="show_percent_energy">100</span><span style="font-size:40%;">%</span></div>
            </div>
          </div>
          <div id="status-chart-acc">
            <div style="height:2.5em;background:-webkit-linear-gradient(top,#eee,#e0e0e0);background:-moz-linear-gradient(top,#eee,#e0e0e0);">
              <span id="daily-consumed">Daily Consumed Energy Accumulation 123.45  kWh</span>
              <span class="text-percentage-status" style="background-color:#F5C922;line-height:1.6em;display:inline-block;width:6.6em;text-align:center;font-size:0.9em;float:right;margin:8px 6px 4px 6px;color:white;font-weight:bold;">Warning oi</span>
            </div>
            <div style="height:40px;line-height:40px;font-size:1em;color:#707070;">
              <span style="margin:0 0 0 4px;">Current Demand <span id="show_power">123</span> kW</span>
              <span style="float:right;margin-right:4px;">Peak Demand 234 kW</span>
            </div>
          </div>
          <div id="status-chart-line">
            <!-- generate chart -->
            <div id="all_container" style="height:200px; width:100%;" >
            </div>
              <span style="margin:0 0 0 4px;"><hr style="background-color:#F5C922;height:3px;float:left;width:20px;margin-top:5px;">&emsp;Warning Level 98 kW</span>
              <span style="float:right;margin-right:4px;"><hr style="background-color:#bc250c;height:3px;float:left;width:20px;margin-top:5px;">&emsp;Alert Level 87 kW</span>
          </div>
        </div>
      </div>
      <!-- <div class="col-sm-2 col-sm-offset-10">
        <div id="show-main-map" style="width:50%">
            <img src="{{asset('images/home/map-btn.png')}}" class="pointer-mouse">
        </div>
      </div> -->


    </div>

  </div>
  <a href="{{url('building/dteti')}}">Go to building details</a>
</body>
@endsection
