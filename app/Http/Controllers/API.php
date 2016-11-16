<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Energy;
use App\Models\Room;
use App\Models\Device;
use App\Models\Power;
use App\Models\Floor;
use App\Models\Alert;
use App\Models\Building;
use Helper;

class API extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     //function for calculate power in another controller function
     private function calculatePower($devices,$time)
     {
       $data=[];
       if ($time=='today') {
         $tdy = \Carbon\Carbon::now()->startOfDay();
        //  $yst = \Carbon\Carbon::now()->startOfDay()->subDay();
         for ($i=0; $i < 96; $i++) {
           $data[] = (collect(\DB::table('get_energy')->select('power')->whereIn('id_device',collect($devices)->lists('id_device'))->whereBetween('time', [$tdy->toDateTimeString(),$tdy->addMinutes(15)->toDateTimeString()])->get())->avg('power'))/1000;
          //  $data['yesterday'][] = collect(\DB::table('get_energy')->select('power')->whereIn('id_device',collect($devices)->lists('id_device'))->whereBetween('time', [$yst->toDateTimeString(),$yst->addMinutes(15)->toDateTimeString()])->get())->avg('power');
         }
       }else if ($time=='month') {
          $day = \Carbon\Carbon::now();
          $count=$day->daysInMonth;
          $day->startOfMonth();
          for ($i=0; $i < $count; $i++) {
            $data[] = (collect(\DB::table('get_energy')->select('power')->whereIn('id_device',collect($devices)->lists('id_device'))->whereRaw('date(time) = ?', [$day->toDateString()])->get())->avg('power'))/1000;
            $day->addDay()->toDateString();
          }
       }else if ($time=='year') {
          $month = \Carbon\Carbon::now();
          $month->startOfYear();
          for ($i=0; $i < 12; $i++) {

            $data[$month->month] = (collect(\DB::table('get_energy')->select('power')->whereIn('id_device',collect($devices)->lists('id_device'))->whereRaw('month(time) = ?', [$month->month])->get())->avg('power'))/1000;
            $month->addMonth()->toDateString();
          }
       }
       return $data;
     }

     private function calculateEnergy($tmp)
     {
       //calculate load energy
       if(isset($tmp['light'])){
         $sum=array_sum($tmp['light']);
         $data['donutLoad'][]=array_add(['name'=>'Light'],'y',$sum);
       }
       if(isset($tmp['AC'])){
         $sum=array_sum($tmp['AC']);
         $data['donutLoad'][]=array_add(['name'=>'AC'],'y',$sum);
       }
       if(isset($tmp['outlet'])){
         $sum=array_sum($tmp['outlet']);
         $data['donutLoad'][]=array_add(['name'=>'Outlet'],'y',$sum);
       }
       //calculate area energy
       if(isset($tmp['north'])){
         $sum=array_sum($tmp['north']);
         $data['donutArea'][]=array_add(['name'=>'North'],'y',$sum);
       }
       if(isset($tmp['south'])){
         $sum=array_sum($tmp['south']);
         $data['donutArea'][]=array_add(['name'=>'South'],'y',$sum);
       }
       return $data;
     }


