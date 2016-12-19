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

class UsageController extends Controller
{
    public function usageprofile()
    {
      $buildings = \DB::table('data_building')->get();
      foreach ($buildings as $building) {
        $id_building  = $building->id_building;
        $where[1]['id_building']  = $id_building;

        // <-- get data alert -->
        $data['alert']=Alert::getAlert(['id_building'=>$building->id_building,'id_floor'=>'main']);

        $tdy = Carbon::now()->startOfDay();

        // <-- start of calculating today data -->
        $powerTdy     = Power::getPower($where[1],'date(time) = ?',Carbon::today()->toDateString());
        $data['power']['currenttoday'] = round((!empty($powerTdy[0]->power) ? $powerTdy[0]->power : 0 )/1000,2);
        $data['power']['maxtoday']= round((collect($powerTdy)->max('power'))/1000,2);

        $energyTdy  = Energy::getEnergies($where[1],'date(time) = ?',$tdy->toDateString());
        $etotDLast   = (empty($energyTdy)) ? 0 : reset($energyTdy)->etotal;
        $etotDFirst  = (empty($energyTdy)) ? 0 : end($energyTdy)->etotal;
        $data['energy']['totaltoday'] = (($etotDLast-$etotDFirst) < 0) ? 0 : round(($etotDLast-$etotDFirst)/1000,2);

        for ($i=0; $i < 96; $i++) {
          $tdy_etot_avg    = Energy::getEnergyRange($where[1],$tdy->toDateTimeString(),$tdy->addMinutes(15)->toDateTimeString());
          $data['dttdy'][] = round(($tdy_etot_avg)/1000,2);
        }
        // <-- end of calculating today data -->

      //   // <-- start of calculating month data -->
      //   $thsyr      = Carbon::now()->year;
      //   $thsmnth    = Carbon::now()->month;
      //
      //   $energyMnth  = Energy::getEnergies($where[1],'date_format(time, "%m-%Y") = ?',$thsmnth.'-'.$thsyr);
      //   $etotMLast   = (empty($energyMnth)) ? 0 : reset($energyMnth)->etotal;
      //   $etotMFirst  = (empty($energyMnth)) ? 0 : end($energyMnth)->etotal;
      //   $data['energy']['totalmonth'] = (($etotMLast-$etotMFirst) < 0) ? 0 : round(($etotMLast-$etotMFirst)/1000,2);
      //
      //   $powerMth     = Power::getPower($where[1],'date_format(time, "%m-%Y") = ?',$thsmnth.'-'.$thsyr);
      //   $current      = Power::getPowerCurrent($where[1],'date_format(time, "%m-%Y") = ?',$thsmnth.'-'.$thsyr);
      //   $max          = Power::getPowerMax($where[1],'date_format(time, "%m-%Y") = ?',$thsmnth.'-'.$thsyr);
      //   $data['power']['currentmonth'] = round((!empty($powerMth[0]->power) ? $powerMth[0]->power : 0 )/1000,2);
      //   $data['power']['maxmonth']= round(($max->power)/1000,2);
      //   $data['asoy'] = $curre
      // //   $thsyr      = Carbon::now()->year;
      //   $daysinmonth  = intval(cal_days_in_month(CAL_GREGORIAN, $thsmnth, $thsyr));
      //   for ($i=1; $i <= $daysinmonth; $i++) {
      //     $etotMnthL = Energy::getEnergy($where[1],'date(time) = ?',Carbon::createFromDate($thsyr, $thsmnth, $i)->toDateString());
      //     $etotMnthF = Energy::getEnergy($where[1],'date(time) = ?',Carbon::createFromDate($thsyr, $thsmnth, $i-1)->toDateString());
      //     $data['dtmnth'][] = (($etotMnthL-$etotMnthF) < 0) ? 0 : round(($etotMnthL-$etotMnthF),2);
      //   }
        // <-- end of calculating month data -->

        // <-- start of calculating year data -->
      //   $thsyr      = Carbon::now()->year;

        // $etot['thsYear'] = Energy::getEnergy($where[1],'year(time) = ?',$thsyr);
        // $etot['lstYear'] = Energy::getEnergy($where[1],'year(time) = ?',Carbon::now()->subYear());
      //   $powerYr     = Power::getPower($where[3],'year(time) = ?',$thsyr);
      //   $data['power']['currentyear'] = round((!empty($powerYr[0]->power) ? $powerYr[0]->power : 0 )/1000,2);
      //   $data['power']['maxyear']= round((collect($powerYr)->max('power'))/1000,2);
      //
        // if(( $etot['thsYear']-$etot['lstYear'])<0){
        //   $data['energy']['totalyear'] = 0;
        // }else{
        //   $data['energy']['totalyear'] = $etot['thsYear']-$etot['lstYear'];
        // }
      //
      //   for ($j=1; $j <= 12; $j++) {
      //     $tmpmnth1       = Energy::getEnergy($where[3],'date_format(time, "%m-%Y") = ?',$j.'-'.$thsyr);
      //     $tmpmnth2       = Energy::getEnergy($where[3],'date_format(time, "%m-%Y") = ?',($j-1).'-'.$thsyr);
      //     $data['dtyr'][] = round(($tmpmnth1-$tmpmnth2)/1000,2);
      //   }
      //   // <-- end of calculating year data -->$dtPower
        $data['id_building']=$building->id_building;
        $dt[]=$data;
        $data=[]; //flush data
      }
        return view('pages/usage-profile', array('page' => 'usage-profile', 'data_buildings'=>$buildings, 'page_data'=>$dt));
    }

