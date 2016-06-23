@extends('layouts.2nd-layout')

@section('content')
<script src="{{asset('js/chart.js')}}"></script>
<script src="{{asset('js/jquery.slimscroll.js')}}"></script>
<script src="{{asset('js/tree.js')}}"></script>
<script type="text/javascript">
$(document).ready(function() {


  function create_table(){
      var row_number = 9 ;
      var column_number= 15;
      $('#show_table').append('<table id=\'myTable\'  style="table-layout:fixed; z-index :2; Position: relative; display:inline-block;width:400px;"></table>');
        //loop for row
      for (j=1;j<=row_number;j++)
      {
        $('table#myTable').append('<tr></tr>');
      }
        //loop for columns
      for (i=1;i<=column_number;i++)
      {
        $('table#myTable tr').append('<td></td>');
      }
  }
  create_table();
  var data_sensor=<?php echo json_encode($data_sensor); ?>;
  console.log(data_sensor);

  data_sensor.forEach(function(data_sensor){
      var devices=document.getElementById("myTable").rows[data_sensor.row].cells[data_sensor.col];
      console.log(devices.img);
      devices.innerHTML= "<a title=\""+data_sensor.sensor_name+" Group\" >"+
                          "<img status='unselect' cell="+data_sensor.col+" row="+data_sensor.row+" title=\""+data_sensor.sensor_name+"\" onclick='SensorPick(this)' class='device_icon' src ='"+data_sensor.img+"' style='opacity: 1;'>"+
                          "</a>";
      // devices.innerHTML= "<a title=\""+data_sensor.sensor_name+" Group\" >"+
      //                       "<div style='background: light-grey;display:inline-block;position:relative'>"+
      //
      //                           "<img status='unselect' cell="+data_sensor.col+" row="+data_sensor.row+" title=\""+data_sensor.sensor_name+"\" onclick='SensorPick(this)' class='device_icon' src ='{{asset('images/icon/"+data_sensor.img+"')}}' style='opacity: 1;'>"+
      //                       "</div>"+
      //                     "</a>";
  });
});
</script>
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
              <div class="row" id="compare_graph">
                  <div style="display:none;height: 35px;" id="close_chart" ><button type="button" style="float:right;" class="btn btn-default" onClick="RemoveMultiGraph()" >Close</button></div>
                  <div id="container_sensor" style="height:0px;"></div>
                  <div id="sensor_box" ></div>
              </div>
              <div class="col-sm-5 mepet" >

                  @if ($data->room_category === 'Laboratory')
                    <h2><img src="{{asset('images/icon/research_lab_ss.png')}}"/>{{$data->room_category}}</h2>
                  @elseif($data->room_category === 'Classroom')
                    <h2><div><img src="{{asset('images/icon/class_room_ss.png')}}"/>{{$data->room_category}}</h2>
                  @elseif($data->room_category === 'Studentroom')
                    <h2><img src="{{asset('images/icon/share_office_ss.png')}}"/>{{$data->room_category}}</h2>
                  @endif

                  <div class="box-transparent-redius" style="background-color: #fff;">
                    <div id="show_room_img" style="z-index:1;position:absolute">
                      <img src="{{asset('images/plans/EE_LAB_examples.png')}}" style="max-height:250px;width:400px;">
                    </div>
                    <div id="show_table">

                    </div>
                    <br />
                    <div id="show_ref_img">

                    </div>
                    <div class="box-gray-redius" style="">
                    <!--Map meaning-->
                        <span><img src="{{asset('images/icon/light_ss.png')}}"> <small>Light</small></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <span><img src="{{asset('images/icon/multi_ss.png')}}"> <small>Multi Sensor</small></span>&nbsp;&nbsp;&nbsp;
                        <span><img src="{{asset('images/icon/outlet_ss.png')}}"> <small>Outlet</small></span></br>
                        <span><img src="{{asset('images/icon/air_cond.png')}}"> <small>Air Cond</small></span>&nbsp;&nbsp;
                        <span><img src="{{asset('images/icon/air_3ph.png')}}"> <small>Air Cond 3 phase</small></span>&nbsp;&nbsp;&nbsp;
                    </div>
                  </div>
                  <div class="box-gray-redius">
                    <div class="row">
                      <div class="col-md-12">
                        <!--site manager-->
                        <div class="site-manager-header txt_white">Site Manager</div>
                        <!-- <ul id="test">
                          <script type="text/javascript">
                            var temp=[];
                            var data=<?php echo json_encode($data_site); ?>;

                            console.log(data);
                            data.forEach(function(data){
                            console.log(data.floor_name,data.room_area);
                              if(temp.indexOf(data.floor_name,data.room_area)===-1){
                                temp.push(data.floor_name,data.room_area);
                                $("#test").append('<li>'+data.floor_name+'<br>'+data.room_area+'<br>'+data.room_name+'</li>');
                              }else{
                                $("#test").append('<li><br>'+data.room_name+'</li>');

                               }
                              console.log(temp);

                            });
                          </script>
                        </ul>
                        <br><br> -->

                        <div id="slimscroll" class="tree" style="display:inline-block;">
                          <ul>
                            <li class="parent_li">
                              <span class="badge badge-home"><i class="icon-home"></i> Electrical Engineering & Information Technology</span>
                              <ul>

                                <li style="display:list-style" class="parent_li">
                                  <span class="badge badge-success"><i class="icon-minus-sign"></i>3rd Floor</span>
                                  <ul>
                                    <li style="display:list-style" class="parent_li">
                                      <span class="badge badge-success hidden-node"><i class="icon-plus-sign"></i>North</span>
                                      <ul>
                                        <li><a class="hidden-node" href="LABSFT"><span><i class="icon-leaf"></i>Lab. High Frequency System</span></a>
                                        </li>
                                      </ul>
                                    </li>
                                    <li style="display:list-style" class="parent_li">
                                      <span class="badge badge-success hidden-node"><i class="icon-plus-sign"></i>South</span>
                                      <ul>
                                        <li><a class="hidden-node" href="LABSE"><span><i class="icon-leaf"></i>Lab. E-System</span></a>
                                        </li>
                                        <li><a class="hidden-node" href="E6"><span><i class="icon-leaf"></i>E6 Room</span></a>
                                        </li>
                                      </ul>
                                    </li>

                                  </ul>
                                </li>
                              </ul>
                            </li>
                          </ul>
                        </div>
                        <!-- <script type="text/javascript" src="js/tree.js"></script> -->
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

                          <div class="btn-group">
                            <button type="button" class="range_pick btn btn-default" onclick="blockUI();" value="day">Day</button>
                            <button type="button" class="range_pick btn btn-default" onclick="blockUI();" value="month">Month</button>
                            <button type="button" class="range_pick btn btn-default" onclick="blockUI();" value="year">Year</button>
                          </div>
                        </div>
                        <div class="col-md-3" id="medal_show">
                          <span>Excelent</span>
                          <img src="{{asset('images/medal_good.png')}}" style="position:absolute;right:4.4em;top:1.5em"/>
                        </div>
                    </div>
                    <div class="row">

                      <div id="floor'+show_data+'" style="display:inline-block;padding-left:25px;padding-top: 15px"></div>

                      <div style="width:420px;padding-left:2em">
                        <div style="color:#008ec3"><b>Room : {{$data->room_name}}</b></div>

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
                 <script type="text/javascript">Donutchart('container_pie0', '{{$data->id_room}}');</script>
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
