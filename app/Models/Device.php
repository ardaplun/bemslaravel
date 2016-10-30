<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Device extends Model
{
  static function getDevice($where=array()){
    $query = DB::table('data_device');
    $query->where('deleted_at', NULL);
    foreach ($where as $key => $val) {
      if (!empty($val)) {
        $query->where($key, $val);
      }
    }
    return $query->lists('id_device');
  }

  static function getDevices($dt){
    $query = DB::table('data_device')->whereIn('id_room',$dt);
    return $query->lists('id_device');
  }
}
