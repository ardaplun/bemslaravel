@extends('layouts.main-layout')

@section('content')
<script src="{{asset('js/chart.js')}}"></script>
<div id="chart-title">
      <div class="upline-title">FLOOR</div>
          <div class="line-title">
            <div class="cycle-title"></div>
          </div>
      <div class="bottomline-title">SECTION</div>
</div>

<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
              <a href="{{url('/building/')}}/{{$building}}"><span id="bld_lv" class="txt_pink" style="font-size:1.3em;font-weight:400;">ELECTRICAL ENGINEERING AND INFORMATION TECHNOLOGY</span></a> : <span id="floor_lv" class="txt_blue">{{$data->floor_name}} FLOOR</span>
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
                  <div class="dropdown mode_black">
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
                    <div id="show_map_meaning" class="mode_black pointer-mouse" style="width:89%">
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
                      <td class="map-data-6"><img src="{{asset('images/icon/class_room_ss.png')}}"/>&emsp; Lecture Room</td>
                      <td class="map-data-7"></td>
                      <td></td>
                    </tr>
                  </table>
                </div>
                <div style="position: relative;height: 582px;top:2em">
                    <div id="highlight_image" style="margin-top:50px;background-image:url('{{asset('images/12Floor_4th_Building.png')}}');background-position: 1px 3em;">
                    </div>
                    <script src="js/kinetic-v4.6.0.min.js"></script>
                    <script defer="defer" src="js/highlight.js"></script>
                    <div id="highlights"></div>
                    <pin id="pin" style="display:none;"></pin>
                    <pin id="pin_name" style="display:none;"></pin>
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
  $(".map_meaning").hide();
$("#show_map_meaning").click( function() {

        $(".map_meaning").toggle();

      });
</script>
</body>
@endsection
