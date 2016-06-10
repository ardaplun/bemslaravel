@extends('layouts.main-layout')

@section('content')
<script src="{{asset('js/chart.js')}}"></script>
<body>
  <div class="container">
    <div class="row mepet" style="width:105%">
      <div class="left-build-container">
        kiri
      </div>
      <div class="right-build-container">

          <div style="font-size:1.9em;color:#93C120;">ELECTRICAL ENGINEERING AND INFORMATION TECHNOLOGY</div>
          <div style="font-size:1em;color:#028EC1;">{{$building}} Bld.</div>
          <div style="font-size:12px;color:red;float:right;background-color:transparent">Tip: Click on each floor area to go to floor level page</div>
            <hr style="background-color: #44ACD1;height:2px;">
          <div style="overflow:scroll;padding:0;height:30em;margin-right:-1.5em;">

            <ul class="mepet" >
            @forelse ($data_floors as $data_floor)

             <li id="show_{{$data_floor->id_floor}}">
               <a href="{{url('/building/')}}/{{$building}}/floor/{{$data_floor->id_floor}}"><div class="col-sm-12 mepet">
                   <div class="mepet" style="width:56.5%;display:inline-block;">
                         <div class="status_floor_detail" style="background-color:white;display:inline-block;width:100%">
                         <div>
                           <span id="status-jam-building" class="show-date">{{date("d M Y")}}</span>
                           <span id="faculty-name-building">Faculty of Engineering, Universitas Gadjah Mada</span>
                         </div>
                         <div style="background-color:#F8DAE6;line-height:1.3em" >
                           <span id="left-clock-building">
                           <span style="font-size:1.6em;margin-left:4px" class="show-hour">{{date("H")}}</span><span style="font-size:1.2em;display:inline-block;">:00-</span><span class="show-hour" style="font-size:1.2em">{{date("H")}}</span><span style="font-size:1.2em">:59</span>
                           </span>
                           <span id="floor-name">{{$data_floor->floor_name}} Floor</span>
                         </div>
                         <div style="height:92px;background:-webkit-linear-gradient(top,#fff,#f6f6f6);background:-moz-linear-gradient(top,#fff,#F1EFEF);line-height:3em;">
                           <div style="width:20%;left:1em;font-weight:bold;display:inline-block;text-align:center;color:#999;position:relative;top:0px;">
                             1<sup>st</sup> - Today
                           </div>
                           <div style="font-size:2.7em;text-align:right;width:55%;;display:inline-block;margin-top:20px;color:#707070;">
                             12.345,67<span id="'+bld_pnt_name+'_show_energy'+show_data+'"></span><span style="font-size:50%;"> kWh</span>
                           </div>
                           <div class="box-percentage-status" style="background-color:#F5C922;margin-top:0.1em;font-size:2em;">
                             <span id="show_percent_energy">100</span><span style="font-size:40%;">%</span>
                           </div>
                         </div>
                         <div style="height:2.5em;background:-webkit-linear-gradient(top,#eee,#e0e0e0);background:-moz-linear-gradient(top,#eee,#e0e0e0);">
                           <span id="daily-consumed" style="font-size:1.1em;line-height:2.5em">Daily Consumed Energy Accumulation 123.45  kWh</span>
                           <span class="text-percentage-status" style="background-color:#F5C922;line-height:1.6em;display:inline-block;width:6.6em;text-align:center;font-size:0.9em;float:right;margin:8px 6px 4px 6px;color:white;font-weight:bold;">Warning oi</span>
                         </div>
                         </div>
                   </div>
                        <div class="status__chart" style="display:inline-block;min-width:43%;height:230px;float:right;">
                            <div style="line-height:20px;font-size:0.7em;color:#707070;background-color:#FFF">
                                    <span style="margin:0 0 0 4px;">Current Demand <span id="'+bld_pnt_name+'_show_power'+show_data+'"></span> kW</span>
                                    <span style="float:right;margin-right:4px;">Peak Demand kW</span>
                                <div id="{{$data_floor->id_floor}}_chart" class="floor-chart"></div>
                                <script type="text/javascript">buildingchart('{{$data_floor->id_floor}}_chart');</script>
                                <div style="background-color:#F9FAFC;margin-top:-5px"><span style="margin:0 0 0 4px;"><hr style="background-color:#F5C922;height:2px;float:left;width:15px;margin-top:8px;">&nbsp;Warning Level 123 kW</span>
                                    <span style="float:right;margin-right:4px;"><hr style="background-color:#bc250c;height:2px;float:left;width:15px;margin-top:8px;">&nbsp; Alert Level 123 kW</span></div>
                            </div>
                        </div>
                        <div style="clear:both;"></div>
                        <hr style="width:100%;height:2px;background-color:#eee;margin-top:-10px">
                </div></a>
             </li>
             @empty
                <p>No data for this building</p>
             @endforelse
             <li><div id="{{$building}}_container_pie" style="width: 100%;display:inline-block;"></div></li>
             <script type="text/javascript">Donutchart('{{$building}}_container_pie','{{$building}}');</script>
             </ul>
            <hr style="background-color: #44ACD1;height:2px;">

          </div>

      </div>
    </div>

  </div>
  <!-- <a href="{{url('building/dteti')}}">Go to building details</a> -->
</body>




@endsection
