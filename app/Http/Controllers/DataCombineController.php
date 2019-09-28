<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mpdf\Tag\P;
use Session;
use Rap2hpoutre\FastExcel\Facades\FastExcel;
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

foreach($request->csv_import as $csv){

    $users = (new FastExcel)->import($csv, function ($line) {
          $student = Student::where('student_id');
        });

    }
}




}
