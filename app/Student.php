<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    public static function insertData($data)
    {
        DB::table('students')->insert($data);
    }

    public $timestamps = false;


    public function passOrFail($student){
      $score = array('20/40', '20/50', '20/60', '20/70', '20/80', '20/100', '20/200', '20/400');
      $score2 = array('20/50', '20/60', '20/70', '20/80', '20/100', '20/200', '20/400');
      $grade = array('1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12');
      $grade2 = array('-1', '0', 'tk', 'k', 'TK', 'K', 'Tk', null, 'kn', 'KN');



          if(in_array($student->grade, $grade)){
            if(in_array($student->od_dist, $score) || in_array($student->os_dist, $score) || in_array($student->ou_dist, $score) ||  in_array($student->ou_near, $score)){
              return "Fail";
            } else {
              return "Pass";
            }
          }
            elseif(in_array($student->grade, $grade2)){
              if(in_array($student->od_dist, $score2) || in_array($student->os_dist, $score2) || in_array($student->ou_dist, $score2)  || in_array($student->ou_near, $score2)){
              return "Fail";
            } else{
              return "Pass";
            }
          } elseif (!$student->od_dist && !$student->os_dist && !$student->ou_dist){
            return NULL;
          }

    }



    public function hearingPassOrFail($student){
      $grade = array('40', '45', '50', '55', '60', '65', '70', '75', '80', '85', '90', '95', 'NR');

        $scores = array('r1k' => strval($student->r1k), 'r2k' => strval($student->r2k), 'r4k' => strval($student->r4k), 'r5k' => strval($student->r5k), 'l1k' => strval($student->l1k), 'l2k' => strval($student->l2k), 'l4k' => strval($student->l4k), 'l5k' => strval($student->l5k));
        $filter = array_count_values($scores);
        if(in_array($student->r1k, $grade) || in_array($student->r2k, $grade) || in_array($student->r4k, $grade) || in_array($student->r5k, $grade) || in_array($student->l1k, $grade) || in_array($student->l2k, $grade) || in_array($student->l4k, $grade) || in_array($student->l5k, $grade)){
          return "Fail";
        }
        if(array_key_exists("30", $filter) && $filter['30'] > 1){
          return "Fail";
        }
        if ($scores['r1k'] == null && $scores['r2k'] == null && $scores['r4k'] == null && $scores['r5k'] == null && $scores['l1k'] == null && $scores['l2k'] == null && $scores['l4k'] == null && $scores['l5k'] == null){
          return NULL;
        } else {
          return "Pass";
        }


    }






}
