<?php
namespace App\Helpers;

use Session;
use Sentinel;

class Helper
{
  static function getMinutesRange(){
    $tdy = \Carbon\Carbon::now()->startOfDay();
    for ($i=0; $i < 96; $i++) {
      $time[] = [$tdy->toDateTimeString(),$tdy->addMinutes(15)->toDateTimeString()];
    }
    return $time;
  }
}
?>
