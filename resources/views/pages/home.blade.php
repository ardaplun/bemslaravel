@extends('layouts.main-layout')

@section('content')
<script src="{{asset('js/chart.js')}}"></script>
<!-- title content -->
<div id="show-overview">
<div id="chart-title">
      <div class="upline-title">EE&IT STATUS</div>
          <div class="line-title">
            <div class="cycle-title"></div>
          </div>
      <div class="bottomline-title">OVERVIEW</div>
</div>

<body>
  <div class="container">
    <div class="row">
      <div class="col-sm-6 col-sm-offset-3 mepet">
        <div style="background-color:white;width:105%">
          <div id="top-status">
            <span id="status-jam" class="show-date">{{date(" M Y")}}</span>
            <span id="faculty-name" >Faculty of Engineering, Universitas Gadjah Mada</span>
          </div>
          <div id="middle-status" style="background-color:#DCEBFF;line-height:1.3em;">
            <span id="left-clock">
              <span style="font-size:1.7em;margin-left:4px" class="show-hour">{{date("H")}}</span><span style="font-size:1.3em;display:inline-block;">:00-</span><span class="show-hour" style="font-size:1.3em;display:inline-block;">{{date("H")}}</span><span style="font-size:1.3em;display:inline-block;">:59</span>
            </span>
            <a href="{{url('/building/DTETI')}}"><span id="dept-name" >Dept. of Electrical Engineering and Information Technology</span></a>
          </div>

          <div id="status-big">
            <div style="height:8.3em;background:-webkit-linear-gradient(top,#fff,#f6f6f6);background:-moz-linear-gradient(top,#fff,#F1EFEF);">
                <div style="width:20%;font-weight:bold;display:inline-block;text-align:center;color:#999;position:relative;top:0px;font-size:1.4em">1<sup>st</sup> - Today</div>
                <div style="font-size:3.4em;text-align:right;width:55%;display:inline-block;margin-top:25px;color:#707070;font-weight:bold;"><span id="show-energy" >12,345.67&nbsp</span><span style="font-size:50%;font-weight:lighter;">kWh</span></div>
                <div class="box-percentage-status" style="background-color:#F5C922;margin-top:0.1em"><span style="font-size:1.4em;" id="show_percent_energy">100</span><span style="font-size:40%;">%</span></div>
            </div>
          </div>
          <div id="status-chart-acc">
            <div style="height:2.5em;background:-webkit-linear-gradient(top,#eee,#e0e0e0);background:-moz-linear-gradient(top,#eee,#e0e0e0);">
              <span id="daily-consumed">Daily Consumed Energy Accumulation 123.45  kWh</span>
              <span class="text-percentage-status" style="background-color:#F5C922;line-height:1.6em;display:inline-block;width:8.3em;text-align:center;font-size:0.9em;float:right;margin:8px 6px 4px 6px;color:white;font-weight:bold;">Level 2</span>
            </div>
            <div style="height:40px;line-height:40px;font-size:1.2em;color:#707070;">
              <span style="margin:0 0 0 4px;">Current Demand <span id="show_power">123</span> kW</span>
              <span style="float:right;margin-right:4px;">Peak Demand 234 kW</span>
            </div>
          </div>
          <div id="status-chart-line">

            <div id="chart_container" style="height:200px; width:100%;" >
            </div>
              <span style="margin:0 0 0 4px;"><hr style="background-color:#F5C922;height:3px;float:left;width:20px;margin-top:5px;">&emsp;Warning Level 98 kW</span>
              <span style="float:right;margin-right:4px;"><hr style="background-color:#bc250c;height:3px;float:left;width:20px;margin-top:5px;">&emsp;Alert Level 87 kW</span>
          </div>
          <div id="Donutchart">

          </div>
        </div>
      </div>
      <div class="col-sm-2">
        <div id="show-main-map" style="width:50%">
            <img src="{{asset('images/home/map-btn.png')}}" style="position:absolute;right:0em;top:25em;cursor: pointer;">
        </div>
      </div>
    </div>
  </div>
  <script type="text/javascript"> mainchart('chart_container');</script>
  <script type="text/javascript">Donutchart('Donutchart','EE&IT');</script>

