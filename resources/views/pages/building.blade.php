@extends('layouts.2nd-layout')

@section('content')
<script src="{{asset('js/chart.js')}}"></script>
<body>
  <div class="container">
    <div class="row mepet">
      <div class="left-build-container">
        <p>
          sebelah kiri
        </p>
      </div>
      <div class="right-build-container">

          <div style="font-size:1.9em;color:#93C120;">Electrical Engineering and Information Technology</div>
          <div style="font-size:1em;color:#028EC1;">DTETI Bld.</div>
          <div style="font-size:12px;color:red;float:right;background-color:transparent">Tip: Click on each floor area to go to floor level page</div>
            <hr style="background-color: #44ACD1;height:2px;">
          <div style="overflow-y:scroll;padding:0;height:30em;">
            <ul class="mepet">
              <li id="show_floor0">
               <div class="col-sm-12 mepet">
                   <div class="mepet" style="width:53%;display:inline-block;">
                         <div class="status_floor_detail" style="background-color:white;display:inline-block;">
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
                        <div class="status_floor0_chart" style="display:inline-block;min-width:47%;height:230px;float:right;">
                            <div style="line-height:20px;font-size:0.7em;color:#707070;background-color:#FFF">
                                    <span style="margin:0 0 0 4px;">Current Demand <span id="'+bld_pnt_name+'_show_power'+show_data+'"></span> kW</span>
                                    <span style="float:right;margin-right:4px;">Peak Demand kW</span>
                                <div id="floor0_chart" class="floor-chart"></div>
                                <script type="text/javascript">buildingchart('floor0_chart');</script>
                                <div style="background-color:#F9FAFC;margin-top:-5px"><span style="margin:0 0 0 4px;"><hr style="background-color:#F5C922;height:2px;float:left;width:15px;margin-top:8px;">&nbsp;Warning Level kW)</span>
                                    <span style="float:right;margin-right:4px;"><hr style="background-color:#bc250c;height:2px;float:left;width:15px;margin-top:8px;">&nbsp; Alert Level kW)</span></div>
                            </div>
                        </div>
                        <div style="clear:both;"></div>
                        <hr style="width:100%;height:2px;background-color:#eee;margin-top:-10px">
                </div>
             </li>

             <li id="show_floor0">
               <div class="col-sm-12 mepet">
                    <div class="mepet" style="width:53%;display:inline-block;">
                          <div class="status_floor_detail" style="background-color:white;display:inline-block;">
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
                         <div class="status_floor0_chart" style="display:inline-block;min-width:47%;height:230px;float:right;">
                             <div style="line-height:20px;font-size:0.7em;color:#707070;background-color:#FFF">
                                     <span style="margin:0 0 0 4px;">Current Demand <span id="'+bld_pnt_name+'_show_power'+show_data+'"></span> kW</span>
                                     <span style="float:right;margin-right:4px;">Peak Demand kW</span>
                                 <div id="floor1_chart" class="floor-chart" ></div>
                                 <script type="text/javascript">buildingchart('floor1_chart');</script>
                                 <div style="background-color:#F9FAFC;margin-top:-5px"><span style="margin:0 0 0 4px;"><hr style="background-color:#F5C922;height:2px;float:left;width:15px;margin-top:8px;">&nbsp;Warning Level kW)</span>
                                     <span style="float:right;margin-right:4px;"><hr style="background-color:#bc250c;height:2px;float:left;width:15px;margin-top:8px;">&nbsp; Alert Level kW)</span></div>
                             </div>
                         </div>
                         <div style="clear:both;"></div>
                         <hr style="width:100%;height:2px;background-color:#eee;margin-top:-10px">
                 </div>

              </li>
              <li id="show_floor0">
                <div class="col-sm-12 mepet">
                     <div class="mepet" style="width:53%;display:inline-block;">
                           <div class="status_floor_detail" style="background-color:white;display:inline-block;">
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
                          <div class="status_floor0_chart" style="display:inline-block;min-width:47%;height:230px;float:right;">
                              <div style="line-height:20px;font-size:0.7em;color:#707070;background-color:#FFF">
                                      <span style="margin:0 0 0 4px;">Current Demand <span id="'+bld_pnt_name+'_show_power'+show_data+'"></span> kW</span>
                                      <span style="float:right;margin-right:4px;">Peak Demand kW</span>
                                  <div id="floor2_chart" class="floor-chart" ></div>
                                  <script type="text/javascript">buildingchart('floor2_chart');</script>
                                  <div style="background-color:#F9FAFC;margin-top:-5px"><span style="margin:0 0 0 4px;"><hr style="background-color:#F5C922;height:2px;float:left;width:15px;margin-top:8px;">&nbsp;Warning Level kW)</span>
                                      <span style="float:right;margin-right:4px;"><hr style="background-color:#bc250c;height:2px;float:left;width:15px;margin-top:8px;">&nbsp; Alert Level kW)</span></div>
                              </div>
                          </div>
                          <div style="clear:both;"></div>
                          <hr style="width:100%;height:2px;background-color:#eee;margin-top:-10px">
                  </div>

               </li>
             </ul>
            <hr style="background-color: #44ACD1;height:2px;">
            <div id="eng4_container_pie" style="width: 100%;display:inline-block;"></div>

          </div>

      </div>
    </div>

  </div>
  <!-- <a href="{{url('building/dteti')}}">Go to building details</a> -->
</body>




@endsection
