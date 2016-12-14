<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Energy;
use App\Models\Room;
use App\Models\Device;
use App\Models\Power;
use App\Models\Alert;
use Carbon\Carbon;

class Home extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages/maps', array('page' => 'maps'));
    }
    public function overview($building)
    {
        return view('pages/overview', array('page' => 'overview', 'building'=> $building));
    }

    public function loadprofile()
    {
        $buildings = \DB::table('data_building')->get();
        foreach ($buildings as $building) {
          $where[1]['id_building']=$building->id_building;
          $where[1]['id_floor']='main';
          $where[1]['room_category']='MDP';
          $where[2]['id_room']=Room::getMDP($where[1]);
          $where[3]['id_device']=Device::getDevice($where[2]);
          // <-- get data max kwh -->
          $data['alert'][$building->id_building]=Alert::getAlert(['id_building'=>$building->id_building,'id_floor'=>'main']);

          $tdy = Carbon::now()->startOfDay();
          $yst = Carbon::now()->subDay();
          // <-- start of calculating today data -->
          $etot['tdy']  = Energy::getEnergy($where[3],'date(time) = ?',$tdy->toDateString());
          $etot['yst']  = Energy::getEnergy($where[3],'date(time) = ?',$yst->toDateString());
          $powerTdy     = Power::getPower($where[3],'date(time) = ?',\Carbon\Carbon::today()->toDateString());
          $data['power']['currenttoday'] = round((!empty($powerTdy[0]->power) ? $powerTdy[0]->power : 0 )/1000,2);
          $data['power']['maxtoday']= round((collect($powerTdy)->max('power'))/1000,2);

          if(($etot['tdy']-$etot['yst']) < 0){
            $data['energy']['totaltoday'] = 0;
          }else{
            // $data['energy']['totaltoday'] = number_format($etot['tdy']-$etot['yst']);
            $data['energy']['totaltoday'] = $etot['tdy']-$etot['yst'];
          }

          for ($i=0; $i < 96; $i++) {
            if($tdy->toDateTimeString() <= $now=\Carbon\Carbon::now()){
              $tdy_pwr_avg = Power::getPowerAvg($where[3],$tdy->toDateTimeString(),$tdy->addMinutes(15)->toDateTimeString());
              $data['dttdy'][] =  round(($tdy_pwr_avg)/1000,2);
            }else{
              $yst_pwr_avg = Power::getPowerAvg($where[3],$yst->toDateTimeString(),$yst->addMinutes(15)->toDateTimeString());
              $data['dttdy'][] =  0;
            }
          }
          // <-- end of calculating today data -->

          // <-- start of calculating month data -->
          $thsyr      = Carbon::now()->year;
          $thsmnth    = Carbon::now()->month;

          $etot['thsMonth'] = Energy::getEnergy($where[3],'date_format(time, "%m-%Y") = ?',$thsmnth.'-'.$thsyr);
          $etot['lstMonth'] = Energy::getEnergy($where[3],'date_format(time, "%m-%Y") = ?',Carbon::now()->subMonth()->month.'-'.$thsyr);
          $powerMth     = Power::getPower($where[3],'date_format(time, "%m-%Y") = ?',$thsmnth.'-'.$thsyr);
          $data['power']['currentmonth'] = round((!empty($powerMth[0]->power) ? $powerMth[0]->power : 0 )/1000,2);
          $data['power']['maxmonth']= round((collect($powerMth)->max('power'))/1000,2);

          if(( $etot['thsMonth']-$etot['lstMonth'])<0){
            $data['energy']['totalmonth'] = 0;
          }else{
            // $data['energy']['totalmonth'] = number_format($etot['thsMonth']-$etot['lstMonth']);
            $data['energy']['totalmonth'] = $etot['thsMonth']-$etot['lstMonth'];
          }
          $thsyr      = Carbon::now()->year;
          $daysinmonth  = intval(cal_days_in_month(CAL_GREGORIAN, $thsmnth, $thsyr));
          for ($i=1; $i <= $daysinmonth; $i++) {
            $tmpday           = Carbon::createFromDate($thsyr, $thsmnth, $i);
            $tmpday           = Power::getPower($where[3],'date(time) = ?',$tmpday->toDateString());
            $tmpday           = collect($tmpday)->avg('power');
            $data['dtmnth'][] = round(($tmpday)/1000,2);
          }
          // <-- end of calculating month data -->

          // <-- start of calculating year data -->
          $thsyr      = Carbon::now()->year;

          $etot['thsYear'] = Energy::getEnergy($where[3],'year(time) = ?',$thsyr);
          $etot['lstYear'] = Energy::getEnergy($where[3],'year(time) = ?',Carbon::now()->subYear());
          $powerYr     = Power::getPower($where[3],'year(time) = ?',$thsyr);
          $data['power']['currentyear'] = round((!empty($powerYr[0]->power) ? $powerYr[0]->power : 0 )/1000,2);
          $data['power']['maxyear']= round((collect($powerYr)->max('power'))/1000,2);

          if(( $etot['thsYear']-$etot['lstYear'])<0){
            $data['energy']['totalyear'] = 0;
          }else{
            $data['energy']['totalyear'] = $etot['thsYear']-$etot['lstYear'];
          }

          for ($j=1; $j <= 12; $j++) {
            $tmpmnth        = Power::getPower($where[3],'date_format(time, "%m-%Y") = ?',$j.'-'.$thsyr);
            $tmpmnth        = collect($tmpmnth)->avg('power');
            $data['dtyr'][] = round(($tmpmnth)/1000,2);
          }
          // <-- end of calculating year data -->
          $data['id_building']=$building->id_building;
          $dt[]=$data;
          $data=[]; //flush data
        }

        return view('pages/load-profile', array('page' => 'load-profile', 'data_buildings'=>$buildings, 'page_data'=>$dt));
    }

    public function detail_building($building)
    {
        $data_floor = \DB::table('data_floor')->orderBy('id_floor', 'asc')->where('id_building',$building)->get();
        $data_building = \DB::table('data_building')->where('id_building',$building)->first();
        if ($data_floor==NULL) {
          return view('errors/404');
        }else{
          return view('pages/building', array('page' => 'detail-building', 'building'=> $data_building, 'data_floors'=>$data_floor ));
        }
    }

    public function detail_floor($building, $floor)
    {
      $data = \DB::table('data_floor')->where(['id_building'=>$building, 'id_floor'=>$floor])->first();
      $data_pin = \DB::table('data_room')->where(['id_building'=>$building, 'id_floor'=>$floor])->get();
      if ($data==NULL) {
        return view('errors/404');
      }else{
        return view('pages/detail_floor', array('page' => 'detail-floor', 'data'=>$data,'data_pin'=>$data_pin));
      }
    }

    public function detail_room($building, $floor, $room)
    {
        $data = \DB::table('data_room')->where(['id_building'=>$building, 'id_floor'=>$floor, 'id_room'=>$room])->first();
        $data_site = \DB::table('data_floor')->leftJoin('data_room', 'data_floor.id_floor', '=', 'data_room.id_floor')->get();
        $data_device = \DB::table('data_device')->where(['id_room'=>$room])->get();

        if ($data==NULL) {
          return view('errors/404');
        }else{
          return view('pages/detail_room', array('page' => 'detail-room', 'data'=>$data, 'data_site'=>$data_site, 'data_device'=>$data_device));
        }
    }

    public function login()
    {
        return view('admins/login', array('page' => 'login'));
    }
}
