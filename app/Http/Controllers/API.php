<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

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
           $data[] = collect(\DB::table('get_energy')->select('power')->whereIn('id_device',collect($devices)->lists('id_device'))->whereBetween('time', [$tdy->toDateTimeString(),$tdy->addMinutes(15)->toDateTimeString()])->get())->avg('power');
          //  $data['yesterday'][] = collect(\DB::table('get_energy')->select('power')->whereIn('id_device',collect($devices)->lists('id_device'))->whereBetween('time', [$yst->toDateTimeString(),$yst->addMinutes(15)->toDateTimeString()])->get())->avg('power');
         }
       }else if ($time=='month') {
          $day = \Carbon\Carbon::now();
          $count=$day->daysInMonth;
          $day->startOfMonth();
          for ($i=0; $i < $count; $i++) {

            $data[] = collect(\DB::table('get_energy')->select('power')->whereIn('id_device',collect($devices)->lists('id_device'))->whereRaw('date(time) = ?', [$day->toDateString()])->get())->avg('power');
            $day->addDay()->toDateString();

          }
       }else if ($time=='year') {
          $month = \Carbon\Carbon::now();
          $month->startOfYear();
          for ($i=0; $i < 12; $i++) {

            $data[$month->month] = collect(\DB::table('get_energy')->select('power')->whereIn('id_device',collect($devices)->lists('id_device'))->whereRaw('month(time) = ?', [$month->month])->get())->avg('power');
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
         $data['donutLoad'][]=array_add(['name'=>'Light<br>'.$sum.' kWh'],'y',$sum);
       }
       if(isset($tmp['AC'])){
         $sum=array_sum($tmp['AC']);
         $data['donutLoad'][]=array_add(['name'=>'AC<br>'.$sum.' kWh'],'y',$sum);
       }
       if(isset($tmp['outlet'])){
         $sum=array_sum($tmp['outlet']);
         $data['donutLoad'][]=array_add(['name'=>'Outlet<br>'.$sum.' kWh'],'y',$sum);
       }

       //calculate area energy
       if(isset($tmp['north'])){
         $sum=array_sum($tmp['north']);
         $data['donutArea'][]=array_add(['name'=>'North<br>'.$sum.' kWh'],'y',$sum);
       }
       if(isset($tmp['south'])){
         $sum=array_sum($tmp['south']);
         $data['donutArea'][]=array_add(['name'=>'South<br>'.$sum.' kWh'],'y',$sum);
       }
       return $data;
     }





