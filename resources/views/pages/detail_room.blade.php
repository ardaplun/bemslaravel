@extends('layouts.main-layout')

@section('content')
<script src="{{asset('js/chart.js')}}"></script>
<div id="chart-title">
      <div class="upline-title">ROOM</div>
          <div class="line-title">
            <div class="cycle-title"></div>
          </div>
      <div class="bottomline-title">SECTION</div>
</div>

<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">

              <div class="col-sm-5" >
                  <h2>{{$data->room_category}}</h2>
              </div>
              <div class="col-sm-7" >
                <div class="location-room-stay">
                  <div class="location-floor">
                    <div class="location-bar-title">LOCATION: </div>
                    <div id="floor_lv" class="location-floor-number txt_large txt_blue">1</div>
                    <div class="location-floor-suffix"><div class="txt_blue">th<small id="floor_suffix"></small></div><div>FLOOR</div></div>
                  </div>
                  <div class="location-room" style="margin-right: -15px;">
                    <div class="location-bar-title">ROOM: </div>
                    <span id="room_name" style="position: absolute; font-size: 1.5em; padding-top: 17px;overflow:hidden;text-overflow:ellipsis;width:350px;color:white">{{$data->room_name}}</span>
                  </div>
                </div>

                  <div class="box-gray-redius">
                    <div class="row">
                        <div class="col-md-3"><div style="padding-left: 10px">GROUP :</div></div>
                        <div class="col-md-6">
                          <!--Grouping button-->
                          <div class="btn-group">
                            <button type="button" class="range_pick btn btn-default" onclick="blockUI();" value="day">Day</button>
                            <button type="button" class="range_pick btn btn-default" onclick="blockUI();" value="month">Month</button>
                            <button type="button" class="range_pick btn btn-default" onclick="blockUI();" value="year">Year</button>
                          </div>
                        </div>
                        <div class="col-md-3" id="medal_show">

                        </div>
                    </div><!--End row-->
                    <div class="row">
                      <div class="col-sm-8" id="show_floor" style="display:inline-block;">
                      <div style="padding-left: 10px;padding-top:1em;font-size:1.2em" class="txt_blue"><strong>Room : {{$data->room_name}}</strong></div>
                        <div style="line-height:1.4em;">
                        <div style="width:24%;display:inline-block">Energy: '+energy_percent+'%</div>
                        <div id="energy_num" style="width:37%;float:right;display:inline-block;background-image:none;color:'+txtcolor_e+';font-size: 19px;">'+energy_value.toFixed(val_decimal)+' kWh.</div>
                            <div class="progress-new" style="width:38%;display:inline-block;">
                            <div class="progress-bar '+energy_class_lv+'"style="width:'+energy_percent +'%;background-image:none;float:right;"></div>
                            </div>
                        </div>
                      </div>

                    </div>

                  </div>
                  <div class="box-gray-redius">

              <div class="row">
                <div class="col-md-4 txt_blue"><strong>ROOM OVERVIEW</strong> <br /><br /></div>
              </div>

              <div class="row">
                <div class="col-md-12">Energy Usage:</div>
                <div class="col-md-12">
                 <!--chart area-->
                 <div id="container_pie0" style="width:100%;height:300px;">Pie Chart</div>
                </div>
              </div> <!--End row-->
              <hr />
              <div class="row">
                <div class="col-md-12">Power Profile:</div>
                </br>
                <div class="col-md-12">
                 <!--chart area-->
                 <div id="container_sum" style="width:100%;height:200px;">Bar Chart</div>
                </div>
              </div> <!--End row-->
              </br>
              <div class="row">
                <div class="col-md-3">Power Display:</div>
                <div class="col-md-9">
                  <div class="btn-group">
                    <button type="button" id="room_btn" class="type_pick btn btn-default" value="all">Room Overview</button>
                    <button type="button" id="air_btn" class="type_pick btn btn-default" value="aircon" style="display:none;">Air</button>
                    <button type="button" id="light_btn" class="type_pick btn btn-default" value="light" style="display:none;">Light</button>
                    <button type="button" id="outlet_btn" class="type_pick btn btn-default" value="outlet" style="display:none;">Outlet</button>
                  </div>
                </div>
              </div> <!--End row-->
            <br />
            </div><!--End box-gray-redius-->
              </div>

            </div>
        </div>
    </div>









<!-- <section id="slider">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
              <center><p>
                this buildiiiiing is {{$building}} floor {{$floor}} and room {{$room}}
              </p><center>

            </div>
        </div>
    </div>
</section> -->
@endsection
