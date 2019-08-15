<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;
use PDF;
use Illuminate\Filesystem\Filesystem;
use Carbon\Carbon;
use App\Calibration;
use LynX39\LaraPdfMerger\Facades\PdfMerger;

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
      $student->ou_color = $request->ou_color;
      $student->od_cyl = $request->od_cyl;
      $student->os_cyl = $request->os_cyl;
      $student->ou_dist = $request->ou_dist;
      $student->ou_near = $request->ou_near;
      $student->notes = $request->notes;
      $student->complete = 1;
      $student->grade = $request->grade;
      $student->nurse = $request->nurse;
      $student->r1k = $request->r1k;
      $student->r2k = $request->r2k;
      $student->r4k = $request->r4k;
      $student->r5k = $request->r5k;
      $student->l1k = $request->l1k;
      $student->l2k = $request->l2k;
      $student->l4k = $request->l4k;
      $student->l5k = $request->l5k;

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
      $student->ou_color = $request->ou_color;
      $student->od_cyl = $request->od_cyl;
      $student->os_cyl = $request->os_cyl;
      $student->ou_dist = $request->ou_dist;
      $student->ou_near = $request->ou_near;
      $student->notes = $request->notes;
      $student->complete = 1;
      $student->grade = $request->grade;
        $student->nurse = $request->nurse;
        $student->r1k = $request->r1k;
        $student->r2k = $request->r2k;
        $student->r4k = $request->r4k;
        $student->r5k = $request->r5k;
        $student->l1k = $request->l1k;
        $student->l2k = $request->l2k;
        $student->l4k = $request->l4k;
        $student->l5k = $request->l5k;

      $student->save();
      return back();

    }

    }


    public function autosave(Request $request){
      $student = Student::find($request->studentID);
      $student->od_dist = $request->ODdist;
      $student->os_dist = $request->OSdist;
      $student->ou_dist = $request->OUdist;
      $student->complete = 1;
      $student->save();

      $total = Student::whereDate('updated_at', Carbon::today())->count();

      return response()->json(['total'=>$total]);

    }

    public function autosave2(Request $request){
      $student = Student::find($request->studentID);
      $student->od_near = $request->ODnear;
      $student->os_near = $request->OSnear;
      $student->ou_near = $request->OUnear;
      $student->complete = 1;
      $student->save();


    }


    public function delete($id){
      $student = Student::find($id);
      $student->od_dist = "";
      $student->os_dist = "";
      $student->od_near = "";
      $student->os_near = "";
      $student->ou_color = "";

      $student->od_cyl = "";
      $student->os_cyl = "";
      $student->ou_dist = "";
      $student->ou_near = "";

      $student->complete = 0;
      $student->r1k = "";
      $student->r2k = "";
      $student->r4k = "";
      $student->r5k = "";
      $student->l1k = "";
      $student->l2k = "";
      $student->l4k = "";
      $student->l5k = "";
      $student->save();
      return back();
    }

    public function print($id){
       $student = Student::find($id);
       $pdf = PDF::loadView('printTables', compact('student'));
       return $pdf->stream('document.pdf');
     }

    public function batchPrint(){
      $pdfMerger = PDFMerger::init();
      $i = 0;

      $students = Student::whereDate('updated_at', Carbon::today())->get();
        foreach ($students as $student) {
          $pdf = PDF::loadView('printTables', compact('student'));
          $pdf->save('pdf/document'.$i.'.pdf');
          $pdfMerger->addPDF('pdf/document'.$i.'.pdf');
          $i++;
        }

      $pdfMerger->merge();
      $pdfMerger->save("file_name.pdf", "browser");

      $file = new Filesystem;
      $file->cleanDirectory('pdf');

    }

    public function adminBatchPrint(Request $request){


      $pdfMerger = PDFMerger::init();
      $i = 0;

      $students = Student::whereDate('updated_at', $request->date)->get();
      if($students->count() > 0){
        foreach ($students as $student) {
          $pdf = PDF::loadView('printTables', compact('student'));
          $pdf->save('pdf/document'.$i.'.pdf');
          $pdfMerger->addPDF('pdf/document'.$i.'.pdf');
          $i++;
        }
        $pdfMerger->merge();
        $pdfMerger->save("batch".$request->date.".pdf", "download");

        $file = new Filesystem;
        $file->cleanDirectory('pdf');


      } else {
        return back()->with('error','No students from that day!');
      }




    }


}
