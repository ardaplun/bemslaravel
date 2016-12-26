<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Energy;
use App\Models\Room;
use App\Models\Device;
use App\Models\Power;
use App\Models\Alert;
use App\Models\Current;
use App\Models\PF;
use Carbon\Carbon, Response;

class CurrentController extends Controller
{
    public function currentprofile()
    {
      $buildings = \DB::table('data_building')->get();
      foreach ($buildings as $building) {
        $id_building  = $building->id_building;
        $where[1]['id_building']  = $id_building;

        // <-- get data alert -->
        $data['alert']=Alert::getAlert(['id_building'=>$id_building,'id_floor'=>'main']);

        $tdy = Carbon::now()->startOfDay();

        // <-- start of calculating today data -->
        $powerTdy     = Power::getPower($where[1],'date(time) = ?',Carbon::today()->toDateString());
        $data['power']['currenttoday'] = round((!empty($powerTdy[0]->power) ? $powerTdy[0]->power : 0 )/1000,2);
        $data['power']['maxtoday']= round((collect($powerTdy)->max('power'))/1000,2);

        $energyTdy   = Energy::getEnergies($where[1],'date(time) = ?',$tdy->toDateString());
        $etotDLast   = (empty($energyTdy)) ? 0 : reset($energyTdy)->etotal;
        $etotDFirst  = (empty($energyTdy)) ? 0 : end($energyTdy)->etotal;
        $data['energy']['totaltoday'] = (($etotDLast-$etotDFirst) < 0) ? 0 : round(($etotDLast-$etotDFirst)/1000,2);

        $tdy_curr = Current::getCurrent($where[1],'date(time) = ?',$tdy->toDateString());
        $tdy_pf = PF::getPF($where[1],'date(time) = ?',$tdy->toDateString());

        if (!empty($tdy_curr)) {
          foreach ($tdy_curr as $key => $value) {
            $data['dtcurr'][]   = round($value,2);
          }
        } else {
          for ($i=0; $i < 3; $i++) {
            $data['dtcurr'][]   = 0;
          }
        }

        if (!empty($tdy_pf)) {
          foreach ($tdy_pf as $key => $value) {
            $data['dtpf'][]   = round($value,2);
          }
        } else {
          for ($i=0; $i < 3; $i++) {
            $data['dtpf'][]   = 0;
          }
        }

        $data['id_building']  = $building->id_building;
        $dt[] = $data;
        $data = []; //flush data
      }
        return view('pages/current-profile', array('page' => 'current-profile', 'data_buildings'=>$buildings, 'page_data'=>$dt));
    }

    public function getCurrent()
    {
      $buildings = \DB::table('data_building')->get();
      foreach ($buildings as $building) {
        $id_building  = $building->id_building;
        $where[1]['id_building']  = $id_building;

        // <-- get data alert -->
        $data['alert']=Alert::getAlert(['id_building'=>$id_building,'id_floor'=>'main']);

        $tdy = Carbon::now()->startOfDay();

        // <-- start of calculating today data -->
        $powerTdy     = Power::getPower($where[1],'date(time) = ?',Carbon::today()->toDateString());
        $data['power']['currenttoday'] = round((!empty($powerTdy[0]->power) ? $powerTdy[0]->power : 0 )/1000,2);
        $data['power']['maxtoday']= round((collect($powerTdy)->max('power'))/1000,2);

        $energyTdy   = Energy::getEnergies($where[1],'date(time) = ?',$tdy->toDateString());
        $etotDLast   = (empty($energyTdy)) ? 0 : reset($energyTdy)->etotal;
        $etotDFirst  = (empty($energyTdy)) ? 0 : end($energyTdy)->etotal;
        $data['energy']['totaltoday'] = (($etotDLast-$etotDFirst) < 0) ? 0 : round(($etotDLast-$etotDFirst)/1000,2);

        $tdy_curr = Current::getCurrent($where[1],'date(time) = ?',$tdy->toDateString());
        $i = 0;
        foreach ($tdy_curr as $key => $value) {
          $data['dtcurr'][]   = round($value,2);
        }
        $data['id_building']  = $building->id_building;
        $dt[] = $data;
        $data = []; //flush data
      }
        return \Response::json($dt);
    }
}
