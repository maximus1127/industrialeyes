<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mpdf\Tag\P;
use Session;
use Rap2hpoutre\FastExcel\Facades\FastExcel;
use App\Combine;
use App\Student;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;
use App\Exports\StudentsExport;
use App\Exports\StudentsAutoExport;
use PDF;
use DB;
use LynX39\LaraPdfMerger\Facades\PdfMerger;
use Illuminate\Filesystem\Filesystem;
use PHPMailer\PHPMailer\PHPMailer;

class DataCombineController extends Controller
{

  public function index(){
    return view('dataCombine');
  }


  public function combineCSV(Request $request){
    $csv = request('csv_import');
    for($i = 0; $i < sizeof($csv); $i++){
      $file = fopen($csv[$i],"r");
          $c = 0;
          while (($data = fgetcsv($file, 0, ',')) !== FALSE) {
            if($c == 0){
              $c++;
              continue;
            } else {
              $student = Student::where('fname', $data[1])->
                                  where('lname', $data[2])->
                                  where('student_number', $data[3])->first();

              if($student){
                  if ($student->complete == NULL && $data[10] != NULL){
                   $student->complete = $data[10];
               }
              if ($student->od_dist == NULL && $data[11] != NULL){
                  $student->od_dist = $data[11];
              }
              if ($student->od_near == NULL && $data[12] != NULL){
                  $student->od_near = $data[12];
              }
              if ($student->od_cyl == NULL && $data[13] != NULL){
                  $student->od_cyl = $data[13];
              }
              if ($student->ou_color == NULL && $data[14] != NULL){
                  $student->ou_color = $data[14];
              }
              if ($student->os_dist == NULL && $data[15] != NULL){
                  $student->os_dist = $data[15];
              }
              if ($student->os_near == NULL && $data[16] != NULL){
                  $student->os_near = $data[16];
              }
              if ($student->os_cyl == NULL && $data[17] != NULL){
                  $student->os_cyl = $data[17];
              }
              if ($student->ou_dist == NULL && $data[18] != NULL){
                  $student->ou_dist = $data[18];
              }
              if ($student->ou_near == NULL && $data[19] != NULL){
                  $student->ou_near = $data[19];
              }
              if ($student->notes == NULL && $data[20] != NULL){
                  $student->notes = $data[20];
              }
              if ($student->nurse == NULL && $data[21] != NULL){
                  $student->nurse = $data[21];
              }
              if ($student->r1k == NULL && $data[22] != NULL){
                  $student->r1k = $data[22];
              }
              if ($student->r2k == NULL && $data[23] != NULL){
                  $student->r2k = $data[23];
              }
              if ($student->r4k == NULL && $data[24] != NULL){
                  $student->r4k = $data[24];
              }
              if ($student->r5k == NULL && $data[25] != NULL){
                  $student->r5k = $data[25];
              }
              if ($student->l1k == NULL && $data[26] != NULL){
                  $student->l1k = $data[26];
              }
              if ($student->l2k == NULL && $data[27] != NULL){
                  $student->l2k = $data[27];
              }
              if ($student->l4k == NULL && $data[28] != NULL){
                  $student->l4k = $data[28];
              }
              if ($student->l5k == NULL && $data[29] != NULL){
                  $student->l5k = $data[29];
              }
              if ($student->last_edited == NULL && $data[30] != NULL){
                  $student->last_edited = $data[30];
              }
              if ($student->hearing_complete == NULL && $data[31] != NULL){
                  $student->hearing_complete = $data[31];
              }
              if ($student->hearing_nurse == NULL && $data[32] != NULL){
                  $student->hearing_nurse = $data[32];
              }
              if ($student->vision_pass == NULL && $data[33] != NULL){
                  $student->vision_pass = $data[33];
              }
              if ($student->hearing_pass == NULL && $data[34] != NULL){
                  $student->hearing_pass = $data[34];
              }
              $student->save();
            } else {
              $student = new Student();
              $student->fname = $data[1];
              $student->lname = $data[2];
              $student->student_number = $data[3];
              $student->dob = $data[4];
                  $student->gender = $data[5];
              $student->district = $data[6];
              $student->school = $data[7];
              $student->teacher = $data[8];
                  $student->grade = $data[9];
              $student->complete = $data[10];
              $student->od_dist = $data[11];
              $student->od_near = $data[12];
                  $student->od_cyl = $data[13];
              $student->ou_color = $data[14];
              $student->os_dist = $data[15];
              $student->os_near = $data[16];
                  $student->os_cyl = $data[17];
              $student->ou_dist = $data[18];
              $student->ou_near = $data[19];
              $student->notes = $data[20];
                  $student->nurse = $data[21];
              $student->r1k = $data[22];
              $student->r2k = $data[23];
              $student->r4k = $data[24];
                  $student->r5k = $data[25];
              $student->l1k = $data[26];
              $student->l2k = $data[27];
              $student->l4k = $data[28];
                  $student->l5k = $data[29];
              $student->last_edited = $data[30];
              $student->hearing_complete = $data[31];
              $student->hearing_nurse = $data[32];
                  $student->vision_pass = $data[33];
              $student->hearing_pass = $data[34];
              $student->save();
            }
          }
          }

          fclose($file);
    }
      return back();

}




}