// API get data for webapp

    public function home()
    {
      $input = \Request::all();
      $today = \Carbon\Carbon::today()->toDateString();
      $thsmonth = \Carbon\Carbon::now()->month;
      //query data for power
      $query_pwr = \DB::table('get_energy')->select('power')->whereRaw('date(time) = ?', [$today])->get();
      $i = count($query_pwr);
      // $query_pwr = \DB::table('get_energy')->select('power')->orderBy('time', 'desc')->whereRaw('date(time) = ?', [$today])->get();
      if($i != 0)
      {
        $data['power']['current'] = $query_pwr[$i-1]->power;
        $data['power']['max'] = collect($query_pwr)->max('power');
      }else {
        $data['power']['current'] = 0;
        $data['power']['max'] = 0;
      }
      $tdy = \Carbon\Carbon::now()->startOfDay();
      $yst = \Carbon\Carbon::now()->startOfDay()->subDay();
      for ($i=0; $i < 96; $i++) {
        $data['today'][] = collect(\DB::table('get_energy')->select('power')->whereBetween('time', [$tdy->toDateTimeString(),$tdy->addMinutes(15)->toDateTimeString()])->get())->avg('power');
        $data['yesterday'][] = collect(\DB::table('get_energy')->select('power')->whereBetween('time', [$yst->toDateTimeString(),$yst->addMinutes(15)->toDateTimeString()])->get())->avg('power');
      }
      //query data for energy
      $data['energy']['total'] = collect(\DB::table('get_energy')->select('energy')->whereRaw('month(time) = ?', [$thsmonth])->get())->sum('energy');
      $data['energy']['today'] = collect(\DB::table('get_energy')->select('energy')->whereRaw('date(time) = ?', [$today])->get())->sum('energy');



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
          $data['energy']['total'] = collect(\DB::table('get_energy')->select('energy')->whereIn('id_device',$devices)->whereRaw('month(time) = ?', [$thsmonth])->get())->sum('energy');
          $data['energy']['today'] = collect(\DB::table('get_energy')->select('energy')->whereIn('id_device',$devices)->whereRaw('date(time) = ?', [$today])->get())->sum('energy');

          //query data for power
          $query_pwr = \DB::table('get_energy')->select('power')->whereIn('id_device',$devices)->whereRaw('date(time) = ?', [$today])->get();
          $i = count($query_pwr);
          // $query_pwr = \DB::table('get_energy')->select('power')->orderBy('time', 'desc')->whereRaw('date(time) = ?', [$today])->get();
          if($i != 0)
          {
            $p_now = $query_pwr[$i-1]->power;
            $p_max = collect($query_pwr)->max('power');

            $data['power']['current'] = $p_now;
            $data['power']['max'] = $p_max;

          }else {
            $data['power']['current'] = 0;
            $data['power']['max'] = 0;
          }

          $tdy = \Carbon\Carbon::now()->startOfDay();
          for ($i=0; $i < 96; $i++) {
            $data['powerChart'][] = collect(\DB::table('get_energy')->select('power')->whereIn('id_device',$devices)->whereBetween('time', [$tdy->toDateTimeString(),$tdy->addMinutes(15)->toDateTimeString()])->get())->avg('power');
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

                  $energy = collect($query)->sum('energy');
                  $tmp_id[$device->sensor_type][] = $energy;
                  $tmp_id[$room->room_area][] = $energy;
                }

            }
            $devices = \DB::table('data_device')->select('id_device')->whereIn('id_room',collect($rooms)->lists('id_room'))->get();
            //call function for calculate power
            $data['powerChart'] = $this->calculatePower($devices,$input['time']);
            //call function for calculate enery
            $data['donutChart'] = $this->calculateEnergy($tmp_id);

          //data for donut chart load and by device type
          // if(isset($tmp_id['north'])){
          //   $sum=array_sum($tmp_id['north']);
          //   $data['donutArea'][]=array_add(['name'=>'North<br>'.$sum.' kWh'],'y',$sum);
          // }
          // if(isset($tmp_id['south'])){
          //   $sum=array_sum($tmp_id['south']);
          //   $data['donutArea'][]=array_add(['name'=>'South<br>'.$sum.' kWh'],'y',$sum);
          // }
          // if(isset($tmp_id['light'])){
          //   $sum=array_sum($tmp_id['light']);
          //   $data['donutLoad'][]=array_add(['name'=>'Light<br>'.$sum.' kWh'],'y',$sum);
          // }
          // if(isset($tmp_id['AC'])){
          //   $sum=array_sum($tmp_id['AC']);
          //   $data['donutLoad'][]=array_add(['name'=>'AC<br>'.$sum.' kWh'],'y',$sum);
          // }
          // if(isset($tmp_id['outlet'])){
          //   $sum=array_sum($tmp_id['outlet']);
          //   $data['donutLoad'][]=array_add(['name'=>'Outlet<br>'.$sum.' kWh'],'y',$sum);
          // }
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

            $query= collect(\DB::table('get_energy')->select('energy')->where('id_device','=',$device->id_device)->whereRaw('month(time) = ?', [$thsmonth])->get())->sum('energy');
            $tmp_id[$device->sensor_type][] = $query;
            $tmp_id['energy'][] = $query;

          }
          $data['powerChart'] = $this->calculatePower($devices,$input['time']);
          if(isset($tmp_id['light'])){
            $sum=array_sum($tmp_id['light']);
            $data['donutLoad'][]=array_add(['name'=>'Light<br>'.$sum.' kWh'],'y',$sum);
          }
          if(isset($tmp_id['AC'])){
            $sum=array_sum($tmp_id['AC']);
            $data['donutLoad'][]=array_add(['name'=>'AC<br>'.$sum.' kWh'],'y',$sum);
          }
          if(isset($tmp_id['outlet'])){
            $sum=array_sum($tmp_id['outlet']);
            $data['donutLoad'][]=array_add(['name'=>'Outlet<br>'.$sum.' kWh'],'y',$sum);
          }
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

          foreach ($query as $tmp) {
            $data['name']=$device_name->sensor_name;
            $data['data'][]=[(intval(date(strtotime($tmp->time)+ 7*60*60)))*1000,$tmp->power];
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

// API get data from sensor

    public function power()
    {
      $input = \Request::all();
      if(!empty($input))
      {
        $time = \Carbon\Carbon::now();
        $datetime = $time->toDateTimeString();
        $data = \DB::table('get_energy')->insert(array('id_device'=>$input['id'],'time'=>$datetime,'power'=>$input['pwr'],'energy'=>$input['energy']));
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
