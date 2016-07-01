@extends('layouts.2nd-layout')

@section('content')
<script src="{{asset('js/chart.js')}}"></script>
<script src="{{asset('js/kinetic-v4.6.0.js')}}"></script>
<script src="{{asset('js/kinetic-v4.6.0.min.js')}}"></script>

<body>
    <div class="container">
      <div id="chart-title">
            <div class="upline-title">FLOOR</div>
                <div class="line-title">
                  <div class="cycle-title"></div>
                </div>
            <div class="bottomline-title">SECTION</div>
      </div>

        <div class="row">
            <div class="col-sm-12">
              <a href="{{url('/building/')}}/{{$data->id_building}}"><span id="bld_lv" class="txt_pink" style="font-size:1.3em;font-weight:400;">ELECTRICAL ENGINEERING AND INFORMATION TECHNOLOGY</span></a> : <span id="floor_lv" class="txt_blue">{{$data->floor_name}} FLOOR</span>
              <div class="col-sm-7 mepet ">
                <div class="col-sm-6 mepet" style="padding-top:0.3em">
                  <div class="btn-group" style="border: 1px solid #B2B2B3;border-radius: 5px;width:100%">
                      <div class="btn-group " data-toggle="buttons" id="area_button" style="border: 1px solid #B2B2B3;border-radius: 3px;width:100%">
                        <label class="btn" disabled>
                          AREA :
                        </label>
                        <label class="btn area_pick" value="all" style="border-right: 1px solid #DAD8D8;">
                          <input type="radio" >All
                        </label>
                        <label class="btn area_pick" value="all" style="border-left: 1px solid #DAD8D8;">
                          <input type="radio" >North
                        </label>
                        <label class="btn area_pick" value="all" style="border-left: 1px solid #DAD8D8;">
                          <input type="radio" >South
                        </label>
                        <label class="btn area_pick" value="all" style="border-left: 1px solid #DAD8D8;">
                          <input type="radio" >Corridor
                        </label>
                      </div>

                  </div>
                  <div class="dropdown mode_black" style="cursor:pointer">
                    <div class="dropdown-toggle-black pointer-mouse" data-toggle="dropdown" onclick="javascript:$('.map_meaning').hide();" >
                      &emsp;<img src="{{asset('images/sort.png')}}"/>&nbsp;&nbsp; View Mode
                    </div>
                    <ul class="dropdown-menu dropdown-menu-black" style="z-index:9999999;" role="menu">
                        <li>
                          <a  onclick="show_icon();">Show Icon</a>
                        </li>
                        <li>
                          <a  onclick="show_icon(); show_icon_name();">Show Icon + Name</a>
                        </li>
                        <li>
                          <a  onclick="show_power_energy_bar();">Show Energy and Power Usage</a>
                        </li>
                    </ul>
                  </div>
                </div>
                <div class="col-sm-6 pull-right "  style="padding-top:0.3em">
                  <div class="btn-group" style="border: 1px solid #B2B2B3;border-radius: 5px;">
                      <div class="btn-group " data-toggle="buttons" style="border: 1px solid #B2B2B3;border-radius: 3px;" >
                        <label class="btn" disabled>
                          GROUP :
                        </label>
                        <label class="btn range_pick" onclick="blockUI();" value="day" style="border-right: 1px solid #DAD8D8;">
                          <input type="radio" >Day
                        </label>
                        <label class="btn range_pick" onclick="blockUI();" value="month" style="border-right: 1px solid #DAD8D8;">
                          <input type="radio" >Month
                        </label>
                        <label class="btn range_pick" onclick="blockUI();" value="year" >
                          <input type="radio" >Year
                        </label>
                        <label>&nbsp;&nbsp;&nbsp;</label>
                      </div>

                    </div>
                    <div id="show_map_meaning" class="mode_black pointer-mouse" style="width:89%;cursor:pointer">
                        &emsp;<img src="{{asset('images/list.png')}}"/>&nbsp;&nbsp; Map Meaning
                    </div>
                </div>
                <div class="map_meaning" style="z-index:99999;display:none" >
                  <table id="map" style="width:100%;height:100%;table-layout:fixed;z-index:99999;">
                    <tr >
                      <td></td>
                      <td class="map-data-0" style="width: 15em;"><img src="{{asset('images/icon/meeting_room_ss.png')}}"/>&emsp; Meeting Room</td>
                      <td class="map-data-1" style="width: 15em;"><img src="{{asset('images/icon/study_hall_ss.png')}}"/>&emsp; Other Room</td>
                      <td></td>
                    </tr>
                    <tr>
                      <td></td>
                      <td class="map-data-2"><img src="{{asset('images/icon/research_lab_ss.png')}}"/>&emsp; Laboratory</td>
                      <td class="map-data-3"><img src="{{asset('images/icon/individual_office_ss.png')}}"/>&emsp; Room</td>
                      <td></td>
                    </tr>
                    <tr>
                      <td></td>
                      <td class="map-data-4"><img src="{{asset('images/icon/other_ss.png')}}"/>&emsp; Corridor Area</td>
                      <td class="map-data-5"><img src="{{asset('images/icon/share_office_ss.png')}}"/>&emsp; Student Room</td>
                      <td></td>
                    </tr>
                    <tr>
                      <td></td>
                      <td class="map-data-6"><img src="{{asset('images/icon/class_room_ss.png')}}"/>&emsp; Class Room</td>
                      <td class="map-data-7"></td>
                      <td></td>
                    </tr>
                  </table>
                </div>
                <div style="position: relative;height: 582px;top:2em;z-index:20">
                    <div id="highlight_image" style="margin-top:50px;background-image:url('{{asset('images/plans/')}}/{{$data->img}}');background-position: 1px 3em;">
                    </div>
                    <script defer="defer">
                    // var stage = new Kinetic.Stage({
                    //     container: 'highlight_image',
                    //     width: 670,
                    //     height: 550
                    // });
                    // var shapesLayer = new Kinetic.Layer();
                    // var tooltipLayer = new Kinetic.Layer();
                    //
                    // var tooltip = new Kinetic.Label({
                    //     opacity: 0.75,
                    //     visible: false,
                    //     listening: false
                    //   });
                    // tooltip.add(new Kinetic.Tag({
                    //     fill: 'black',
                    //     pointerDirection: 'down',
                    //     pointerWidth: 10,
                    //     pointerHeight: 10,
                    //     lineJoin: 'round',
                    //     shadowColor: 'black',
                    //     shadowBlur: 10,
                    //     shadowOffset: 10,
                    //     shadowOpacity: 0.5
                    // }));
                    //
                    // tooltip.add(new Kinetic.Text({
                    //     text: '',
                    //     fontFamily: 'Calibri',
                    //     fontSize: 18,
                    //     padding: 5,
                    //     fill: 'white'
                    // }));
                    var stage = new Kinetic.Stage({
                        container: 'highlight_image',
                        width: 670,
                        height: 550
                    });
                    var tooltip = new Kinetic.Label({
                        opacity: 0.75,
                        visible: false,
                        listening: false
                      });
                    tooltip.add(new Kinetic.Tag({
                        fill: 'black',
                        pointerDirection: 'down',
                        pointerWidth: 10,
                        pointerHeight: 10,
                        lineJoin: 'round',
                        shadowColor: 'black',
                        shadowBlur: 10,
                        shadowOffset: 10,
                        shadowOpacity: 0.5
                    }));

                    tooltip.add(new Kinetic.Text({
                        text: '',
                        fontFamily: 'Calibri',
                        fontSize: 18,
                        padding: 5,
                        fill: 'white'
                    }));

                    var layer = new Kinetic.Layer();

                    var north = new Kinetic.Polygon({
                        // x: 200,
                        // y: 20,
                        points: [197, 341, 5, 203, 139, 128, 326, 232],
                        fill: '#4CAF50',
                        draggable: false,
                        opacity:0.5
                    });
                    var south = new Kinetic.Polygon({
                        // x: 200,
                        // y: 20,
                        points: [507, 285, 206, 126, 301, 68, 587, 191],
                        fill: '#C62828',
                        draggable: false,
                        opacity:0.5
                    });

                    layer.add(north);
                    layer.add(south);
                    layer.add(tooltip);

                    // add the layer to the stage
                    stage.add(layer);
                    </script>
                    <div id="highlights"></div>
                    <pin id="pin"></pin>
                    <pin id="pin_name"></pin>
                    <div id="test_show_data" style="display:none;"></div>
                    <div style="font-size:12px;color:red;margin-top:-50px;">Tip: Change to icon display at View Mode, then click room icon to go to room level page.</div>


                </div>
              </div>
              <center><div class="col-sm-5 mepet pull-right" >
                <div class="chart_style" style="background-color:rgba(255, 255, 255, 0.68)">
                  <div id="container_pie0" class="container_donut_style" style="width:100%;height:24em"></div>
                  <script type="text/javascript">Donutchart('container_pie0','Area Usage');</script>
                </div>
                <div class="chart_style" style="background-color:rgba(255, 255, 255, 0.68)">
                  <div id="container_pie1" class="container_donut_style" style="width:100%;height:24em"></div>
                  <script type="text/javascript">Donutchart('container_pie1', 'Load Usage');</script>
                </div>
              </div></center>
            </div>
            <div class="col-sm-12">
            <div style="background-color:rgba(255, 255, 255, 0.68);padding:1em 0 0 1em">
              <div id="container_sum" class="container_bar_style" style="width:100%;border:1px solid #B2B2B3;height: 25em" ></div>
              <script type="text/javascript">buildingchart('container_sum');</script>
              <br><br><br>
            </div>
          </div>
        </div>
    </div>

