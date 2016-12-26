<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB, Carbon;

class THD extends Model
{

  static function getTHD($where=array(),$time,$range){
    $query = DB::table('view_thd_mdp')->select('thdA','thdB','thdC');
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
