@extends('layouts.2nd-layout')

@section('content')
<script src="{{asset('js/chart.js')}}"></script>
<script type="text/javascript">
</script>

<body>
  <div class="container">
    <div class="row">
      <div class="col-sm-4">
        <p>
          sebelah kiri
        </p>
      </div>
      <div class="col-sm-8 mepet" style="margin-left:-3em;">

          <div style="font-size:1.9em;color:#93C120;">Electrical Engineering and Information Technology</div>
          <div style="font-size:1em;color:#028EC1;">Eng Bld. 4</div>
          <div style="font-size:12px;color:red;float:right;background-color:transparent">Tip: Click on each floor area to go to floor level page</div>
            <hr style="background-color: #44ACD1;height:2px;">
          <div style="overflow:scroll;padding:0">
            <div id="show_floor_eng4">

              <div class="col-sm-12 mepet">
               <div class="mepet" style="width:60%;display:inline-block;">
                 <div class="ee-status-detail" style="background-color:white;display:inline-block;">
                 <div>
                   <span id="status-jam-building" class="show-date"></span>
                   <span id="faculty-name-building">Faculty of Engineering, Universitas Gadjah Mada</span>
                 </div>
                 <div style="background-color:#F8DAE6;line-height:1em" >
                   <span id="left-clock-building">
                   <span style="font-size:1.1em;margin-left:4px" class="show-hour"></span><span style="font-size:1em;display:inline-block;">:00-</span><span class="show-hour"></span><span>:59</span>
                   </span>
                   <span id="floor-name">Underground Floor</span>
                 </div>
                 <div style="height:92px;background:-webkit-linear-gradient(top,#fff,#f6f6f6);background:-moz-linear-gradient(top,#fff,#F1EFEF);line-height:3em;">
                   <div style="width:20%;left:1em;font-weight:bold;display:inline-block;text-align:center;color:#999;position:relative;top:0px;">
                     1<sup>st</sup> - Today
                   </div>
                   <div style="font-size:2.7em;text-align:right;width:55%;;display:inline-block;margin-top:20px;color:#707070;">
                     12.345,67<span id="'+bld_pnt_name+'_show_energy'+show_data+'"></span><span style="font-size:50%;"> kWh</span>
                   </div>
                   <div class="box-percentage-status" style="background-color:#F5C922;margin-top:0.1em">
                     <span id="show_percent_energy">100</span><span style="font-size:40%;">%</span>
                   </div>
                 </div>
                 <div style="height:2.5em;background:-webkit-linear-gradient(top,#eee,#e0e0e0);background:-moz-linear-gradient(top,#eee,#e0e0e0);">
                   <span id="daily-consumed">Daily Consumed Energy Accumulation 123.45  kWh</span>
                   <span class="text-percentage-status" style="background-color:#F5C922;line-height:1.6em;display:inline-block;width:6.6em;text-align:center;font-size:0.9em;float:right;margin:8px 6px 4px 6px;color:white;font-weight:bold;">Warning oi</span>
                 </div>
                 </div>

               </div>
               <div class="mepet" style="width:40%;display:inline-block;">
                 <div id="all_container" style="height:200px; width:100%;" >
                 </div>
               </div>
             </div>

            <hr style="background-color: #44ACD1;height:2px;">
            <div id="eng4_container_pie" style="width: 100%;display:inline-block;"></div>
            <br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
          </div>

      </div>
    </div>

  </div>
  <!-- <a href="{{url('building/dteti')}}">Go to building details</a> -->
</body>
@endsection
