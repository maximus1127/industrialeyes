<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;
use PDF;
use App\Calibration;

class ChartController extends Controller
{


  public function index(){
    return view('chartHome');
  }



    public function findStudents(Request $request){
      $district = $request->district;
      $school = $request->school;
      $teacher = $request->teacher;
      $name = $request->student;




      $students = Student::where('district', 'like', '%' . $request->district . '%')
                            ->orWhere('school', 'like', '%'.$request->district.'%')
                            ->orWhere('teacher', 'like', '%'.$request->district.'%')
                            ->orWhere('fname', 'like', '%'.$request->district.'%')
                            ->orWhere('lname', 'like', '%'.$request->district.'%')
                            ->orWhere('student_number', 'like', '%'.$request->district.'%')
                            ->get();

      return view('chartHome')->with(compact('students'));

    }



    public function exam(){
      $calibration = Calibration::find(1) ;
      return view('distanceChart')->with(compact('calibration'));
    }
    public function exam2(){
      $calibration = Calibration::find(1) ;
      return view('nearChart')->with(compact('calibration'));
    }
    public function exam3(){
      return view('colorChart');
    }
    public function exam4(){
            $calibration = Calibration::find(1) ;
      return view('sixChart')->with(compact('calibration'));
    }
    public function exam5(){
            $calibration = Calibration::find(1) ;
      return view('hotvChart')->with(compact('calibration'));
    }
    public function submit(Request $request){


      $student = Student::find($request->student_id);
      if($student){
      $student->fname = $request->fname;
      $student->lname = $request->lname;
      $student->dob = $request->dob;
      $student->student_number = $request->number;
      $student->school = $request->school;
      $student->district = $request->district;
      $student->teacher = $request->teacher;
      $student->student_number = $request->number;
      $student->gender = $request->gender;
      $student->od_dist = $request->od_dist;
      $student->os_dist = $request->os_dist;
      $student->od_near = $request->od_near;
      $student->os_near = $request->os_near;
      $student->od_color = $request->od_color;
      $student->os_color = $request->os_color;
      $student->od_cyl = $request->od_cyl;
      $student->os_cyl = $request->os_cyl;
      $student->ou_dist = $request->ou_dist;
      $student->ou_near = $request->ou_near;
      $student->notes = $request->notes;
      $student->complete = 1;
      $student->nurse = $request->nurse;
      $student->r_ear = $request->r_ear;
      $student->l_ear = $request->l_ear;
      $student->save();
      return back();
    } else{
      $student = new Student();
      $student->fname = $request->fname;
      $student->lname = $request->lname;
      $student->dob = $request->dob;
      $student->student_number = $request->number;
      $student->school = $request->school;
      $student->district = $request->district;
      $student->teacher = $request->teacher;
      $student->student_number = $request->number;
      $student->gender = $request->gender;
      $student->od_dist = $request->od_dist;
      $student->os_dist = $request->os_dist;
      $student->od_near = $request->od_near;
      $student->os_near = $request->os_near;
      $student->od_color = $request->od_color;
      $student->os_color = $request->os_color;
      $student->od_cyl = $request->od_cyl;
      $student->os_cyl = $request->os_cyl;
      $student->ou_dist = $request->ou_dist;
      $student->ou_near = $request->ou_near;
      $student->notes = $request->notes;
      $student->complete = 1;
        $student->nurse = $request->nurse;
        $student->r_ear = $request->r_ear;
        $student->l_ear = $request->l_ear;
      $student->save();
      return back();

    }

    }


    public function delete($id){
      $student = Student::find($id);
      $student->od_dist = "";
      $student->os_dist = "";
      $student->od_near = "";
      $student->os_near = "";
      $student->od_color = "";
      $student->os_color = "";
      $student->od_cyl = "";
      $student->os_cyl = "";
      $student->ou_dist = "";
      $student->ou_near = "";
      $student->r_ear = "";
      $student->l_ear = "";
      $student->complete = 0;
      $student->save();
      return back();
    }

    public function print($id){

      $student = Student::find($id);
      $pdf = PDF::loadView('printTables', compact('student'));
      return $pdf->stream('document.pdf');
      // return view('printExam')->with(compact('student'));
    }


}
