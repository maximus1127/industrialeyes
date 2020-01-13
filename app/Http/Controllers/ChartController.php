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


    public function hearingIndex($district, $school){

      $students = Student::where('district', $district)->
                            where('school', $school)
                            ->get();

      $completed_students = Student::where('district', $district)->
                            where('school', $school)->
                            where('hearing_complete', '1')
                            ->count();

      return view('hearingExam')->with(compact('students', 'completed_students'));
    }

    public function submitHearingExam(Request $request){
      $r1k = request('r1k');
      $r2k = request('r2k');
      $r4k = request('r4k');
      $r5k = request('r5k');
      $l1k = request('l1k');
      $l2k = request('l2k');
      $l4k = request('l4k');
      $l5k = request('l5k');
      $id = request('studentID');


        for($i = 0 ; $i < count($id) ; $i++)
         {
           if($id[$i] != ""){
           $student = Student::find($id[$i]);
           $student->r1k = $r1k[$i];
           $student->r2k = $r2k[$i];
           $student->r4k = $r4k[$i];
           if(!$r5k[$i]){
             continue;
           } else {
             $student->r5k = $r5k[$i];
           }
           $student->l1k = $l1k[$i];
           $student->l2k = $l2k[$i];
           $student->l4k = $l4k[$i];
           if(!$l5k[$i]){
             continue;
           } else {
             $student->l5k = $l5k[$i];
           }
           $student->last_edited = now();
           $student->hearing_complete = "1";
           $student->hearing_pass = $student->hearingPassOrFail($student);
           $student->save();
         } else {
           continue;
         }
         }
         return back();

    }


    public function exam1($id){
      $calibration = Calibration::find(1) ;
      $student = Student::find($id);
      return view('revised-exams/bilat-color')->with(compact('calibration', 'student'));
    }
    public function saveExam1(Request $request){
    $student = Student::find($request->studentid);
    $student->od_dist = $request->oddist;
    $student->os_dist = $request->osdist;
    $student->notes = $request->notes;
    $student->ou_near = $request->ounear;
    $student->ou_dist = $request->oudist;
    $student->ou_color = $request->color;
    if($student->save()){
      return response('saved');
    }
  }

    public function exam2($id){
      $calibration = Calibration::find(1) ;
      $student = Student::find($id);
      return view('revised-exams/non-bilat-color')->with(compact('calibration','student'));
    }
    public function saveExam2(Request $request){
    $student = Student::find($request->studentid);
    $student->od_dist = $request->oddist;
    $student->os_dist = $request->osdist;
    $student->notes = $request->notes;
    $student->ou_near = $request->ounear;
    $student->ou_color = $request->color;
    if($student->save()){
      return response('saved');
    }
    }


    public function exam3($id){
      $calibration = Calibration::find(1) ;
      $student = Student::find($id);
      return view('revised-exams/bilat-non-color')->with(compact('calibration', 'student'));
    }
    public function saveExam3(Request $request){
    $student = Student::find($request->studentid);
    $student->od_dist = $request->oddist;
    $student->os_dist = $request->osdist;
    $student->notes = $request->notes;
    $student->ou_near = $request->ounear;
    $student->ou_dist = $request->oudist;
    if($student->save()){
      return response('saved');
    }
    }
    public function exam4($id){
      $calibration = Calibration::find(1) ;
      $student = Student::find($id);
      return view('revised-exams/non-bilat-non-color')->with(compact('calibration', 'student'));
    }
    public function saveExam4(Request $request){
    $student = Student::find($request->studentid);
    $student->od_dist = $request->oddist;
    $student->os_dist = $request->osdist;
    $student->notes = $request->notes;
    $student->ou_color = $request->color;
    $student->ou_near = $request->ounear;
    if($student->save()){
      return response('saved');
    }
    }



    public function submit(Request $request){

      $student = Student::find($request->student_id);
      if($student){
      $student->fname = $request->fname;
      $student->lname = $request->lname;
      $student->dob = Carbon::parse($request->dob);
      $student->student_number = $request->number;
      $student->school = $request->school;
      $student->district = $request->district;
      $student->teacher = $request->teacher;
      $student->last_edited = now();
      $student->gender = $request->gender;
      $student->save();
      return back();
    } else{
      $student = new Student();
      $student->fname = $request->fname;
      $student->lname = $request->lname;
      $student->dob = Carbon::parse($request->dob);
      $student->student_number = $request->number;
      $student->school = $request->school;
      $student->district = $request->district;
      $student->teacher = $request->teacher;
      $student->gender = $request->gender;
      $student->save();
      return back();

    }

    }


    public function newHearingStudent(Request $request){

      $student = new Student();
      $student->fname = $request->fname;
      $student->lname = $request->lname;
      $student->dob = Carbon::parse($request->dob);
      $student->student_number = $request->number;
      $student->school = $request->school;
      $student->district = $request->district;
      $student->teacher = $request->teacher;
      $student->gender = $request->gender;
      $student->grade = $request->grade;
      $student->nurse = $request->nurse;
      $student->last_edited = now();

      if($student->save()){
            return response()->json(['student' => $student->fresh()]);
      }
    }


    public function autosave(Request $request){

      $student = Student::find($request->studentID);
      $student->od_dist = $request->ODdist;
      $student->os_dist = $request->OSdist;
      $student->ou_dist = $request->OUdist;
      $student->complete = 1;
      $student->vision_pass = $student->passOrFail($student);
      $student->last_edited = now();
      $student->save();

      $total = Student::where('district', $request->district)
                        ->where('school', $request->school)
                        ->where('complete', 1)->count();

      return response()->json(['total'=>$total]);

    }

    public function studentCount(Request $request){
      $total = Student::where('district', $request->district)
                        ->where('school', $request->school)
                        ->where('complete', "1")->count();

      return response()->json(['total'=>$total]);
    }
    public function hearingStudentCount(Request $request){
      $total = Student::where('district', $request->district)
                        ->where('school', $request->school)
                        ->where('hearing_complete', "1")->count();

      return response()->json(['total'=>$total]);
    }

    public function noteSave(Request $request){
      $student = Student::find($request->studentID);
      $student->notes = $request->note;
      $student->complete = 1;
      $student->last_edited = now();
      $student->save();

      return;

    }

    public function saveColor(Request $request){
      $student = Student::find($request->studentID);
      $student->ou_color = $request->color;
      $student->complete = 1;
      $student->last_edited = now();
      $student->save();

      return;

    }
    public function hearingNoteSave(Request $request){
      $student = Student::find($request->studentID);
      $student->notes = $request->note;
      $student->hearing_complete = "1";
      $student->last_edited = now();
      $student->save();

      return;
    }

    public function autosave2(Request $request){
      $student = Student::find($request->studentID);
      // $student->od_near = $request->ODnear;
      // $student->os_near = $request->OSnear;
      $student->ou_near = $request->OUnear;
      $student->complete = 1;
      $student->vision_pass = $student->passOrFail($student);
      $student->last_edited = now();
      $student->save();


    }


    public function delete($id){
      $student = Student::find($id);
      $student->od_dist = NULL;
      $student->os_dist = NULL;
      $student->od_near = NULL;
      $student->os_near = NULL;
      $student->ou_color = NULL;
      $student->od_cyl = NULL;
      $student->os_cyl = NULL;
      $student->ou_dist = NULL;
      $student->ou_near = NULL;
      $student->hearing_complete = NULL;
      $student->hearing_nurse = NULL;
      $student->complete = NULL;
      $student->r1k = NULL;
      $student->r2k = NULL;
      $student->r4k = NULL;
      $student->r5k = NULL;
      $student->l1k = NULL;
      $student->l2k = NULL;
      $student->l4k = NULL;
      $student->l5k = NULL;
      $student->last_edited = null;
      $student->notes = NULL;
      $student->vision_pass = NULL;
      $student->hearing_pass = NULL;
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

      $students = Student::whereDate('last_edited', Carbon::today())->get();
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

      $students = Student::whereDate('last_edited', $request->date)->get();
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


    public function deleteStudent(Request $request){
      $student = Student::find($request->studentID)->delete();
    }


}
