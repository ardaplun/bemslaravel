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
              <span id="bld_lv" class="txt_pink" style="font-size:1.3em;font-weight:400;padding-left:1.7em">ELECTRICAL ENGINEERING AND TECHNOLOGY INFORMATION</span> : <span id="floor_lv" class="txt_blue">1<sup style="font-size:15px;">ST</sup> FLOOR</span>
              <div class="col-sm-7">
                <div class="col-sm-6" style="padding-top:0.3em">
                  <div class="btn-group" style="border: 1px solid #B2B2B3;border-radius: 5px;width:100%">
                      <div class="btn-group " data-toggle="buttons" id="area_button" style="border: 1px solid #B2B2B3;border-radius: 3px;width:100%">
                        <label class="btn" disabled>
                          AREA :
                        </label>
                        <label class="btn area_pick" value="all" style="border-right: 1px solid #DAD8D8;">
                          <input type="radio" >All
                        </label>
                      </div>
                  </div>
                </div>
                <div class="col-sm-6"  style="padding-top:0.3em">
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
                </div>

              </div>
              <div class="col-sm-5" >
                <div class="chart_style" style="background-color:rgba(255, 255, 255, 0.68)">
                  <div id="container_pie0" class="container_donut_style"style="width:100%;border:1px solid #B2B2B3;"></div>
                  <script type="text/javascript">Donutchart('container_pie0');</script>
                </div>
                <div class="chart_style" style="background-color:rgba(255, 255, 255, 0.68)">
                  <div id="container_pie1" class="container_donut_style" style="width:100%;border:1px solid #B2B2B3;"></div>
                  <script type="text/javascript">Donutchart('container_pie1');</script>
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

</body>
@endsection
