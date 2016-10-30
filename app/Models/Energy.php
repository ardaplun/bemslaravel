<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB, Carbon;

class Energy extends Model
{
  static function getEnergy($where=array(),$time,$range){
    $query = DB::table('get_energy')->select('etotal')->orderBy('time', 'desc');
    foreach ($where as $key => $val) {
      if (!empty($val)) {
        $query->where($key, $val);
      }
    }
    $query->whereRaw($time, [$range]);
    $dt=$query->first();
    if(!empty($dt)){
      return round(($dt->etotal)/1000,2);
    }else{
      return 0;
    }
  }
  // static function getEnergyToday($where=array()){
  //   $tdy = \Carbon\Carbon::now()->toDateString();
  //   $query = DB::table('get_energy')->select('etotal')->orderBy('time', 'desc');
  //   foreach ($where as $key => $val) {
  //     if (!empty($val)) {
  //       $query->where($key, $val);
  //     }
  //   }
  //   $query->whereRaw('date(time) = ?', [$tdy]);
  //   return round(($query->first()->etotal)/1000,2);
  // }
  // static function getEnergyYesterday($where=array()){
  //   $yst = \Carbon\Carbon::now()->subDay()->toDateString();
  //   $query = DB::table('get_energy')->select('etotal')->orderBy('time', 'desc');
  //   foreach ($where as $key => $val) {
  //     if (!empty($val)) {
  //       $query->where($key, $val);
  //     }
  //   }
  //   $query->whereRaw('date(time) = ?', [$yst]);
  //   return round(($query->first()->etotal)/1000,2);
  // }

  // static function getEnergyThsMonth($where=array()){
  //   $thsMonth =Carbon\Carbon::now()->month;
  //   $query = DB::table('get_energy')->select('etotal')->orderBy('time', 'desc');;
  //   foreach ($where as $key => $val) {
  //     if (!empty($val)) {
  //       $query->where($key, $val);
  //     }
  //   }
  //   $query->whereRaw('month(time) = ?', [$thsMonth]);
  //   return round(($query->first()->etotal)/1000,2);
  // }
  //
  // static function getEnergyLstMont($where=array()){
  //   $lstMonth =Carbon\Carbon::now()->subMonth()->month;
  //   $query = DB::table('get_energy')->select('etotal')->orderBy('time', 'desc');
  //   foreach ($where as $key => $val) {
  //     if (!empty($val)) {
  //       $query->where($key, $val);
  //     }
  //   }
  //   $query->whereRaw('month(time) = ?', [$lstMonth]);
  //   return round(($query->first()->etotal)/1000,2);
  // }

  static function getEnergyInMont($where=array()){
//still not in use, for main type in every floor
    $lstMonth =Carbon\Carbon::now()->month;
    $query = DB::table('get_energy')->select('etotal')->orderBy('time', 'desc');
    foreach ($where as $key => $val) {
      if (!empty($val)) {
        $query->where($key, $val);
      }
    }
    $query->whereRaw('month(time) = ?', [$lstMonth]);
    return round(($query->first()->etotal)/1000,2);
  }
}
