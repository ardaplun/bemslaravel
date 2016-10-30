<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Floor extends Model
{
  static function getFloor($where=array()){
    $query = DB::table('data_floor');
    $query->where('deleted_at', NULL);
    $query->whereNotIn('id_floor', ['main']);
    foreach ($where as $key => $val) {
      if (!empty($val)) {
        $query->where($key, $val);
      }
    }
    return $query->lists('floor_name','id_floor');
  }

}
