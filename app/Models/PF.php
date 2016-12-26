<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB, Carbon;

class PF extends Model
{

  static function getPF($where=array(),$time,$range){
    $query = DB::table('view_pf_mdp')->select('pfA','pfB','pfC');
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
