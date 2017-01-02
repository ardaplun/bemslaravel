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

class LoadController extends Controller
{
  public function loadprofile()
  {
      $buildings = \DB::table('data_building')->get();
      foreach ($buildings as $building) {
        $id_building  = $building->id_building;
        $where[1]['id_building']  = $id_building;

        // <-- get data alert -->
        $data['alert'][$building->id_building]=Alert::getAlert(['id_building'=>$id_building,'id_floor'=>'main']);

        $tdy = Carbon::now()->startOfDay();
        // <-- start of calculating today data -->
        $powerTdy     = Power::getPower($where[1],'date(time) = ?',Carbon::today()->toDateString());
        $data['power']['currenttoday'] = round((!empty($powerTdy[0]->power) ? $powerTdy[0]->power : 0 )/1000,2);
        $data['power']['maxtoday']= round((collect($powerTdy)->max('power'))/1000,2);

        $energyTdy   = Energy::getEnergies($where[1],'date(time) = ?',$tdy->toDateString());
        $etotDLast   = (empty($energyTdy)) ? 0 : reset($energyTdy)->etotal;
        $etotDFirst  = (empty($energyTdy)) ? 0 : end($energyTdy)->etotal;
        $data['energy']['totaltoday'] = (($etotDLast-$etotDFirst) < 0) ? 0 : round(($etotDLast-$etotDFirst)/1000,2);

        for ($i=0; $i < 96; $i++) {
          $tdy_pwr_avg     = Power::getPowerAvg($where[1],$tdy->toDateTimeString(),$tdy->addMinutes(15)->toDateTimeString());
          $data['dttdy'][] =  round(($tdy_pwr_avg)/1000,2);
        }
        // <-- end of calculating today data -->

        $data['id_building']=$building->id_building;
        $dt[]=$data;
        $data=[]; //flush data
      }

      return view('pages/load-profile', array('page' => 'load-profile', 'data_buildings'=>$buildings, 'page_data'=>$dt));
  }
  public function day()
  {
    $buildings = \DB::table('data_building')->get();
    foreach ($buildings as $building) {
      $id_building              = $building->id_building;
      $where[1]['id_building']  = $id_building;

      // <-- get data alert -->
      $data['alert']=Alert::getAlert(['id_building'=>$building->id_building,'id_floor'=>'main']);

      $tdy = Carbon::now()->startOfDay();

      // <-- start of calculating today data -->
      $powerTdy     = Power::getPower($where[1],'date(time) = ?',Carbon::today()->toDateString());
      $data['power']['currenttoday'] = round((!empty($powerTdy[0]->power) ? $powerTdy[0]->power : 0 )/1000,2);
      $data['power']['maxtoday']= round((collect($powerTdy)->max('power'))/1000,2);

      $energyTdy   = Energy::getEnergies($where[1],'date(time) = ?',$tdy->toDateString());
      $etotDLast   = (empty($energyTdy)) ? 0 : reset($energyTdy)->etotal;
      $etotDFirst  = (empty($energyTdy)) ? 0 : end($energyTdy)->etotal;
      $data['energy']['totaltoday'] = (($etotDLast-$etotDFirst) < 0) ? 0 : round(($etotDLast-$etotDFirst)/1000,2);

      for ($i=0; $i < 96; $i++) {
        $tdy_pwr_avg     = Power::getPowerAvg($where[1],$tdy->toDateTimeString(),$tdy->addMinutes(15)->toDateTimeString());
        $data['dttdy'][] =  round(($tdy_pwr_avg)/1000,2);
      }
      // <-- end of calculating today data -->

      $data['id_building'] = $building->id_building;
      $dt[]   = $data;
      $data   = []; //flush data
    }
      return \Response::json($dt);
  }

  public function month()
  {
    $buildings = \DB::table('data_building')->get();
    foreach ($buildings as $building) {
      $id_building  = $building->id_building;
      $where[1]['id_building']  = $id_building;

      // <-- get data alert -->
      $data['alert']=Alert::getAlert(['id_building'=>$building->id_building,'id_floor'=>'main']);

      $tdy = Carbon::now()->startOfDay();
      // <-- start of calculating month data -->
      $thsyr      = Carbon::now()->year;
      $thsmnth    = Carbon::now()->month;

      $energyMnth  = Energy::getEnergies($where[1],'date_format(time, "%m-%Y") = ?',$thsmnth.'-'.$thsyr);
      $etotMLast   = (empty($energyMnth)) ? 0 : reset($energyMnth)->etotal;
      $etotMFirst  = (empty($energyMnth)) ? 0 : end($energyMnth)->etotal;
      $data['energy']['totalmonth'] = (($etotMLast-$etotMFirst) < 0) ? 0 : round(($etotMLast-$etotMFirst)/1000,2);

      $powerMth     = Power::getPower($where[1],'date_format(time, "%m-%Y") = ?',$thsmnth.'-'.$thsyr);
      $data['power']['currentmonth'] = round((!empty($powerMth[0]->power) ? $powerMth[0]->power : 0 )/1000,2);
      $data['power']['maxmonth']= round((collect($powerMth)->max('power'))/1000,2);


      $thsyr      = Carbon::now()->year;
      $daysinmonth  = intval(cal_days_in_month(CAL_GREGORIAN, $thsmnth, $thsyr));
      for ($i=1; $i <= $daysinmonth; $i++) {
        $pwrMnth          = Power::getPower($where[1],'date(time) = ?',Carbon::createFromDate($thsyr, $thsmnth, $i)->toDateString());
        $pwrMnth          = collect($pwrMnth)->avg('power');
        $data['dtmnth'][] = round(($pwrMnth)/1000,2);
      }
      // <-- end of calculating month data -->

      $data['id_building']=$building->id_building;
      $dt[]=$data;
      $data=[]; //flush data
    }
    return \Response::json($dt);
  }

  public function year()
  {
    $buildings = \DB::table('data_building')->get();
    foreach ($buildings as $building) {
      $id_building  = $building->id_building;
      $where[1]['id_building']  = $id_building;

      // <-- get data alert -->
      $data['alert']=Alert::getAlert(['id_building'=>$building->id_building,'id_floor'=>'main']);

      $tdy = Carbon::now()->startOfDay();

      // <-- start of calculating year data -->
      $thsyr      = Carbon::now()->year;

      $etot['thsYear'] = Energy::getEnergy($where[1],'year(time) = ?',$thsyr);
      $etot['lstYear'] = Energy::getEnergy($where[1],'year(time) = ?',Carbon::now()->subYear());
      $data['energy']['totalyear'] = (($etot['thsYear']-$etot['lstYear'])<0) ? 0 : $etot['thsYear']-$etot['lstYear'];

      $powerYr     = Power::getPower($where[1],'year(time) = ?',$thsyr);
      $data['power']['currentyear'] = round((!empty($powerYr[0]->power) ? $powerYr[0]->power : 0 )/1000,2);
      $data['power']['maxyear']= round((collect($powerYr)->max('power'))/1000,2);


      for ($i= 01; $i <=12 ; $i++) {
        $tmpmnth        = Power::getPower($where[1],'date_format(time, "%m-%Y") = ?',str_pad($i, 2, '0', STR_PAD_LEFT).'-'.$thsyr);
        $tmpmnth        = collect($tmpmnth)->avg('power');
        $data['dtyr'][] = round(($tmpmnth)/1000,2);
      }
      // <-- end of calculating year data -->

      $data['id_building']=$building->id_building;
      $dt[]=$data;
      $data=[]; //flush data
    }
    return \Response::json($dt);
  }
}