<script type="text/javascript">
$(document).ready(function() {
  $(".map_meaning").hide();
  $("#show_map_meaning").click( function() {
    $(".map_meaning").toggle();
  });

var data_pin=<?php echo json_encode($data_pin); ?>;
// console.log(data_pin);
data_pin.forEach(function(data_pin){
  console.log(data_pin.room_name);

  var text_top_loc = (data_pin.top_loc+15);
  var text_left_loc = (data_pin.left_loc+40);
  console.log(text_left_loc, text_top_loc);

  $('#pin').append("<a href='"+data_pin.id_floor+"/room/"+data_pin.id_room+"'><div id='"+data_pin.id_room+"' rel='popover' style='position:absolute; top:"+data_pin.top_loc+"px;left:"+data_pin.left_loc+"px'><img src ='{{asset('images/icon/')}}/"+data_pin.img+"' class='room_pick tools pointer-mouse animated myUnZoom' style='opacity: 1;cursor:pointer'></div><div id="+data_pin.id_room+" class='room_label' rel='popover' style='position: absolute;  top: "+text_top_loc+"px; left: "+text_left_loc+"px;color: #fff;background-color:#363636;opacity:0.7;padding:1px;font-size:0.8em;'>"+data_pin.room_name+"</div></a>");
});
$(document).on('mouseover', ".room_pick", function(e) {
  $(this).removeClass('fadeInDown myUnZoom');
  $(this).addClass('myZoom');
});
$(document).on('mouseout', ".room_pick", function(e) {
  $(this).removeClass('fadeInDown myZoom');
  $(this).addClass('myUnZoom');
});

  // function plot_pin_on_map(pin_data){
  //          for(i in pin_obj){
  //          $('#pin').append('<div id="'+pin_data['names_'+i]+'" rel="popover" style="position: absolute;  bottom: '+pin_data["bottom_"+i]+'px; left: '+pin_data['left_'+i]+'px;  font-weight: bold; color: #fff;"><img id="pin'+i+'" class="room_pick tools pointer-mouse" src="'+pin_data['image_'+i]+'" onclick="location.href=\'room_level.html\';javascript:sessionStorage[\'area\']=JSON.stringify('+'\''+pin_data['area_'+i]+'\''+');javascript:sessionStorage[\'room\']=JSON.stringify('+'\''+pin_data['pnt_set_'+i]+'\''+');javascript:sessionStorage[\'room_type\']=JSON.stringify('+'\''+pin_data['types_'+i]+'\''+');"  title="'+ pin_data['names_'+i]+'" style="display:none;"/></div>');
  //          $('#pin_name').append('<div id="name_'+pin_data['names_'+i]+'" class="room_label" rel="popover" style="position: absolute;  bottom: '+pin_data["bottom_name_"+i]+'px; left: '+pin_data['left_name_'+i]+'px;color: #fff;background-color:#363636;opacity:0.7;padding:1px;font-size:0.8em;">'+ pin_data['names_'+i]+'</div>');
  //          }
  // }
});
</script>
</body>
@endsection
