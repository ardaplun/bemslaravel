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
        $p_now = $query_pwr[$i-1]->power;
        $p_max = collect($query_pwr)->max('power');

        $data['p_current'] = $p_now;
        $data['p_max'] = $p_max;
      }else {
        $data['p_current'] = 0;
        $data['p_max'] = 0;
      }

      //query data for energy
      $data['e_total'] = collect(\DB::table('get_energy')->select('energy')->whereRaw('month(time) = ?', [$thsmonth])->get())->sum('energy');
      $data['e_today'] = collect(\DB::table('get_energy')->select('energy')->whereRaw('date(time) = ?', [$today])->get())->sum('energy');



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
      // $query = \DB::table('data_room')->where(['id_building'=>$input['building']])->select('id_room')->get();
      // $query = \DB::table('data_device')->get();
      // $data = \DB::table('data_device')->select('data_device.id_device')->leftJoin('data_room', 'data_room.id_floor', '=', 'data_device.id_floor')->get();

      // $data['energy'] = \DB::table('get_energy')->sum('energy');
      // $data['power'] = \DB::table('get_energy')->sum('pwr');
      if(!empty($input))
      {
        $return = array(
          'error' => false,
          'data' => $input,
          'type' => $input['building'],
          'status_code' => 200);
      }else{
        $return = array(
        'error' => true);
      }
      return \Response::json($return);
    }

    public function floor()
    {
      $input = \Request::all();
      if(!empty($input))
      {
        $return = array(
          'error' => false,
          'data' => $input,
          'type' => 'floor',
          'status_code' => 200);
      }else{
        $return = array(
        'error' => true);
      }
      return \Response::json($return);
    }

    public function room()
    {
      $input = \Request::all();
      $query = \DB::table('data_device')
            ->join('data_room', 'users.id', '=', 'contacts.user_id')
            ->join('orders', 'users.id', '=', 'orders.user_id')
            ->select('users.id', 'contacts.phone', 'orders.price')
            ->get();
      $data['energy'] = \DB::table('get_energy')->sum('energy');
      $data['power'] = \DB::table('get_energy')->sum('pwr');
      if(!empty($input))
      {
        $return = array(
          'error' => false,
          'data' => $data,
          'type' => $input['room'],
          'status_code' => 200);
      }else{
        $return = array(
        'error' => true);
      }
      return \Response::json($return);
    }

    public function device()
    {
      $input = \Request::all();
      $today = \Carbon\Carbon::today()->toDateString();
      $thsmonth = \Carbon\Carbon::now()->month;

      //query data for power
      $device_name = \DB::table('data_device')->select('sensor_name')->where('id_device','=',$input['id'])->first();
      $query = \DB::table('get_energy')->select('time', 'power')->whereRaw('date(time) = :today and id_device = :id',['today'=>$today, 'id'=>$input['id']])->get();

      foreach ($query as $tmp) {
        $data['name']=$device_name->sensor_name;
        $data['data'][]=[(intval(date(strtotime($tmp->time)+ 7*60*60)))*1000,$tmp->power];        
      }

      if(!empty($input))
      {
        // $return = array(
        //   'error' => false,
        //   'data' => $data,
        //   'type' => $input,
        //   'status_code' => 200);
        $return = $data;
      }else{
        $return = array(
        'error' => true);
      }
      return \Response::json($return);
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
        // $data = \DB::table('get_sensor')->insert(array('id_device'=>$input['id'],'time'=>$datetime,'r_pwr'=>$input['pwr'],'r_energy_tdy'=>$input['e_tdy'],'r_energy_week'=>$input['e_week'],'r_energy_tot'=>$input['e_tot']));
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
