<?php

use App\Models as Md;

class ScheduleHelp {

    public static function processAtShift($shiftCode) {
      $findShift = Md\Shift::find($shiftCode);
      $timeSend  = (new \DateTime($findShift->shift_to))->modify("+1 hours")->format('H:i');
    	return $timeSend;
    }

}
