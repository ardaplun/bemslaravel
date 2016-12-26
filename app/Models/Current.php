<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB, Carbon;

class Current extends Model
{

  static function getCurrent($where=array(),$time,$range){
    $query = DB::table('view_current_mdp')->select('currentA','currentB','currentC');
    foreach ($where as $key => $val) {
      if (!empty($val)) {
        $query->where($key, $val);
      }
    }
    $query->whereRaw($time, [$range]);
    $dt=$query->first();
    if(!empty($dt)){
      return $dt;
    }else{
      return 0;
    }
  }

}
