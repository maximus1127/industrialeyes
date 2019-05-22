<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;
use Carbon\Carbon;

class LiveSearch extends Controller
{
  function action(Request $request)
    {
        if($request->ajax())
        {
            $output = '';
              $output2 = '';
            $query = $request->get('query');
            if($query != '')
                {
                    $data = Student::where('district', 'like', '%'.$query.'%')
                                                        ->orWhere('lname', 'like', '%'.$query.'%')
                                                        ->orWhere('fname', 'like', '%'.$query.'%')
                                                        ->orWhere('school', 'like', '%'.$query.'%')
                                                        ->orWhere('teacher', 'like', '%'.$query.'%')
                                                        ->orWhere('student_number', 'like', '%'.$query.'%')
                                                        ->get();
                                                        }
                                                        else
                                                            {
                                                                $data = "Please enter a search";
                                                                                                }
                      $total_row = $data->count();
                      if($total_row > 0)
                        {
                            foreach($data as $student)
                                {
                                  if($student->complete == 0 || $student->complete == 1){
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

                                    onclick="loadStudent(this)">
                                      '.$student->fname." ".$student->lname.'
                                    </li>';
                                  }elseif ($student->complete == 1) {
                                    $output2 .='<li class="student_list" data-fname = "'.$student->fname.'" data-lname = "'.$student->lname.'" data-identify = "'.$student->id.'"
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


                                    onclick="loadStudent(this)">
                                      '.$student->fname." ".$student->lname.'
                                    </li>';
                                  }
                                    }
                                }
                        else
                            {
                                $output = 'No Data Found';
                                 }
                        $data = array( 'table_data' => $output, 'table_data2' => $output2);
                        echo json_encode($data);
                                }
                            }
}
