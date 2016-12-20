<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Alert extends Model
{
  static function getAlert($where=array()){
    $query = DB::table('data_alert')->select('warning_level','alert_level','kwh_target');
    $query->where('deleted_at', NULL);
    foreach ($where as $key => $val) {
      if (!empty($val)) {
        $query->where($key, $val);
      }
    }
    return $query->first();
  }

}