</body>
</div>

<div id="show-maps" style="display:none">
<div id="maps-title">
      <div class="upline-title">MAIN MAP</div>
          <div class="line-title">
            <div class="cycle-title"></div>
          </div>
      <div class="bottomline-title"></div>
      <br><br>

</div>

<body>
  <div id="show-map" >
  <map name="bemsmap">
      <area id="ee" shape="poly" coords="68,175,138,155,212,209,214,215,220,221,226,225,216,229,222,236,219,242,225,252,151,287,166,313,151,321,78,250" alt="<a>EE Building</a>" href="#EEBuilding" title="Show Electrical Engineering Building" class="lightbox_trigger" >
      <area id="eng4" shape="poly" coords="500,214,514,31,560,17,618,41,597,218,590,221,593,229,572,240,560,235,540,243,520,231,520,225" alt="<a>ENG4 Building</a>" href="#Building4"title="Show Electrical Engineering Building 4" class="lightbox_trigger">
  </map>
  <!--Plot pin over map image-->
  <div style="position:relative;width:783px;height:537px;margin:0 auto;" >
      <div id="map-img">
        <img src="{{asset('images/map/b1-1.png')}}" alt="building" usemap="#bemsmap" style="background:transparent;" />
      </div>

      <div id="4th_enegy_show" style="position: absolute;top: 110px;right: -10px;width:180px;height:120px">
        <div id="eng4_line"></div>
        <div style="position: absolute;right: -45px;top: 84px;color:#707070">
          <span style="font-size: 20px;">Eng Bld. 4</span><br>
          <span id="eng4_map_data" style="font-size: 11px;">Energy 0.0 kWh</span>
        </div>
      </div>
      <div id="charging_enegy_show" style="position: absolute;top: 340px;right: 230px;width:240px;height:120px">
        <div id="ev_chargingstation_line">
          <div style="width: 20px;height: 20px;border: 2px solid #fff;radius: 25px;border-radius: 25px;background-color: #F7A5C4;position: absolute;left: -3px;top: -10px;"></div>
          <div style="border-right: 1px solid #F7A5C4;border-top: 1px solid #F7A5C4;width: 230px;height: 85px;background-color: transparent;"></div>
          <div style="width: 10px;height: 10px;border-radius: 25px;radius: 25px;border-radius: 25px;background-color: #F7A5C4;position: absolute;right: 6px;"></div>

        </div>
        <div style="position: absolute;right: -45px;top: 100px;color:#707070">
          <span style="font-size: 15px;">Charging Station</span><br>
          <span id="ev_chargingstation_map_data" style="font-size: 11px;">Energy 0.0 kWh</span>
        </div>
      </div>
      <div id="hv_enegy_show" style="position: absolute;top: 430px;right: 179px;width:240px;height:120px">
        <div id="hv_line">
          <div style="width: 20px;height: 20px;border: 2px solid #fff;radius: 25px;border-radius: 25px;background-color: #F7A5C4;position: absolute;left: -9px;top: -10px;"></div>
          <div style="border-left: 1px solid #F7A5C4;border-bottom: 1px solid #F7A5C4;width: 140px;height: 100px;background-color: transparent;"></div>
          <div style="width: 10px;height: 10px;border-radius: 25px;radius: 25px;border-radius: 25px;background-color: #F7A5C4;position: absolute;right: 90px;top: 94px;"></div>

        </div>
        <div style="position: absolute;right: -50px;top: 82px;color:#707070">
          <span style="font-size: 15px;">High Voltage Bld.</span><br>
          <span id="highvoltage_map_data" style="font-size: 11px;">Energy 0.0 kWh</span>
        </div>
      </div>
      <div id="gewertz_enegy_show" style="position: absolute;top: 280px;left: 100px;width:240px;height:120px">
        <div id="gewertz_line">
           <div style="width: 20px;height: 20px;border: 2px solid #fff;radius: 25px;border-radius: 25px;background-color: #F7A5C4;position: absolute;right: 90px;top: -10px;"></div>
          <div style="border-right: 1px solid #F7A5C4;border-bottom: 1px solid #F7A5C4;width: 140px;height: 234px;background-color: transparent;"></div>
          <div style="width: 10px;height: 10px;border-radius: 25px;radius: 25px;border-radius: 25px;background-color: #F7A5C4;position: absolute;left: -10px;bottom: -118px;"></div>

        </div>
        <div style="position: absolute;left: -120px;top: 215px;color:#707070">
          <span style="font-size: 15px;">Gewertz Bld.</span><br>
          <span id="gewertz_map_data" style="font-size: 11px;">Energy 0.0 kWh</span>
        </div>
      </div>
      <div id="esid_enegy_show" style="position: absolute;top: 345px;left: 75px;width:240px;height:120px">
        <div id="esid_line">
            <div style="width: 20px;height: 20px;border: 2px solid #fff;radius: 25px;border-radius: 25px;background-color: #F7A5C4;position: absolute;right: 90px;top: -10px;"></div>
            <div style="border-right: 1px solid #F7A5C4;border-bottom: 1px solid #F7A5C4;width: 140px;height: 84px;background-color: transparent;"></div>
            <div style="width: 10px;height: 10px;border-radius: 25px;radius: 25px;border-radius: 25px;background-color: #F7A5C4;position: absolute;left: -10px;bottom: 31px;"></div>
        </div>
        <div style="position: absolute;left: -120px;top: 70px;color:#707070">
          <span style="font-size: 15px;">ESID Bld.</span><br>
          <span id="esid_map_data" style="font-size: 11px;">Energy 0.0 kWh</span>
        </div>
      </div>
      <div id="EE_enegy_show" style="position: absolute;top: 280px;left: -10px;width:240px;height:120px">
        <div id="ee_line"></div>
        <div style="position: absolute;left: -135px;top: 70px;color:#707070">
          <span style="font-size: 20px;">EE Bld.</span><br>
          <span id="ee_map_data" style="font-size: 11px;">Energy 0.0 kWh</span>
        </div>
      </div>
      <div id="eng3_enegy_show" style="position: absolute;top: 93px;left: 100px;width:40px;height:20px">
        <div style="width: 20px;height: 20px;border: 2px solid #fff;radius: 25px;border-radius: 25px;background-color: #F7A5C4;position: absolute;right: -110px;bottom: -40px;"></div>
        <div style="border-right: 1px solid #F7A5C4;border-top: 1px solid #F7A5C4;width: 140px;height: 45px;background-color: transparent;"></div>
        <div style="width: 10px;height: 10px;border-radius: 25px;radius: 25px;border-radius: 25px;background-color: #F7A5C4;position: absolute;left: -10px;top: -5px;"></div>
        <div style="position: absolute;left: -120px;top: -18px;color:#707070">
          <span style="font-size: 15px;">Eng Bld. 3 PV</span><br>
          <span id="solarcell_eng3_map_data" style="font-size: 11px;">Energy 0.0 kWh</span>
        </div>
      </div>
      <div id="eng100_enegy_show" style="position: absolute;top: 15px;right: 460px;width: 10px;height: 90px;">
        <div style="width: 20px;height: 20px;border: 2px solid #fff;radius: 25px;border-radius: 25px;background-color: #F7A5C4;position: absolute;right: -140px;bottom: 40px;"></div>
        <div style="border-right: 1px solid #F7A5C4;border-top: 1px solid #F7A5C4;width: 140px;height: 45px;background-color: transparent;"></div>
        <div style="width: 10px;height: 10px;border-radius: 25px;radius: 25px;border-radius: 25px;background-color: #F7A5C4;position: absolute;left: -10px;top: -5px;"></div>
        <div style="position: absolute;left: -147px;top: -11px;color:#707070">
          <span style="font-size: 15px;">Eng 100 Years PV</span><br>
          <span id="solarcell_eng100yr_map_data" style="font-size: 11px;">Energy 0.0 kWh</span>
        </div>
      </div>
      <div id="pv_eng4_enegy_show" style="position: absolute;top: -20px;right: -17px;width:240px;height: 10px;">
        <div style="width: 20px;height: 20px;border: 2px solid #fff;radius: 25px;border-radius: 25px;background-color: #F7A5C4;position: absolute;right: 229px;bottom: -45px;"></div>
        <div style="border-left: 1px solid #F7A5C4;border-top: 1px solid #F7A5C4;width: 140px;height: 45px;background-color: transparent;"></div>
        <div style="width: 10px;height: 10px;border-radius: 25px;radius: 25px;border-radius: 25px;background-color: #F7A5C4;position: absolute;right: 101px;top: -5px;"></div>
        <div style="position: absolute;right: -10px;top: -18px;color:#707070">
          <span style="font-size: 15px;">Eng Bld. 4 PV</span><br>
          <span id="solarcell_eng4_map_data" style="font-size: 11px;">Energy 0.0 kWh</span>
        </div>
      </div>
      <div id="pv_ee_enegy_show" style="position: absolute;top: 145px;left: -5px;width:10px;height:10px">
        <div style="width: 20px;height: 20px;border: 2px solid #fff;radius: 25px;border-radius: 25px;background-color: #F7A5C4;position: absolute;right: -140px;bottom: -50px;"></div>
        <div style="border-right: 1px solid #F7A5C4;border-top: 1px solid #F7A5C4;width: 140px;height: 45px;background-color: transparent;"></div>
        <div style="width: 10px;height: 10px;border-radius: 25px;radius: 25px;border-radius: 25px;background-color: #F7A5C4;position: absolute;left: -10px;top: -5px;"></div>
        <div style="position: absolute;left: -120px;top: -18px;color:#707070">
          <span style="font-size: 15px;">EE Bld. PV</span><br>
          <span id="solarcell_ee_map_data" style="font-size: 11px;">Energy 0.0 kWh</span>
        </div>
      </div>
  </div>
