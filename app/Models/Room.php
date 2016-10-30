<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Room extends Model
{
  static function getRooms($where=array()){
    $query = DB::table('data_room');
    $query->where('deleted_at', NULL);
    foreach ($where as $key => $val) {
      if (!empty($val)) {
        $query->where($key, $val);
      }
    }
    return $query->lists('id_room');
  }
  static function getMDP($where=array()){
    $query = DB::table('data_room');
    $query->where('deleted_at', NULL);
    foreach ($where as $key => $val) {
      if (!empty($val)) {
        $query->where($key, $val);
      }
    }
    return $query->lists('id_room');
  }
}
