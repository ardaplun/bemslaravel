@extends('layouts.main-layout')

@section('content')
<script src="{{asset('js/chart.js')}}"></script>
<!-- title content -->
<div id="show-maps">
<body>
  <div class="container">
  <div id="maps-title">
    <div class="upline-title">MAIN MAP</div>
        <div class="line-title">
          <div class="cycle-title"></div>
        </div>
    <div class="bottomline-title"></div>
  <br><br>
  <div id="show-map" >
  <!-- <map name="bemsmap">
      <area id="ee" shape="poly" coords="68,175,138,155,212,209,214,215,220,221,226,225,216,229,222,236,219,242,225,252,151,287,166,313,151,321,78,250" alt="<a>EE Building</a>" href="#EEBuilding" title="Show Electrical Engineering Building" class="lightbox_trigger" >
      <area id="eng4" shape="poly" coords="500,214,514,31,560,17,618,41,597,218,590,221,593,229,572,240,560,235,540,243,520,231,520,225" alt="<a>ENG4 Building</a>" href="#Building4"title="Show Electrical Engineering Building 4" class="lightbox_trigger">
  </map> -->
  <!--Plot pin over map image-->
  <div style="position:relative;width:56em;height:35em;margin:0 auto;" >
      <div id="map-img">
        <img src="{{asset('images/map/teknik.png')}}" alt="building" usemap="#bemsmap" style="position:absolute;background:transparent;z-index:1;" />
        <a href="overview/DTETI"><img id="DTETI-img" alt="" usemap="#bemsmap" style="position:absolute;background:transparent;z-index:3;top:12.6em;left:4.5em;" /></a>
        <a href="overview/DTAP"><img id="DTAP-img"alt="" usemap="#bemsmap" style="position:absolute;background:transparent;z-index:4;top:1.4em;right:19.6em;" /></a>
        <!-- <a href="{{url('building/DTETI')}}"><img src="{{asset('images/map/teti-red.png')}}" alt="building" usemap="#bemsmap" style="position:absolute;background:transparent;z-index:3;top:12.6em;left:4.5em;" /></a> -->
      </div>


      <div id="DTETI_enegy_show" style="position: absolute;top: 230px;left:-10em;width:210px;height:120px;z-index:200">
        <div id="DTETI_line">
          <div class="DTETI-line" style="width: 10px;height: 10px;radius: 25px;border-radius: 25px;background-color: #bc250c;position: absolute;right: 6.6em;top:3.5em;"></div>
          <div class="DTETI-line-2" style="border-left: 1px solid #bc250c;border-top: 1px solid #bc250c;width: 140px;height: 58px;background-color: transparent;position: absolute;left: 8em"></div>
          <div class="DTETI-line" style="width: 20px;height: 20px;border: 2px solid #fff;border-radius: 25px;radius: 25px;border-radius: 25px;background-color: #bc250c;position: absolute;left:18em;top: -0.75em;"></div>
        </div>
        <div style="position: absolute;left: 5em;top: 5em;color:#707070">
          <span style="font-size: 20px;">DTETI Bld.</span><br>
          <span id="ee_map_data" style="font-size: 11px;">Demand :<span id="show-demand-map-DTETI"></span> kWh</span><br>
          <span id="ee_map_data" style="font-size: 11px;">Supply :<span id="show-supply-map-dteti"></span> kWh</span>
        </div>
      </div>

      <div id="DTMI_enegy_show" style="position: absolute;top: 8em;left: -10em;width:15em;height:120px;z-index:200">
        <div id="DTMI_line">
          <div style="width: 10px;height: 10px;radius: 25px;border-radius: 25px;background-color: #008ec3;position: absolute;right: 9.7em;top:-0.3em;"></div>
          <div style="border-right: 1px solid #008ec3;border-top: 1px solid #008ec3;width: 11em;height: 3em;background-color: transparent;position: absolute;left: 5em"></div>
          <div style="width: 20px;height: 20px;border: 2px solid #fff;border-radius: 25px;radius: 25px;border-radius: 25px;background-color: #008ec3;position: absolute;left:15.28em;top: 3em;"></div>
        </div>
        <div style="position: absolute;left: -2em;top: -1.7em;color:#707070">
          <span style="font-size: 15px;">DTMI Bld.</span><br>
          <span id="ee_map_data" style="font-size: 11px;">Demand :<span id="show-demand-map-dtmi"></span> kWh</span><br>
          <span id="ee_map_data" style="font-size: 11px;">Supply :<span id="show-energy-map-dtmi"></span> kWh</span>
        </div>
      </div>

      <div id="DTK_enegy_show" style="position: absolute;top: 4em;left: 2em;width:15em;height:120px;z-index:200">
        <div id="DTK_line">
          <div style="width: 10px;height: 10px;radius: 25px;border-radius: 25px;background-color: #008ec3;position: absolute;right: 14.7em;top:-0.3em;"></div>
          <div style="border-right: 1px solid #008ec3;border-top: 1px solid #008ec3;width: 11em;height: 5em;background-color: transparent;"></div>
          <div style="width: 20px;height: 20px;border: 2px solid #fff;border-radius: 25px;radius: 25px;border-radius: 25px;background-color: #008ec3;position: absolute;left:10.28em;top: 5em;"></div>
        </div>
        <div style="position: absolute;left: -7em;top: -1.7em;color:#707070">
          <span style="font-size: 15px;">DTK Bld.</span><br>
          <span id="ee_map_data" style="font-size: 11px;">Demand :<span id="show-demand-map-dtmi"></span> kWh</span><br>
          <span id="ee_map_data" style="font-size: 11px;">Supply :<span id="show-energy-map-dtmi"></span> kWh</span>
        </div>
      </div>

      <div id="JUTAP_enegy_show" style="position: absolute;top: 0em;left: 19em;width:15em;height:120px;z-index:200">
        <div id="JUTAP_line">
          <div class="DTAP-line"style="width: 10px;height: 10px;radius: 25px;border-radius: 25px;background-color: #008ec3;position: absolute;right: 14.7em;top:-0.3em;"></div>
          <div class="DTAP-line-2" style="border-right: 1px solid #008ec3;border-top: 1px solid #008ec3;width: 11em;height: 3em;background-color: transparent;"></div>
          <div class="DTAP-line" style="width: 20px;height: 20px;border: 2px solid #fff;border-radius: 25px;radius: 25px;border-radius: 25px;background-color: #008ec3;position: absolute;left:10.3em;top: 3em;"></div>
        </div>
        <div style="position: absolute;left: -7em;top: -0.7em;color:#707070">
          <a href="overview/DTAP"><span style="font-size: 15px;">DTAP Bld.</span><br></a>
          <span id="ee_map_data" style="font-size: 11px;">Demand :<span id="show-demand-map-DTAP"></span> kWh</span><br>
          <span id="ee_map_data" style="font-size: 11px;">Supply :<span id="show-energy-map-dtmi"></span> kWh</span>
        </div>
      </div>

      <div id="JUTEG_enegy_show" style="position: absolute;top: 3em;right: -7em;width:26em;height:120px;z-index:200">
        <div id="JUTEG_line">
          <div style="width: 10px;height: 10px;radius: 25px;border-radius: 25px;background-color: #008ec3;position: absolute;left: 10.7em;top:-0.35em;"></div>
          <div style="border-left: 1px solid #008ec3;border-top: 1px solid #008ec3;width: 11em;height: 3em;background-color: transparent;"></div>
          <div style="width: 20px;height: 20px;border: 2px solid #fff;border-radius: 25px;radius: 25px;border-radius: 25px;background-color: #008ec3;position: absolute;left:-0.6em;top: 3em;"></div>
        </div>
        <div style="position: absolute;left: 13em;top: -1.7em;color:#707070">
          <span style="font-size: 15px;">DTG Bld.</span><br>
          <span id="ee_map_data" style="font-size: 11px;">Demand :<span id="show-demand-map-dtmi"></span> kWh</span><br>
          <span id="ee_map_data" style="font-size: 11px;">Supply :<span id="show-energy-map-dtmi"></span> kWh</span>
        </div>
      </div>

      <div id="JTSL_enegy_show" style="position: absolute;top: 11em;right: -14em;width:26em;height:120px;z-index:200">
        <div id="JTSL_line">
          <div style="width: 10px;height: 10px;radius: 25px;border-radius: 25px;background-color: #008ec3;position: absolute;left: 12.7em;top:2.6em;"></div>
          <div style="border-left: 1px solid #008ec3;border-bottom: 1px solid #008ec3;width: 13em;height: 3em;background-color: transparent;"></div>
          <div style="width: 20px;height: 20px;border: 2px solid #fff;border-radius: 25px;radius: 25px;border-radius: 25px;background-color: #008ec3;position: absolute;left:-0.68em;top: -1em;"></div>
        </div>
        <div style="position: absolute;left: 15em;top: 1.3em;color:#707070">
          <span style="font-size: 15px;">DTSL Bld.</span><br>
          <span id="ee_map_data" style="font-size: 11px;">Demand :<span id="show-demand-map-dtmi"></span> kWh</span><br>
          <span id="ee_map_data" style="font-size: 11px;">Supply :<span id="show-energy-map-dtmi"></span> kWh</span>
        </div>
      </div>

      <div id="DTNF_enegy_show" style="position: absolute;top: 25em;left: 7em;width:15em;height:120px;z-index:200">
        <div id="DTNF_line">
          <div style="width: 10px;height: 10px;radius: 25px;border-radius: 25px;background-color: #008ec3;position: absolute;right: 14.7em;top:4.6em;"></div>
          <div style="border-right: 1px solid #008ec3;border-bottom: 1px solid #008ec3;width: 11em;height: 5em;background-color: transparent;"></div>
          <div style="width: 20px;height: 20px;border: 2px solid #fff;border-radius: 25px;radius: 25px;border-radius: 25px;background-color: #008ec3;position: absolute;left:10.28em;top: -1em;"></div>
        </div>
        <div style="position: absolute;left: -7em;top:4em;color:#707070">
          <span style="font-size: 15px;">DNTF Bld.</span><br>
          <span id="ee_map_data" style="font-size: 11px;">Demand :<span id="show-demand-map-dtmi"></span> kWh</span><br>
          <span id="ee_map_data" style="font-size: 11px;">Supply :<span id="show-energy-map-dtmi"></span> kWh</span>
        </div>
      </div>

      <div id="KPFT_enegy_show" style="position: absolute;top: 25em;left: 25em;width:26em;height:120px;z-index:200">
        <div id="KPFT_line">
          <div style="width: 10px;height: 10px;radius: 25px;border-radius: 25px;background-color: #008ec3;position: absolute;left: 12.7em;top:2.6em;"></div>
          <div style="border-right: 1px solid #008ec3;border-top: 1px solid #008ec3;width: 13em;height: 13.4em;background-color: transparent;position: absolute;left: 0em;top:-10.4em;"></div>
          <div style="width: 20px;height: 20px;border: 2px solid #fff;border-radius: 25px;radius: 25px;border-radius: 25px;background-color: #008ec3;position: absolute;left:-0.68em;top: -11em;"></div>
        </div>
        <div style="position: absolute;left: 15em;top: 1.3em;color:#707070">
          <span style="font-size: 15px;">KPFT Bld.</span><br>
          <span id="ee_map_data" style="font-size: 11px;">Demand :<span id="show-demand-map-dtmi"></span> kWh</span><br>
          <span id="ee_map_data" style="font-size: 11px;">Supply :<span id="show-energy-map-dtmi"></span> kWh</span>
        </div>
      </div>

      <div id="DTGL_enegy_show" style="position: absolute;top: 30em;left: 27em;width:23em;height:120px;z-index:200">
        <div id="DTGL_line">
          <div style="width: 10px;height: 10px;radius: 25px;border-radius: 25px;background-color: #008ec3;position: absolute;left: 6.7em;top:2.6em;"></div>
          <div style="border-left: 1px solid #008ec3;border-bottom: 1px solid #008ec3;width: 7em;height: 8.4em;background-color: transparent;position: absolute;left: 0em;top:-5.4em;"></div>
          <div style="width: 20px;height: 20px;border: 2px solid #fff;border-radius: 25px;radius: 25px;border-radius: 25px;background-color: #008ec3;position: absolute;left:-0.68em;top: -6em;"></div>
        </div>
        <div style="position: absolute;left: 9em;top: 1.3em;color:#707070">
          <span style="font-size: 15px;">DTGL Bld.</span><br>
          <span id="ee_map_data" style="font-size: 11px;">Demand :<span id="show-demand-map-dtmi"></span> kWh</span><br>
          <span id="ee_map_data" style="font-size: 11px;">Supply :<span id="show-energy-map-dtmi"></span> kWh</span>
        </div>
      </div>
      <!-- <div id="show-chart-map" style="float: right; position: relative; top: 20em; right: -76px;">
          <img src="{{asset('images/chart-btn.png')}}" class="pointer-mouse" style="cursor:pointer"><br>
      </div> -->
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
</div>
</div>
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
<!-- get data -->
<script type="text/javascript">
function energy_level(real,target,building){
  var percentage = Math.round((real/target)*100)
  console.log(percentage);
  // $("#show_percent_energy").html(percentage);
  if(percentage < 85){
    $("#"+building+"-img").attr('src', 'images/map/'+building+'-green.png');
    $("."+building+"-line").css("backgroundColor", "#44C049");
    $("."+building+"-line-2").css("borderColor", "#44C049");

  }else if(percentage >= 85 && percentage < 93){
    $("#"+building+"-img").attr('src', 'images/map/'+building+'-yellow.png');
    $("."+building+"-line").css("backgroundColor", "#F5C922");
    $("."+building+"-line-2").css("borderColor", "#F5C922");
  }else{
    $("#"+building+"-img").attr('src', 'images/map/'+building+'-red.png');
    $("."+building+"-line").css("backgroundColor", "#F44336");
    $("."+building+"-line-2").css("borderColor", "#F44336");
  }
}
startProcess();


setTimeout(function(){
  maps().done(function(data){
    console.log(data);
    // $('#aboutus').modal('toggle');
    // parse data from api and put in html page

    for (var key in data['energy']) {
      $("#show-demand-map-"+key).html(data['energy'][key].toLocaleString());
      energy_level(data['energy'][key],data['alert'][key]['kwh_target'],key);

    }
    }).complete(function(){endProcess();});
},750);

    setInterval(function(){
      maps().done(function(data){
        // parse data from api and put in html page
        for (var key in data['energy']) {
          $("#show-demand-map-"+key).html(data['energy'][key].toLocaleString());
        }
      });
    }, 5*60000);
</script>

@endsection