// API get data for webapp
    public function maps()
    {
      $data['energy']=[];
      $buildings=Building::getBuildings();
      foreach ($buildings as $building) {
        $where[1]['id_building']=$building->id_building;
        $where[1]['id_floor']='main';
        $where[1]['room_category']='MDP';
        $where[2]['id_room']=Room::getMDP($where[1]);
        $where[3]['id_device']=Device::getDevice($where[2]);

        $etot['thsMonth']=Energy::getEnergy($where[3],'date(time) = ?',\Carbon\Carbon::today()->toDateString());
        $etot['lstMonth']=Energy::getEnergy($where[3],'date(time) = ?',\Carbon\Carbon::now()->subMonth()->endOfMonth()->toDateString());

        $data['alert'][$building->id_building]=Alert::getAlert(['id_building'=>$building->id_building,'id_floor'=>'main']);
        if(( $etot['thsMonth']-$etot['lstMonth'])<0){
          $data['energy'][$building->id_building]=0;
        }else{
          $data['energy'][$building->id_building]=$etot['thsMonth']-$etot['lstMonth'];
        }
      }
      return \Response::json($data);
    }

    public function home()
    {
      $input = \Request::all();
      $today = \Carbon\Carbon::today()->toDateString();
      $thsmonth = \Carbon\Carbon::now()->month;

      // -------old query-------
      //query data for energy
      // $data['energy']['total'] = round((collect(\DB::table('get_energy')->select('energy')->whereRaw('month(time) = ?', [$thsmonth])->get())->sum('energy'))/1000,2);
      // $data['energy']['today'] = round((collect(\DB::table('get_energy')->select('energy')->whereRaw('date(time) = ?', [$today])->get())->sum('energy'))/1000,2);
      // //query data for power
      // $query_pwr = \DB::table('get_energy')->select('power')->whereRaw('date(time) = ?', [$today])->get();
      // $i = count($query_pwr);
      // // $query_pwr = \DB::table('get_energy')->select('power')->orderBy('time', 'desc')->whereRaw('date(time) = ?', [$today])->get();
      // if($i != 0)
      // {
      //   $data['power']['current'] = round(($query_pwr[$i-1]->power)/1000,2);
      //   $data['power']['max'] = round((collect($query_pwr)->max('power'))/1000,2);
      // }else {
      //   $data['power']['current'] = 0;
      //   $data['power']['max'] = 0;
      // }
      // $tdy = \Carbon\Carbon::now()->startOfDay();
      // $yst = \Carbon\Carbon::now()->startOfDay()->subDay();
      // for ($i=0; $i < 96; $i++) {
      //   if($tdy->toDateTimeString() < $now=\Carbon\Carbon::now()){
            // $data['today'][] = round((collect(\DB::table('get_energy')->select('power')->whereBetween('time', [$tdy->toDateTimeString(),$tdy->addMinutes(15)->toDateTimeString()])->get())->avg('power'))/1000, 2);
            // $data_yst = round((collect(\DB::table('get_energy')->select('power')->whereBetween('time', [$yst->toDateTimeString(),$yst->addMinutes(15)->toDateTimeString()])->get())->avg('power'))/1000,2);
            // if($data_yst!=null){
            //   $data['yst_line'][] = $data_yst;
            //   $data['yst_bar'][] = $data_yst;
            // }else{
            //   $data['yst_line'][] = 0;
            //   $data['yst_bar'][] = 0;
            // }
        // }else{
          // $data_yst = round((collect(\DB::table('get_energy')->select('power')->whereBetween('time', [$yst->toDateTimeString(),$yst->addMinutes(15)->toDateTimeString()])->get())->avg('power'))/1000,2);
          // if($data_yst!=null){
          //   $data['yst_line'][] = $data_yst;
          //   $data['yst_bar'][] = $data_yst;
          // }else{
          //   $data['yst_line'][] = 0;
          //   $data['yst_bar'][] = 0;
          // }
      //   }
      // }
      // $floors=\DB::table('data_floor')->where('deleted_at', NULL)->where('id_building','=',$input['building'])->get();
      // foreach ($floors as $floor) {
      //   $rooms = \DB::table('data_room')->where('deleted_at', NULL)->where(['id_building'=>$floor->id_building,'id_floor'=>$floor->id_floor])->lists('id_room');
      //   // foreach ($rooms as $room) {
      //   $devices = \DB::table('data_device')->whereIn('id_room',$rooms)->lists('id_device');
      //     $tmp['name']=$floor->floor_name.' floor';
      //     $tmp['y']=(collect(\DB::table('get_energy')->select('energy')->whereIn('id_device',$devices)->whereRaw('month(time) = ?', [$thsmonth])->get())->sum('energy'))/1000;
      //     $data['donutData'][] = $tmp;
      //   // }
      // }
      // $rooms = \DB::table('data_room')->where('id_building','=',$input['building'])->get();
      // foreach ($rooms as $room) {
      //   $devices = \DB::table('data_device')->where('id_room','=',$room->id_room)->lists('id_device');
      //   $data['donutData']['name'][]=$room->id_floor;
      //   $data['donutData']['data'][] = collect(\DB::table('get_energy')->select('energy')->whereIn('id_device',$devices)->whereRaw('month(time) = ?', [$thsmonth])->get())->sum('energy');
      //   $data['room'][]=$rooms;
      // }
            //---------- new query -----------

      // get id device main MDP building
      $where[1]['id_building']=$input['building'];
      $where[1]['id_floor']='main';
      $where[1]['room_category']='MDP';
      $where[2]['id_room']=Room::getMDP($where[1]);
      $where[3]['id_device']=Device::getDevice($where[2]);
      // $data['where']=$where;

      // get chart power data
      $tdy = \Carbon\Carbon::now()->startOfDay();
      $yst = \Carbon\Carbon::now()->startOfDay()->subDay();
      for ($i=0; $i < 96; $i++) {
        if($tdy->toDateTimeString() < $now=\Carbon\Carbon::now()){
          $tdy_pwr_avg = Power::getPowerAvg($where[3],$tdy->toDateTimeString(),$tdy->addMinutes(15)->toDateTimeString());
          $data['today'][] =  round(($tdy_pwr_avg)/1000,2);
        }
          $yst_pwr_avg = Power::getPowerAvg($where[3],$yst->toDateTimeString(),$yst->addMinutes(15)->toDateTimeString());
          $data['yst_line'][] = round(($yst_pwr_avg)/1000,2);
          $data['yst_bar'][] = round(($yst_pwr_avg)/1000,2);
      }

      // get time range
      $data['time']=Helper::getMinutesRange();

      // get power
      $powerTdy = Power::getPower($where[3],'date(time) = ?',\Carbon\Carbon::today()->toDateString());
      $data['power']['max']= round((collect($powerTdy)->max('power'))/1000,2);
      if (!empty($powerTdy)) {
        $data['power']['current'] = round(($powerTdy[0]->power)/1000,2);
      }else{
        $data['power']['current'] = round($powerTdy,2);
      }

      // get energy
      $etot['tdy']=Energy::getEnergy($where[3],'date(time) = ?',\Carbon\Carbon::today()->toDateString());
      $etot['yst']=Energy::getEnergy($where[3],'date(time) = ?',\Carbon\Carbon::yesterday()->toDateString());
      $etot['thsMonth']=$etot['tdy'];
      $etot['lstMonth']=Energy::getEnergy($where[3],'date(time) = ?',\Carbon\Carbon::now()->subMonth()->endOfMonth()->toDateString());

      // total energy today by subtract today and yesterday total energy
      if(($etot['tdy']-$etot['yst'])<0){
        $data['energy']['today']=0;
      }else{
        $data['energy']['today'] = $etot['tdy']-$etot['yst'];
      }
      if(( $etot['thsMonth']-$etot['lstMonth'])<0){
        $data['energy']['total']=0;
      }else{
      $data['energy']['total'] = $etot['thsMonth']-$etot['lstMonth'];
      }

      // get data for donut chart
      $floors=Floor::getFloor(['id_building'=>$input['building']]);
      ksort($floors);
      foreach ($floors as $id_floor => $floor_name) {
        $rooms = Room::getRooms($dt=['id_building'=>$input['building'],'id_floor'=>$id_floor]);
        $devices = Device::getDevices($rooms);
          $tmp['name']=$floor_name.' floor';
          $tmp['y']=(collect(\DB::table('get_energy')->select('energy')->whereIn('id_device',$devices)->whereRaw('month(time) = ?', [$thsmonth])->get())->sum('energy'))/1000;
          $data['donutData'][] = $tmp;
      }

      // get alert data
      $data['alert']=Alert::getAlert(['id_building'=>$input['building'],'id_floor'=>'main']);

      // get identity building
      $data['building']=Building::getBuilding(['id_building'=>$input['building']]);

      // return data
      if(!empty($input))
      {
        $return = $data;
      }else{
        $return = array(
        'error' => true, 'data' => $input);
      }
      return \Response::json($return);
    }

    public function building()
    {
      $input = \Request::all();
      $today = \Carbon\Carbon::today()->toDateString();
      $thsmonth = \Carbon\Carbon::now()->month;

      if($input['type']=='buildingpage')
      {
        // $room = \DB::table('data_room')->where(['id_building'=>$input['building']])->list('id_room');
        // $devices = \DB::table('data_device')->whereIn('id_room',$room)->lists('id_device');
        if(!empty($input))
        {
            $return = array(
              'data' => $input,
              );
        }else{
            $return = array(
            'error' => true);
        }
        return \Response::json($return);


      }else if($input['type']=='floorlist')
      {

        $room = \DB::table('data_room')->where(['id_building'=>$input['building'], 'id_floor'=>$input['floor']])->lists('id_room');

        if (!empty($room)) {
          $devices = \DB::table('data_device')->whereIn('id_room',$room)->lists('id_device');

          //query data for energy
          $data['energy']['total'] = round((collect(\DB::table('get_energy')->select('energy')->whereIn('id_device',$devices)->whereRaw('month(time) = ?', [$thsmonth])->get())->sum('energy'))/1000,2);
          $data['energy']['today'] = round((collect(\DB::table('get_energy')->select('energy')->whereIn('id_device',$devices)->whereRaw('date(time) = ?', [$today])->get())->sum('energy'))/1000,2);

          //query data for power
          $query_pwr = \DB::table('get_energy')->select('power')->whereIn('id_device',$devices)->whereRaw('date(time) = ?', [$today])->get();
          $i = count($query_pwr);
          // $query_pwr = \DB::table('get_energy')->select('power')->orderBy('time', 'desc')->whereRaw('date(time) = ?', [$today])->get();
          if($i != 0)
          {
            $p_now = round(($query_pwr[$i-1]->power)/1000,2);
            $p_max = round((collect($query_pwr)->max('power')/1000),2);

            $data['power']['current'] = $p_now;
            $data['power']['max'] = $p_max;

          }else {
            $data['power']['current'] = 0;
            $data['power']['max'] = 0;
          }

          $tdy = \Carbon\Carbon::now()->startOfDay();
          for ($i=0; $i < 96; $i++) {
            $data['powerChart'][] = (collect(\DB::table('get_energy')->select('power')->whereIn('id_device',$devices)->whereBetween('time', [$tdy->toDateTimeString(),$tdy->addMinutes(15)->toDateTimeString()])->get())->avg('power'))/1000;
          }

          $return = $data;
        }else{
          $return = array(
          'error' => true,
          'data' => null
          );
        }
        return \Response::json($return);

      }
    }

    public function floor()
    {
      $input = \Request::all();
      $time = \Carbon\Carbon::now();
      if($input['type']=='floorpage')
      {
        $rooms = \DB::table('data_room')->select('room_area','id_room')->where(['id_building'=>$input['building'], 'id_floor'=>$input['floor']])->get();
        if(!empty($rooms))
        {

          foreach ($rooms as $room) {

              $devices = \DB::table('data_device')->select('id_device','sensor_type')->where('id_room','=',$room->id_room)->get();
              foreach ($devices as $device) {
                  $query = \DB::table('get_energy')->select('energy')->where('id_device','=',$device->id_device)->whereRaw('month(time) = ?', [$time->month])->get();

                  $energy = round((collect($query)->sum('energy'))/1000,2);
                  $tmp_id[$device->sensor_type][] = $energy;
                  $tmp_id[$room->room_area][] = $energy;
                }

            }
            $devices = \DB::table('data_device')->select('id_device')->whereIn('id_room',collect($rooms)->lists('id_room'))->get();
            //call function for calculate power
            $data['powerChart'] = $this->calculatePower($devices,$input['time']);
            //call function for calculate enery
            $data['donutChart'] = $this->calculateEnergy($tmp_id);

          $return = $data;
        }else{
          $return = array(
          'error' => true);
        }
        return \Response::json($return);
      }
    }

    public function room()
    {
      $input = \Request::all();
      $today = \Carbon\Carbon::today()->toDateString();
      $thsmonth = \Carbon\Carbon::now()->month;
      if($input['type']=='roompage')
      {

        $devices = \DB::table('data_device')->select('id_device','sensor_type')->where('id_room',$input['room'])->get();

        if(!empty($devices))
        {
          foreach ($devices as $device) {

            $query= round((collect(\DB::table('get_energy')->select('energy')->where('id_device','=',$device->id_device)->whereRaw('month(time) = ?', [$thsmonth])->get())->sum('energy'))/1000,2);
            $tmp_id[$device->sensor_type][] = $query;
            $tmp_id['energy'][] = $query;

          }
          $data = $this->calculateEnergy($tmp_id);
          $data['powerChart'] = $this->calculatePower($devices,$input['time']);
          $data['energy']=array_sum($tmp_id['energy']);

          $return =$data;
        }else{
          $return = array(
          'error' => true);
        }
        return \Response::json($return);

      }else if($input['type']=='device') {
        //get data for device clicked in roompage
        $device_name = \DB::table('data_device')->select('sensor_name')->where('id_device','=',$input['id'])->first();


        if(!empty($device_name))
        {
          $query = \DB::table('get_energy')->select('time', 'power')->whereRaw('date(time) = :today and id_device = :id',['today'=>$today, 'id'=>$input['id']])->get();

          $tdy = \Carbon\Carbon::now()->startOfDay();
          for ($i=0; $i < 96; $i++) {
            $data['name']=$device_name->sensor_name;
            $tmp = (collect(\DB::table('get_energy')->select('power')->where('id_device',$input['id'])->whereBetween('time', [$tdy->toDateTimeString(),$tdy->addMinutes(15)->toDateTimeString()])->get())->avg('power'))/1000;
            if($tmp!=null){
              $data['data'][] = $tmp;
            }else{
              $data['data'][]= 0;
            }
          }
          // foreach ($query as $tmp) {
          //   $data['name']=$device_name->sensor_name;
          //   $data['data'][]=[(intval(date(strtotime($tmp->time)+ 7*60*60)))*1000,$tmp->power];
          // }
          $return = $data;
        }else{
          $return = array(
          'error' => true,
          'data' => null
          );
        }
        return \Response::json($return);

      }
    }

