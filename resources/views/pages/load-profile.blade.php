@extends('layouts.main-layout')

@section('content')
<script src="{{asset('js/chart.js')}}"></script>
<script src="{{asset('js/getdata.js')}}"></script>
<script type="text/javascript">
var total_pwr_demand=0;
var total_eng_demand=0;
var total_peak_demand=0;
var chrt=[];
var chrtyr=[];
var chrtmnth=[];
var timeval;
function flushchart(){
  for (var i = 0; i < 96; i++) {
    chrt[i]=0;
  }
  for (var i = 0; i < moment().daysInMonth(); i++) {
    chrtmnth[i]=0;
  }
  for (var i = 0; i < 12; i++) {
    chrtyr[i]=0;
  }
}
flushchart();
function showdata(energy,power,powermax,chart,id){
  total_eng_demand  += parseFloat(energy);
  total_pwr_demand  += parseFloat(power);
  total_peak_demand += parseFloat(powermax);
  buildingchart(id+'_profile_container_demand',chart);
  $("#"+id+"_energy_status").html(energy.toLocaleString());
  $("#"+id+"_power_status").html(power.toLocaleString());
  $("#"+id+"_peak_demand").html(powermax.toLocaleString());
  $("#total_demand_energy_status").html(total_eng_demand.toLocaleString());
  $("#total_demand_power_status").html(total_pwr_demand.toLocaleString());
  $("#total_peak_demand").html(total_peak_demand.toLocaleString());
}
function changedata(val){
  timeval = val;
  if (val == 'day') {
    $.ajax({
        url: BASE_URL+'load-profile/'+val,
        type: "post",
        dataType:'json',
        beforeSend : startProcess(),
        success: function(data){
          console.log(data);
          for (var i = 0; i < data.length; i++) {
            console.log(data[i]);
            var energy   = data[i]['energy']['totaltoday'];
            var power    = data[i]['power']['currenttoday'];
            var powermax = data[i]['power']['maxtoday'];
            var chart    = data[i]['dttdy'];
            showdata(energy,power,powermax,chart,data[i]['id_building']);
            daychart(data[i]['id_building']+'_profile_container_demand',chart,'power');
            for (var j = 0; j < chart.length; j++) {
              if (chart[j]) {
                chrt[j] += chart[j];
              }
            }
            daychart('total_load_profile_container_demand',chrt,'power');
          }
          endProcess();
          chrt=[];
        },
        error: function(e) {
          console.log(e.responseText);
        }
      });
  }
  if (val == 'month') {
    $.ajax({
        url: BASE_URL+'load-profile/'+val,
        type: "post",
        dataType:'json',
        beforeSend : startProcess(),
        success: function(data){
          console.log(data);
          for (var i = 0; i < data.length; i++) {
            console.log(data[i]);
            var energy   = data[i]['energy']['totalmonth'];
            var power    = data[i]['power']['currentmonth'];
            var powermax = data[i]['power']['maxmonth'];
            var chart    = data[i]['dtmnth'];
            showdata(energy,power,powermax,chart,data[i]['id_building']);
            monthchart(data[i]['id_building']+'_profile_container_demand',chart,'power');
            for (var j = 0; j < chart.length; j++) {
              if (chart[j]) {
                chrtmnth[j] += chart[j];
              }
            }
            monthchart('total_load_profile_container_demand',chrtmnth,'power');
          }
          endProcess();
          chrtmnth=[];
        },
        error: function(e) {
          console.log(e.responseText);
        }
      });
  }
  if (val == 'year') {
    $.ajax({
        url: BASE_URL+'load-profile/'+val,
        type: "post",
        dataType:'json',
        beforeSend : startProcess(),
        success: function(data){
          console.log(data);
          for (var i = 0; i < data.length; i++) {
            console.log(data[i]);
            var energy   = data[i]['energy']['totalyear'];
            var power    = data[i]['power']['currentyear'];
            var powermax = data[i]['power']['maxyear'];
            var chart    = data[i]['dtyr'];
            showdata(energy,power,powermax,chart,data[i]['id_building']);
            yearchart(data[i]['id_building']+'_profile_container_demand',chart,'power');
            for (var j = 0; j < chart.length; j++) {
              if (chart[j]) {
                chrtyr[j] += chart[j];
              }
            }
            yearchart('total_load_profile_container_demand',chrtyr,'power');
          }
          endProcess();
          chrtyr=[];
        },
        error: function(e) {
          console.log(e.responseText);
        }
      });
  }
  total_eng_demand  = 0;
  total_pwr_demand  = 0;
  total_peak_demand = 0;
  flushchart();
}
function reloaddata(val){
  if (val == 'day') {
    $.ajax({
        url: BASE_URL+'load-profile/'+val,
        type: "post",
        dataType:'json',
        success: function(data){
          console.log(data);
          for (var i = 0; i < data.length; i++) {
            console.log(data[i]);
            var energy   = data[i]['energy']['totaltoday'];
            var power    = data[i]['power']['currenttoday'];
            var powermax = data[i]['power']['maxtoday'];
            var chart    = data[i]['dttdy'];
            showdata(energy,power,powermax,chart,data[i]['id_building']);
            daychart(data[i]['id_building']+'_profile_container_demand',chart,'power');
            for (var j = 0; j < chart.length; j++) {
              if (chart[j]) {
                chrt[j] += chart[j];
              }
            }
            daychart('total_load_profile_container_demand',chrt,'power');
          }
          endProcess();
          chrt=[];
        },
        error: function(e) {
          console.log(e.responseText);
        }
      });
  }
  if (val == 'month') {
    $.ajax({
        url: BASE_URL+'load-profile/'+val,
        type: "post",
        dataType:'json',
        success: function(data){
          console.log(data);
          for (var i = 0; i < data.length; i++) {
            console.log(data[i]);
            var energy   = data[i]['energy']['totalmonth'];
            var power    = data[i]['power']['currentmonth'];
            var powermax = data[i]['power']['maxmonth'];
            var chart    = data[i]['dtmnth'];
            showdata(energy,power,powermax,chart,data[i]['id_building']);
            monthchart(data[i]['id_building']+'_profile_container_demand',chart,'power');
            for (var j = 0; j < chart.length; j++) {
              if (chart[j]) {
                chrtmnth[j] += chart[j];
              }
            }
            monthchart('total_load_profile_container_demand',chrtmnth,'power');
          }
          endProcess();
          chrtmnth=[];
        },
        error: function(e) {
          console.log(e.responseText);
        }
      });
  }
  if (val == 'year') {
    $.ajax({
        url: BASE_URL+'load-profile/'+val,
        type: "post",
        dataType:'json',
        success: function(data){
          console.log(data);
          for (var i = 0; i < data.length; i++) {
            console.log(data[i]);
            var energy   = data[i]['energy']['totalyear'];
            var power    = data[i]['power']['currentyear'];
            var powermax = data[i]['power']['maxyear'];
            var chart    = data[i]['dtyr'];
            showdata(energy,power,powermax,chart,data[i]['id_building']);
            yearchart(data[i]['id_building']+'_profile_container_demand',chart,'power');
            for (var j = 0; j < chart.length; j++) {
              if (chart[j]) {
                chrtyr[j] += chart[j];
              }
            }
            yearchart('total_load_profile_container_demand',chrtyr,'power');
          }
          endProcess();
          chrtyr=[];
        },
        error: function(e) {
          console.log(e.responseText);
        }
      });
  }
  total_eng_demand  = 0;
  total_pwr_demand  = 0;
  total_peak_demand = 0;
  flushchart();
}
</script>
<!-- title content -->
<div id="site-body">
  <body>
    <div class="container">
             <!--Start module-->
              <br />
              <div id="chart-title">
                <div class="upline-title">LOAD</div>
                <div class="line-title">
                  <div class="cycle-title"></div>
                </div>
                <div class="bottomline-title">PROFILE</div>
              </div>
              <br />
                <!--Grouping-->
                <div style="height: 44px;" style="display:inline;">
                    <div class="btn-group pull-right" data-toggle="buttons" style="border: 1px solid #B2B2B3;border-radius: 30px;">
                        <label class="btn" disabled>
                            GROUP :
                        </label>
                        <label class="btn range_pick active" id="klikday" value="day" onclick="changedata('day')">
                            <input name="groupdata" id="day_goup" type="radio"  >Day
                        </label>
                        <label class="btn range_pick" value="month" onclick="changedata('month')">
                            <input name="groupdata" id="month_goup" type="radio" >Month
                        </label>
                        <label class="btn range_pick" value="year" onclick="changedata('year')">
                            <input name="groupdata" id="year_goup" type="radio" >Year
                        </label>
                    </div>
                </div>

               <div id="supply-box" style="border-bottom:2px solid #999;padding: 0px 0px 50px 0px;" >
                    <div style="font-size:2em;font-weight:bold;color:#008ec3;padding: 0px 0px;">SUPPLY</div>
                    <div id="supply-power-list" >
                        <div class="load_profile_chart_style" style="border: 3px solid #45718A;" >
                            <div class="profile_left_div" style="border-right: 3px solid #45718A;">
                                  <img src="images/supply.png"  style="height: 70px;">
                                  </br><b>Total</br>Generation</br></br></b>
                            </div>
                            <div class="profile_mid_div">
                                <div class="status_bar_box" id="total_generate_status_bar_supply">
                                   <div class="level progress" style="width:100%;margin-bottom: 5px;position: relative;top: 25%;">
                                     <div class="status_bar_txt">Energy</div>
                                     <div class="progress-bar slide_lv0"style="width:75%;background-image:none;float:right;">
                                       <div class="status_bar_val">0 kWh</div>
                                     </div>
                                   </div>
                                   <div class="level progress" style="width:100%;margin-bottom: 5px;position:relative;top:25%">
                                     <div class="status_bar_txt">Power</div>
                                     <div class="progress-bar slide_lv0"  style="width:75%;background-image:none;float:right;">
                                       <div class="status_bar_val">0 kW</div>
                                     </div>
                                   </div>
                                  <div style="font-size:80%;float:right;position: relative;top: 25%;"><small>Peak Generation 0 kW</small></div>
                              </div>
                            </div>
                            <div id="total_generate_profile_container_supply" class="profile_right_div"></div>
                        </div>
                    </div>
                </div>

                <div id="demand-box" style="padding: 20px 0px;">
                    <div style="font-size:2em;font-weight:bold;color:#008ec3;padding: 0px 0px;">DEMAND</div>
                    <div id="demand-power-list" >
                        <div class="load_profile_chart_style" style="border: 3px solid #45718A;" >
                            <div class="profile_left_div" style="border-right: 3px solid #45718A;">
                                <div class="logo_box">
                                    <img src="images/demand.png" style="height: 70px;"></br><b>Total Demand</b>
                                </div>
                            </div>
                            <div class="profile_mid_div">
                                <div class="status_bar_box" id="total_generate_status_bar_supply">
                                   <div class="level progress" style="width:100%;margin-bottom: 5px;position: relative;top: 25%;">
                                     <div class="status_bar_txt">Energy</div>
                                     <div class="progress-bar slide_lv1"style="width:75%;background-image:none;float:right;">
                                       <div class="status_bar_val"><span id="total_demand_energy_status"></span> kWh</div>
                                     </div>
                                   </div>
                                   <div class="level progress" style="width:100%;margin-bottom: 5px;position:relative;top:25%">
                                     <div class="status_bar_txt">Power</div>
                                     <div class="progress-bar slide_lv1"  style="width:75%;background-image:none;float:right;">
                                       <div class="status_bar_val"><span id="total_demand_power_status"></span>  kW</div>
                                     </div>
                                   </div>
                                  <div style="font-size:80%;float:right;position: relative;top: 25%;">
                                    <small>Peak Demand <span id="total_peak_demand"></span> kW</small>
                                  </div>
                              </div>
                            </div>
                            <div id="total_load_profile_container_demand" class="profile_right_div"></div>
                        </div>

                        @foreach($page_data as $dt)
                        <div class="load_profile_chart_style" style="border: 3px solid #8CB9B6;" >
                            <div class="profile_left_div" style="border-right: 3px solid #8CB9B6;">
                                <div class="logo_box">
                                    <img src="images/ee_building.png"></br><b>{{$dt['id_building']}} Bld.</b>
                                </div>
                            </div>
                            <div class="profile_mid_div">
                                <div class="status_bar_box" id="total_generate_status_bar_supply">
                                   <div class="level progress" style="width:100%;margin-bottom: 5px;position: relative;top: 25%;">
                                     <div class="status_bar_txt">Energy</div>
                                     <div class="progress-bar slide_lv1"style="width:75%;background-image:none;float:right;">
                                       <div class="status_bar_val"><span id="{{$dt['id_building']}}_energy_status"></span> kWh</div>
                                     </div>
                                   </div>
                                   <div class="level progress" style="width:100%;margin-bottom: 5px;position:relative;top:25%">
                                     <div class="status_bar_txt">Power</div>
                                     <div class="progress-bar slide_lv1"  style="width:75%;background-image:none;float:right;">
                                       <div class="status_bar_val"><span id="{{$dt['id_building']}}_power_status"></span> kW</div>
                                     </div>
                                   </div>
                                  <div style="font-size:80%;float:right;position: relative;top: 25%;">
                                    <small>Peak Demand <span id="{{$dt['id_building']}}_peak_demand"></span> kW</small>
                                  </div>
                              </div>
                            </div>
                            <div id="{{$dt['id_building']}}_profile_container_demand" class="profile_right_div"></div>
                        </div>
                        <script type="text/javascript">
                          // startProcess();
                          var energy   = {{$dt['energy']['totaltoday']}};
                          var power    = {{$dt['power']['currenttoday']}};
                          var powermax = {{$dt['power']['maxtoday']}};
                          var chart    = {{json_encode($dt['dttdy'])}};
                          total_eng_demand  += parseFloat(energy);
                          total_pwr_demand  += parseFloat(power);
                          total_peak_demand += parseFloat(powermax);
                          $("#total_demand_energy_status").html(total_eng_demand.toLocaleString());
                          $("#{{$dt['id_building']}}_energy_status").html(energy.toLocaleString());
                          $("#{{$dt['id_building']}}_power_status").html(power.toLocaleString());
                          $("#{{$dt['id_building']}}_peak_demand").html(powermax.toLocaleString());
                          $("#total_demand_power_status").html(total_pwr_demand.toLocaleString());
                          $("#total_peak_demand").html(total_peak_demand.toLocaleString());
                          daychart('total_generate_profile_container_supply',[],'power');
                          timeval = 'day';
                          for (var i = 0; i < chart.length; i++) {
                            if (chart[i] != null) {
                              chrt[i] += chart[i];
                            }
                          }
                          daychart('total_load_profile_container_demand',chrt,'power');
                          daychart('{{$dt['id_building']}}_profile_container_demand',chart,'power');

                        </script>
                        @endforeach

                        <!-- <div class="load_profile_chart_style" style="border: 3px solid #F5C922;" >
                            <div class="profile_left_div" style="border-right: 2px solid #F5C922;">
                                <div class="logo_box">
                                    <img src="images/4th_building.png"></br><b>Eng Bld. 4</b>
                                </div>
                            </div>
                            <div class="profile_mid_div">
                                <div class="status_bar_box" id="eng4_status_bar_demand"></div>
                            </div>
                            <div id="eng4_profile_container_demand" class="profile_right_div"></div>
                        </div> -->

                       <!-- <div class="load_profile_chart_style" style="border: 3px solid #A4C12B;" >
                            <div class="profile_left_div" style="border-right: 2px solid #A4C12B;">
                                <div class="logo_box">
                                    <img src="images/others-bldg.png"></br><b>Gewertz Bld.</b>
                                </div>
                            </div>
                            <div class="profile_mid_div">
                                <div class="status_bar_box" id="gewertz_status_bar_demand"></div>
                            </div>
                            <div id="gewertz_profile_container_demand" class="profile_right_div"></div>
                        </div> -->

                        <!-- <div class="load_profile_chart_style" style="border: 3px solid #DF4221;" >
                            <div class="profile_left_div" style="border-right: 2px solid #DF4221;">
                                <div class="logo_box">
                                    <img src="images/storage.png"></br><b>Energy Storage</br>EE Bld.</br>( 8 kW )</b>
                                </div>
                            </div>
                            <div class="profile_mid_div">
                                <div class="status_bar_box" id="energystorage_ee_8kw_status_bar_demand"></div>
                            </div>
                            <div id="energystorage_ee_8kw_profile_container_demand" class="profile_right_div"></div>
                        </div> -->
                    </div>
                </div><!-- End id="demand-box"-->
              </div>
            </body>
          </div>

<!-- get data -->
<script>
$(function(){
  setInterval(function() {
    console.log(timeval);
    reloaddata(timeval);
  },60000);
})
</script>

@endsection
