@extends('layouts.main-layout')

@section('content')
<script src="{{asset('js/chart.js')}}"></script>
<script src="{{asset('js/jquery.slimscroll.js')}}"></script>
<script src="{{asset('js/tree.js')}}"></script>
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
            <div class="col-sm-12" style="padding: 0em 3em 0em 4em;">

              <div class="col-sm-5 mepet" >

                  @if ($data->room_category === 'Laboratory')
                    <h2><div><img src="{{asset('images/icon/research_lab_ss.png')}}"/>{{$data->room_category}}</div></h2>
                  @elseif($data->room_category === 'Lecture')
                    <h2><div><img src="{{asset('images/icon/class_room_ss.png')}}"/>{{$data->room_category}}</div></h2>
                  @elseif($data->room_category === 'Student')
                    <h2><div><img src="{{asset('images/icon/share_office_ss.png')}}"/>{{$data->room_category}}</div></h2>
                  @endif

                  <div class="box-transparent-redius" style="background-color: #fff;">
                    <div id="show_room_img">
                      <img src="{{asset('images/plans/EE_LAB_examples.png')}}" style="max-height:250px;width:400px;">
                    </div>
                    <div id="show_table">

                    </div>
                    <br />
                    <div id="show_ref_img">

                    </div>
                    <div class="box-gray-redius" style="">
                    <!--Map meaning-->
                        <span><img src="{{asset('images/icon/light_ss.png')}}"> <small>Light</small></span>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <span><img src="{{asset('images/icon/multi_ss.png')}}"> <small>Multi Sensor</small></span>
                        &nbsp;&nbsp;&nbsp;
                        <span><img src="{{asset('images/icon/outlet_ss.png')}}"> <small>Outlet</small></span></br>
                        <span><img src="{{asset('images/icon/air_cond.png')}}"> <small>Air Cond</small></span>
                        &nbsp;&nbsp;
                        <span><img src="{{asset('images/icon/air_3ph.png')}}"> <small>Air Cond 3 phase</small></span>&nbsp;&nbsp;&nbsp;
                    </div>
                  </div>
                  <div class="box-gray-redius">
                    <div class="row">
                      <div class="col-md-12">
                        <!--site manager-->
                        <div class="site-manager-header txt_white">Site Manager</div>
                        <div id="slimscroll" class="tree" style="display:inline-block;">
                          <ul>
                            <li class="parent_li">
                              <span class="badge badge-home"><i class="icon-home"></i> Electrical Engineering & Information Technology</span>
                              <ul>
                                <li style="display:list-style" class="parent_li">
                                  <span class="badge badge-success"><i class="icon-minus-sign"></i>3rd Floor</span>
                                  <ul>
                                    <li style="display:list-style" class="parent_li">
                                      <span class="badge badge-success hidden-node"><i class="icon-plus-sign"></i>South</span>
                                      <ul>
                                        <li><a class="hidden-node" href="#"><span><i class="icon-leaf"></i>Lab. E-System</span></a>
                                        </li>
                                        <li><a class="hidden-node" href="#"><span><i class="icon-leaf"></i>E6 Room</span></a>
                                        </li>
                                      </ul>
                                    </li>

                                  </ul>
                                </li>
                              </ul>
                            </li>
                          </ul>
                        </div>
                        <script type="text/javascript" src="js/tree.js"></script>
                      </div>
                    </div> <!--End row-->
                    <br />
                  </div>


              </div>
              <div class="col-sm-7" >
                <div class="location-room-stay">
                  <div class="location-floor">
                    <div class="location-bar-title">LOCATION: </div>
                    <div id="floor_lv" class="location-floor-number txt_large txt_blue">{{$data->id_floor}}</div>
                    @if($data->id_floor == 1)
                    <div class="location-floor-suffix">
                      <div class="txt_blue">st<small id="floor_suffix"></small></div>
                    @elseif($data->id_floor == 2)
                    <div class="location-floor-suffix">
                      <div class="txt_blue">nd<small id="floor_suffix"></small></div>
                    @elseif($data->id_floor == 3)
                    <div class="location-floor-suffix">
                      <div class="txt_blue">rd<small id="floor_suffix"></small></div>
                    @elseif($data->id_floor == UG)
                    <div class="location-floor-suffix">
                      <div class="txt_blue"><small id="floor_suffix"></small></div>
                    @else
                    <div class="location-floor-suffix">
                      <div class="txt_blue">th<small id="floor_suffix"></small></div>
                    @endif
                      <div>FLOOR</div>
                    </div>
                  </div>

                  <div class="location-room" style="margin-right: -15px;">
                    <div class="location-bar-title">ROOM: </div>
                    <span id="room_name" style="position: absolute; font-size: 1.5em; padding-top: 17px;overflow:hidden;text-overflow:ellipsis;width:350px;color:white">{{$data->room_name}}</span>
                  </div>
                </div>

                  <div class="box-gray-redius" style="margin-top:1em">
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
                          <span>Excelent</span>
                          <img src="{{asset('images/medal.png')}}" style="position:absolute;right:4em;top:2em"/>
                        </div>
                    </div><!--End row-->
                    <div class="row">
                      <!-- <div class="col-sm-8" id="show_floor" style="display:inline-block;">
                      <div style="padding-left: 10px;padding-top:1em;font-size:1.2em" class="txt_blue"><strong>Room : {{$data->room_name}}</strong></div>
                        <div style="line-height:1.4em;">
                        <div style="width:24%;display:inline-block">Energy: '+energy_percent+'%</div>
                        <div id="energy_num" style="width:37%;float:right;display:inline-block;background-image:none;color:'+txtcolor_e+';font-size: 19px;">'+energy_value.toFixed(val_decimal)+' kWh.</div>
                            <div class="progress-new" style="width:38%;display:inline-block;">
                            <div class="progress-bar '+energy_class_lv+'"style="width:'+energy_percent +'%;background-image:none;float:right;"></div>
                            </div>
                        </div>
                      </div> -->
                      <div id="floor'+show_data+'" style="display:inline-block;padding-left:25px;padding-top: 15px"></div>

                      <div style="width:420px;padding-left:2em">
                        <div style="color:#008ec3"><b>Room : {{$data->room_name}}</b></div>
                          <!-- <div style="margin-bottom:1px">';
                            <div style="line-height:1.4em;"> ';
                              <div style="width:24%;display:inline-block">Energy: '+energy_percent+'%</div>';
                              <div id="energy_num" style="width:37%;float:right;display:inline-block;background-image:none;color:'+txtcolor_e+';font-size: 19px;">'+energy_value.toFixed(val_decimal)+' kWh.</div>';
                              <div class="progress-new" style="width:38%;display:inline-block;">';
                                <div class="progress-bar '+energy_class_lv+'"style="width:'+energy_percent +'%;background-image:none;float:right;"></div>';
                              </div>';
                            </div>';
                            <div style="line-height:1.4em;"> ';
                              <div style="width:24%;display:inline-block">Power: '+power_percent+'%</div>';
                              <div id="power_num" style="width:37%;float:right;display:inline-block;background-image:none;color:'+txtcolor_p+';font-size: 19px;">'+power_value.toFixed(val_decimal)+' kW.</div>';
                              <div class="progress-new" style="width:38%;display:inline-block;">';
                                <div class="progress-bar '+power_class_lv+'"  style="width: '+power_percent+'%;background-image:none;float:right;position:relative;"></div>';
                              </div>';
                            </div>';
                             <div style="font-size:80%; "><small>Peak demand '+peak_power.toFixed(val_decimal)+' kW</small></div>';
                          </div> -->
                       </div>
                       <div style="line-height:1em;padding-left:2em">
                          <div style="width:22%;display:inline-block">Energy : 12%</div>
                          <div class="progress-new" style="width:45%;display:inline-block;">
                            <div class="progress-bar slide_lv2"style="width:50%;background-image:none;float:right;">
                              <div id="energy_num" style="color:black;position:absolute;right:18em;text-shadow:none">12.2 kWh</div>
                            </div>
                          </div>
                       </div>
                      <div style="line-height:1em;padding-left:2em">
                        <div style="width:22%;display:inline-block">Power &nbsp;: 12%</div>
                        <div class="progress-new" style="width:45%;display:inline-block;">
                          <div class="progress-bar slide_lv1"  style="width: 15%;background-image:none;float:right;">
                            <div id="power_num" style="color:black;position:absolute;right:18em;text-shadow:none">12.2 KW</div>
                          </div>
                        </div>
                      </div>
                      <div style="font-size:80%;float:left;padding-left:2.5em "><small id="peak_num">Peak demand</small></div>

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
                 <script type="text/javascript">Donutchart('container_pie0', '{{$room}}');</script>
                </div>
              </div> <!--End row-->
              <hr />
              <div class="row">
                <div class="col-md-12">Power Profile:</div>
                </br>
                <div class="col-md-12">
                 <!--chart area-->
                 <div id="container_sum" style="width:100%;height:200px;">Bar Chart</div>
                 <script type="text/javascript">buildingchart('container_sum');</script>
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



<script type="text/javascript">
// $('#slimscroll').append(html_string);

$('#slimscroll').slimscroll({
    height: '360px',
    width: '100%'
});

$('.hidden-node').parent().hide('fast');
$('.hidden-node').attr('title', 'Expand this branch').find(' > i').addClass('icon-plus-sign').removeClass('icon-minus-sign');
</script>





<!-- <script src="{{asset('js/tree.js')}}"></script> -->
@endsection