// API get data from sensor

    public function power()
    {
      $input = \Request::all();
      if(!empty($input))
      {
        $time = \Carbon\Carbon::now();
        $datetime = $time->toDateTimeString();
        $data = \DB::table('get_energy')->insert(array('id_device'=>$input['id'],'time'=>$datetime,'currentA'=>$input['cA'],'currentB'=>$input['cB'],'currentC'=>$input['cC'],'power'=>$input['pwr'],'energy'=>$input['energy'],'etotal'=>$input['total'],'thdA'=>$input['tcA'],'thdB'=>$input['tcB'],'thdC'=>$input['tcC'],'var'=>$input['rpw'],'pfA'=>$input['fA'],'pfB'=>$input['fB'],'pfC'=>$input['fC']));
        // $data = \DB::table('get_energy')->insert(array('id_device'=>$input['id'],'time'=>$datetime,'power'=>$input['pwr'],'energy'=>$input['energy'],'etotal'=>$input['total']));
        $return = array(
          'error' => false,
          'inserted_at' => $datetime,
          'data' => $input,
          'type' => 'power',
          'status_code' => 200);
      }else{
        $return = array(
        'error' => true);
      }
      return \Response::json($return);
    }

    public function sensor()
    {
      $input = \Request::all();
      if(!empty($input))
      {
        $time = \Carbon\Carbon::now();
        $datetime = $time->toDateTimeString();
        $return = array(
          'error' => false,
          'inserted_at' => $datetime,
          'data' => $input,
          'type' => 'sensor',
          'status_code' => 200);
      }else{
        $return = array(
        'error' => true);
      }
      return \Response::json($return);
    }
}