    public function day()
    {
      $buildings = \DB::table('data_building')->get();
      foreach ($buildings as $building) {
        $id_building  = $building->id_building;
        $where[1]['id_building']  = $id_building;

        // <-- get data alert -->
        $data['alert']=Alert::getAlert(['id_building'=>$building->id_building,'id_floor'=>'main']);

        $tdy = Carbon::now()->startOfDay();

        // <-- start of calculating today data -->
        $powerTdy     = Power::getPower($where[1],'date(time) = ?',Carbon::today()->toDateString());
        $data['power']['currenttoday'] = round((!empty($powerTdy[0]->power) ? $powerTdy[0]->power : 0 )/1000,2);
        $data['power']['maxtoday']= round((collect($powerTdy)->max('power'))/1000,2);

        $energyTdy  = Energy::getEnergies($where[1],'date(time) = ?',$tdy->toDateString());
        $etotDLast   = (empty($energyTdy)) ? 0 : reset($energyTdy)->etotal;
        $etotDFirst  = (empty($energyTdy)) ? 0 : end($energyTdy)->etotal;
        $data['energy']['totaltoday'] = (($etotDLast-$etotDFirst) < 0) ? 0 : round(($etotDLast-$etotDFirst)/1000,2);

        for ($i=0; $i < 96; $i++) {
          $tdy_etot_avg    = Energy::getEnergyRange($where[1],$tdy->toDateTimeString(),$tdy->addMinutes(15)->toDateTimeString());
          $data['dttdy'][] = ($tdy_etot_avg < 0) ? 0 : round(($tdy_etot_avg)/1000,2);
        }
        // <-- end of calculating today data -->

        $data['id_building']=$building->id_building;
        $dt[]=$data;
        $data=[]; //flush data
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
            $etotMnthL = Energy::getEnergy($where[1],'date(time) = ?',Carbon::createFromDate($thsyr, $thsmnth, $i)->toDateString());
            $etotMnthF = Energy::getEnergy($where[1],'date(time) = ?',Carbon::createFromDate($thsyr, $thsmnth, $i-1)->toDateString());
            $data['dtmnth'][] = (($etotMnthL-$etotMnthF) < 0) ? 0 : round(($etotMnthL-$etotMnthF),2);
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
        $powerYr     = Power::getPower($where[1],'year(time) = ?',$thsyr);
        $data['power']['currentyear'] = round((!empty($powerYr[0]->power) ? $powerYr[0]->power : 0 )/1000,2);
        $data['power']['maxyear']= round((collect($powerYr)->max('power'))/1000,2);

        if(( $etot['thsYear']-$etot['lstYear'])<0){
          $data['energy']['totalyear'] = 0;
        }else{
          $data['energy']['totalyear'] = $etot['thsYear']-$etot['lstYear'];
        }

        for ($j=1; $j <= 12; $j++) {
          $tmpmnth1       = Energy::getEnergy($where[1],'date_format(time, "%m-%Y") = ?',$j.'-'.$thsyr);
          $tmpmnth2       = Energy::getEnergy($where[1],'date_format(time, "%m-%Y") = ?',($j-1).'-'.$thsyr);
          $data['dtyr'][] = round(($tmpmnth1-$tmpmnth2)/1000,2);
        }
        // <-- end of calculating year data -->

        $data['id_building']=$building->id_building;
        $dt[]=$data;
        $data=[]; //flush data
      }
      return \Response::json($dt);
    }
}
