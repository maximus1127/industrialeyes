<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Calibration;

class CalibrationController extends Controller
{
  public function insert(Request $request){
$calibration = Calibration::find(1);
$calibration->size = $request->size;
$calibration->save();
}

}
