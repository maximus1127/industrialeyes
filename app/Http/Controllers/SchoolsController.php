<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;
use Carbon\Carbon;
class SchoolsController extends Controller
{

  public function search(Request $request){
    $output = '';

    $students = Student::where('district', 'like', $request->get('district'))->get();
    $schools = $students->unique('school');

    foreach($schools as $school){
      $output .= '<option value="'.$school->school.'">'.$school->school.'</option>';
    }


    $data = array( 'school_data' => $output);
    return json_encode($data);

  }


  public function searchStudents(Request $request){
    $output = '';
    $d = $request->get('district');
    $s = $request->get('school');

    $students = Student::where('district', '=', $d)->where('school', '=', $s)->get();



    foreach($students as $student){
      $output .= '<li class="student_list" data-fname = "'.$student->fname.'" data-lname = "'.$student->lname.'" data-identify = "'.$student->id.'"
      data-dob = "'.Carbon::parse($student->dob)->format('m/d/Y').'" data-gender = "'.$student->gender.'" data-number = "'.$student->student_number.'"
      data-school = "'.$student->school.'" data-teacher = "'.$student->teacher.'" data-district = "'.$student->district.'"
      data-oddist = "'.$student->od_dist.'"
       data-odnear = "'.$student->od_near.'"
        data-osdist = "'.$student->os_dist.'"
         data-osnear = "'.$student->os_near.'"
          data-odcyl = "'.$student->od_cyl.'"
           data-oscyl = "'.$student->os_cyl.'"
            data-odcolor = "'.$student->od_color.'"
             data-oscolor = "'.$student->os_color.'"
              data-oudist = "'.$student->ou_dist.'"
               data-ounear = "'.$student->ou_near.'"
               data-notes = "'.$student->notes.'"
               data-nurse = "'.$student->nurse.'"
               data-r1k = "'.$student->r1k.'"
               data-r2k = "'.$student->r2k.'"
               data-r4k = "'.$student->r4k.'"
               data-r5k = "'.$student->r5k.'"
               data-l1k = "'.$student->l1k.'"
               data-l2k = "'.$student->l2k.'"
               data-l4k = "'.$student->l4k.'"
               data-l5k = "'.$student->l5k.'"

      onclick="loadStudent(this)">
        '.$student->fname." ".$student->lname.'
      </li>';
    }


    $data = array( 'student_data' => $output);
    return json_encode($data);

  }



}
