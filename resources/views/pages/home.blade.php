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
            <script type="text/javascript">date_time('date_time');</script>
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
  <!-- <map name="bemsmap">
      <area id="ee" shape="poly" coords="68,175,138,155,212,209,214,215,220,221,226,225,216,229,222,236,219,242,225,252,151,287,166,313,151,321,78,250" alt="<a>EE Building</a>" href="#EEBuilding" title="Show Electrical Engineering Building" class="lightbox_trigger" >
      <area id="eng4" shape="poly" coords="500,214,514,31,560,17,618,41,597,218,590,221,593,229,572,240,560,235,540,243,520,231,520,225" alt="<a>ENG4 Building</a>" href="#Building4"title="Show Electrical Engineering Building 4" class="lightbox_trigger">
  </map> -->
  <!--Plot pin over map image-->
  <div style="position:relative;width:56em;height:35em;margin:0 auto;" >
      <div id="map-img">
        <img src="{{asset('images/map/teknik.png')}}" alt="building" usemap="#bemsmap" style="position:absolute;background:transparent;z-index:1;" />
        <a href="{{url('building/DTETI')}}"><img src="{{asset('images/map/teti-red.png')}}" alt="building" usemap="#bemsmap" style="position:absolute;background:transparent;z-index:2;top:12.6em;left:4.5em;" /></a>
      </div>


      <div id="DTETI_enegy_show" style="position: absolute;top: 264px;left: -30px;width:240px;height:120px;z-index:200">
        <div id="DTETI_line">
          <div style="width: 10px;height: 10px;border: 2px solid #fff;radius: 25px;border-radius: 25px;background-color: #F44336;position: absolute;right: 16.7em;top:3.5em;"></div>
          <div style="border-left: 1px solid #F44336;border-top: 1px solid #F44336;width: 100px;height: 58px;background-color: transparent;"></div>
          <div style="width: 20px;height: 20px;border: 2px solid #fff;border-radius: 25px;radius: 25px;border-radius: 25px;background-color: #F44336;position: absolute;left:7em;top: -0.75em;"></div>
        </div>
        <div style="position: absolute;left: -10em;top: 2.7em;color:#707070">
          <span style="font-size: 20px;">DTETI Bld.</span><br>
          <span id="ee_map_data" style="font-size: 11px;">Energy 0.0 kWh</span>
        </div>
      </div>

      <div id="DTMI_enegy_show" style="position: absolute;top: 7em;left: -5em;width:15em;height:120px;z-index:200">
        <div id="DTMI_line">
          <div style="width: 10px;height: 10px;border: 2px solid #fff;radius: 25px;border-radius: 25px;background-color: #008ec3;position: absolute;right: 14.7em;top:-0.3em;"></div>
          <div style="border-right: 1px solid #008ec3;border-top: 1px solid #008ec3;width: 11em;height: 5em;background-color: transparent;"></div>
          <div style="width: 20px;height: 20px;border: 2px solid #fff;border-radius: 25px;radius: 25px;border-radius: 25px;background-color: #008ec3;position: absolute;left:10.28em;top: 5em;"></div>
        </div>
        <div style="position: absolute;left: -7em;top: -0.7em;color:#707070">
          <span style="font-size: 15px;">DTMI Bld.</span><br>
          <span id="ee_map_data" style="font-size: 11px;">Energy 0.0 kWh</span>
        </div>
      </div>

      <div id="DTEKIM_enegy_show" style="position: absolute;top: 4em;left: 2em;width:15em;height:120px;z-index:200">
        <div id="DTEKIM_line">
          <div style="width: 10px;height: 10px;border: 2px solid #fff;radius: 25px;border-radius: 25px;background-color: #008ec3;position: absolute;right: 14.7em;top:-0.3em;"></div>
          <div style="border-right: 1px solid #008ec3;border-top: 1px solid #008ec3;width: 11em;height: 5em;background-color: transparent;"></div>
          <div style="width: 20px;height: 20px;border: 2px solid #fff;border-radius: 25px;radius: 25px;border-radius: 25px;background-color: #008ec3;position: absolute;left:10.28em;top: 5em;"></div>
        </div>
        <div style="position: absolute;left: -7em;top: -0.7em;color:#707070">
          <span style="font-size: 15px;">JTEKIM Bld.</span><br>
          <span id="ee_map_data" style="font-size: 11px;">Energy 0.0 kWh</span>
        </div>
      </div>

      <div id="JUTAP_enegy_show" style="position: absolute;top: 1em;left: 19em;width:15em;height:120px;z-index:200">
        <div id="JUTAP_line">
          <div style="width: 10px;height: 10px;border: 2px solid #fff;radius: 25px;border-radius: 25px;background-color: #008ec3;position: absolute;right: 14.7em;top:-0.3em;"></div>
          <div style="border-right: 1px solid #008ec3;border-top: 1px solid #008ec3;width: 11em;height: 3em;background-color: transparent;"></div>
          <div style="width: 20px;height: 20px;border: 2px solid #fff;border-radius: 25px;radius: 25px;border-radius: 25px;background-color: #008ec3;position: absolute;left:10.3em;top: 3em;"></div>
        </div>
        <div style="position: absolute;left: -7em;top: -0.7em;color:#707070">
          <span style="font-size: 15px;">JUTAP Bld.</span><br>
          <span id="ee_map_data" style="font-size: 11px;">Energy 0.0 kWh</span>
        </div>
      </div>

      <div id="JUTEG_enegy_show" style="position: absolute;top: 3em;right: -7em;width:26em;height:120px;z-index:200">
        <div id="JUTEG_line">
          <div style="width: 10px;height: 10px;border: 2px solid #fff;radius: 25px;border-radius: 25px;background-color: #008ec3;position: absolute;left: 10.7em;top:-0.35em;"></div>
          <div style="border-left: 1px solid #008ec3;border-top: 1px solid #008ec3;width: 11em;height: 3em;background-color: transparent;"></div>
          <div style="width: 20px;height: 20px;border: 2px solid #fff;border-radius: 25px;radius: 25px;border-radius: 25px;background-color: #008ec3;position: absolute;left:-0.6em;top: 3em;"></div>
        </div>
        <div style="position: absolute;left: 13em;top: -1.7em;color:#707070">
          <span style="font-size: 15px;">JUTEG Bld.</span><br>
          <span id="ee_map_data" style="font-size: 11px;">Energy 0.0 kWh</span>
        </div>
      </div>

      <div id="JTSL_enegy_show" style="position: absolute;top: 11em;right: -14em;width:26em;height:120px;z-index:200">
        <div id="JTSL_line">
          <div style="width: 10px;height: 10px;border: 2px solid #fff;radius: 25px;border-radius: 25px;background-color: #008ec3;position: absolute;left: 12.7em;top:2.6em;"></div>
          <div style="border-left: 1px solid #008ec3;border-bottom: 1px solid #008ec3;width: 13em;height: 3em;background-color: transparent;"></div>
          <div style="width: 20px;height: 20px;border: 2px solid #fff;border-radius: 25px;radius: 25px;border-radius: 25px;background-color: #008ec3;position: absolute;left:-0.68em;top: -1em;"></div>
        </div>
        <div style="position: absolute;left: 15em;top: 1.3em;color:#707070">
          <span style="font-size: 15px;">JTSL Bld.</span><br>
          <span id="ee_map_data" style="font-size: 11px;">Energy 0.0 kWh</span>
        </div>
      </div>

      <div id="DTNF_enegy_show" style="position: absolute;top: 25em;left: 7em;width:15em;height:120px;z-index:200">
        <div id="DTNF_line">
          <div style="width: 10px;height: 10px;border: 2px solid #fff;radius: 25px;border-radius: 25px;background-color: #008ec3;position: absolute;right: 14.7em;top:4.6em;"></div>
          <div style="border-right: 1px solid #008ec3;border-bottom: 1px solid #008ec3;width: 11em;height: 5em;background-color: transparent;"></div>
          <div style="width: 20px;height: 20px;border: 2px solid #fff;border-radius: 25px;radius: 25px;border-radius: 25px;background-color: #008ec3;position: absolute;left:10.28em;top: -1em;"></div>
        </div>
        <div style="position: absolute;left: -7em;top:4em;color:#707070">
          <span style="font-size: 15px;">DTNF Bld.</span><br>
          <span id="ee_map_data" style="font-size: 11px;">Energy 0.0 kWh</span>
        </div>
      </div>



      <div id="show-chart-map" style="float: right; position: relative; top: 20em; right: -76px;">
          <img src="{{asset('images/chart-btn.png')}}" class="pointer-mouse" style="cursor:pointer"><br>
      </div>
  </div>


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


    });
    $("#show-chart-map").click(function(){
       $("#show-maps").hide();
       $("#show-overview").show();


    });

</script>


@endsection
