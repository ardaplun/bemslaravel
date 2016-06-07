@extends('layouts.2nd-layout')

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
              <span id="bld_lv" class="txt_pink" style="font-size:1.3em;font-weight:400;padding-left:1.7em">ELECTRICAL ENGINEERING AND TECHNOLOGY INFORMATION</span> : <span id="floor_lv" class="txt_blue">{{$floor}}<sup style="font-size:15px;">ST</sup> FLOOR</span>
              <div class="col-sm-7 mepet row">
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
                <div class="col-sm-6 "  style="padding-top:0.3em">
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
                    <div id="show_map_meaning" class="mode_black pointer-mouse" style="width:86%">
                        &emsp;<img src="{{asset('images/list.png')}}"/>&nbsp;&nbsp; Map Meaning
                    </div>
                </div>
                <div class="map_meaning" style="z-index:99999;display:none" >
                  <table id="map" style="width:100%;height:100%;table-layout:fixed;">
                    <tr >
                      <td></td>
                      <td class="map-data-0"></td>
                      <td class="map-data-1"></td>
                      <td></td>
                    </tr>
                    <tr>
                      <td></td>
                      <td class="map-data-2"></td>
                      <td class="map-data-3"></td>
                      <td></td>
                    </tr>
                    <tr>
                      <td></td>
                      <td class="map-data-4"></td>
                      <td class="map-data-5"></td>
                      <td></td>
                    </tr>
                    <tr>
                      <td></td>
                      <td class="map-data-6"></td>
                      <td class="map-data-7"></td>
                      <td></td>
                    </tr>
                  </table>
                </div>

              </div>
              <div class="col-sm-5" >
                <div class="chart_style" style="background-color:rgba(255, 255, 255, 0.68)">
                  <div id="container_pie0" class="container_donut_style"style="width:100%;"></div>
                  <script type="text/javascript">Donutchart('container_pie0','Area Usage');</script>
                </div>
                <div class="chart_style" style="background-color:rgba(255, 255, 255, 0.68)">
                  <div id="container_pie1" class="container_donut_style" style="width:100%;"></div>
                  <script type="text/javascript">Donutchart('container_pie1', 'Load Usage');</script>
                </div>
              </div>
            </div>
            <div class="col-sm-12">
            <div class="chart_style" style="background-color:rgba(255, 255, 255, 0.68);">
              <div id="container_sum" class="container_bar_style" style="width:100%;border:1px solid #B2B2B3;" ></div>
              <script type="text/javascript">buildingchart('container_sum');</script>
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
