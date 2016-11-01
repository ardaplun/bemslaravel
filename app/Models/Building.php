<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
class Building extends Model
{
  static function getBuildings($where=array()){
    $query = DB::table('data_building')->select('id_building','building_name');
    $query->where('deleted_at', NULL);
    foreach ($where as $key => $val) {
      if (!empty($val)) {
        $query->where($key, $val);
      }
    }
    return $query->get();
  }

  static function getBuilding($where=array()){
    $query = DB::table('data_building')->select('id_building','building_name','faculty_name');
    $query->where('deleted_at', NULL);
    foreach ($where as $key => $val) {
      if (!empty($val)) {
        $query->where($key, $val);
      }
    }
    return $query->first();
  }
}
