<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB, Carbon;

class Energy extends Model
{
  static function getEnergy($where=array(),$time,$range){
    $query = DB::table('view_etotal_mdp')->select('etotal');
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

  static function getEnergies($where=array(),$time,$range){
    $query = DB::table('view_etotal_mdp')->select('etotal');
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

  static function getEnergyRange($where=array(),$start,$stop){
    $query = DB::table('view_energy_mdp')->select('energy')->whereBetween('time', [$start,$stop]);
    foreach ($where as $key => $val) {
      if (!empty($val)) {
        $query->where($key, $val);
      }
    }
    $dt=collect($query->get())->sum('energy');
    if(!empty($dt)){
      return $dt;
    }else{
      return 0;
    }
  }

//   static function getData($where=array(),$time,$range){
//     $query = DB::table('get_energy')->select('time','power','etotal')->orderBy('time', 'desc');
//     foreach ($where as $key => $val) {
//       if (!empty($val)) {
//         $query->where($key, $val);
//       }
//     }
//     $query->whereRaw($time, [$range]);
//     return $query->get();
//   }
//
//   static function getEnergyInMont($where=array()){
// //still not in use, for main type in every floor
//     $lstMonth =Carbon\Carbon::now()->month;
//     $query = DB::table('get_energy')->select('etotal')->orderBy('time', 'desc');
//     foreach ($where as $key => $val) {
//       if (!empty($val)) {
//         $query->where($key, $val);
//       }
//     }
//     $query->whereRaw('month(time) = ?', [$lstMonth]);
//     return round(($query->first()->etotal)/1000,2);
//   }
}
