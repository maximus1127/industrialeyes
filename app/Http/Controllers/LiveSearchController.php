<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;

class LiveSearchController extends Controller
{
  function action(Request $request)
    {
        if($request->ajax())
        {
            $output = '';
            $query = $request->get('query');
            if($query != '')
                {
                    $data = Student::where('district', 'like', '%'.$query.'%')
                                                        ->orWhere('lname', 'like', '%'.$query.'%')
                                                        ->orWhere('school', 'like', '%'.$query.'%')
                                                        ->orWhere('teacher', 'like', '%'.$query.'%')
                                                        ->orWhere('student_number', 'like', '%'.$query.'%')
                                                        ->get();
                                                        }
                                                        else
                                                            {
                                                                $data = Student::all();
                                                                                                }
                      // $total_row = $data->count();
                      if($total_row > 0)
                        {
                            foreach($data as $row)
                                {
                                    $output .= '<li class="student_list" data-fname = "'.$student->fname.'" data-lname = "'.$student->lname.'" data-identify = "'.$student->id.'"
                                    data-dob = "'.$student->dob.'" data-gender = "'.$student->gender.'" data-number = "'.$student->student_number.'"
                                    data-school = "'.$student->school.'" data-teacher = "'.$student->teacher.'" data-district = "'.$student->district.'" onclick="loadStudent(this)">
                                      {{$student->fname.' '.$student->lname}}
                                    </li>'
                                    }
                                }
                        else
                            {
                                $output = 'No Data Found';
                                 }
                        $data = array( 'table_data' => $output);
                        echo json_encode($data);
                                }
                            }
}
