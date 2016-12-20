<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB, Carbon;

class Power extends Model
{
  static function getPowerToday($where=array()){
    $tdy = \Carbon\Carbon::now()->toDateString();
    $query = DB::table('get_energy')->select('power')->orderBy('time', 'desc');
    foreach ($where as $key => $val) {
      if (!empty($val)) {
        $query->where($key, $val);
      }
    }
    $query->whereRaw('date(time) = ?', [$tdy]);
    return $query->get();
  }
  static function getPower($where=array(),$time,$range){
    $query = DB::table('view_power_mdp')->select('power');
    foreach ($where as $key => $val) {
      if (!empty($val)) {
        $query->where($key, $val);
      }
    }
    $query->whereRaw($time, [$range]);
    $dt=$query->get();
    if(!empty($dt)){
      return $dt;
    }else{
      return 0;
    }
  }
  static function getPowerCurrent($where=array(),$time,$range){
    $query = DB::table('view_power_mdp');
    foreach ($where as $key => $val) {
      if (!empty($val)) {
        $query->where($key, $val);
      }
    }
    $query->whereRaw($time, [$range]);
    $dt=$query->value('power');
    if(!empty($dt)){
      return $dt;
    }else{
      return 0;
    }
  }
  static function getPowerMax($where=array(),$time,$range){
    $query = DB::table('view_power_mdp');
    foreach ($where as $key => $val) {
      if (!empty($val)) {
        $query->where($key, $val);
      }
    }
    $query->whereRaw($time, [$range])->max('power');
    $dt=$query->value('power');
    if(!empty($dt)){
      return $dt;
    }else{
      return 0;
    }
  }
  static function getPowerAvg($where=array(),$start,$stop){
    $query = DB::table('view_power_mdp')->select('power')->whereBetween('time', [$start,$stop]);
    foreach ($where as $key => $val) {
      if (!empty($val)) {
        $query->where($key, $val);
      }
    }
    // $query->whereRaw('date(time) = ?', [$tdy]);
    $dt=collect($query->get())->avg('power');
    if(!empty($dt)){
      return $dt;
    }else{
      return 0;
    }
  }
}