</div>
<div id="show-chart-map" style="float: right; position: relative; bottom: 185px; right: 280px;">
    <img src="{{asset('images/chart-btn.png')}}" class="pointer-mouse"><br>
</div>

<div id="alert-main-map" class="circle" style="float:right;position:relative;bottom: 345px;right: -613px;display: none;">
    <span class="glyphicon glyphicon-exclamation-sign" style="background-color: rgb(216, 22, 39);right: -163px;height: 50px;width: 50px;top: -28px;border-radius: 50%;vertical-align: middle;text-align: center;line-height: 50px;color: white;font-size: xx-large;"></span>
    <div style="float:right;position:absolute;bottom: 120px;left: 14px;font-size: large;font-weight: bolder;color: rgb(252, 252, 252);text-align: left;">Current</div>
    <div id="this-min-pow" style="float:right;position:absolute;bottom: 78px;right: 13px;font-size: xx-large;font-weight: bolder;color: rgb(252, 252, 252);text-align: center;"></div>
    <hr style="position:absolute;width: 161px;background-color: white;bottom: 52px;height: 3px;right: 12px;text-align: center;border-top: 0px;">
    <div style="float:right;position:absolute;bottom: 47px;left: 14px;font-size: large;font-weight: bolder;color: rgb(252, 252, 252);text-align: left;">Limit</div>
    <div id="alert-power" style="float:right;position:absolute;bottom: 11px;right: 13px;font-size: xx-large;font-weight: bolder;color: rgb(255, 255, 255);text-align: center;"></div>
</div>
<br><br><br>
</body>
</div>
<script type="text/javascript">
$("#show-main-map").click(function(){
                 $("#show-maps").show();
                 $("#show-overview").hide();
                //  $("#show-chart-body").hide();
                //  $("#show-main-map").hide();
                //  $("#chart-title").hide();
                //  $("#map-title").show();
                //  if ($("#alert-main-map").hasClass('flipInX')) {
                //     $("#alert-main-map").hide();
                //     $("#alert-main-map").addClass('mp_hide');
                //  }

              });
              $("#show-chart-map").click(function(){
                 $("#show-maps").hide();
                 $("#show-overview").show();
                 //$("#show-chart-body").show();
                //  $("#show-chart-map").hide();
                //  $("#chart-title").show();
                //  $("#map-title").hide();
                //  if ($("#alert-main-map").hasClass('flipInX')) {
                //     $("#alert-main-map").show();
                //     $("#alert-main-map").removeClass('mp_hide');
                //  }
              });

</script>


@endsection
