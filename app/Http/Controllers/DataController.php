<?php

namespace App\Http\Controllers;

use Session;
use Illuminate\Http\Request;
use App\Student;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;
use App\Exports\StudentsExport;
use PDF;

class DataController extends Controller{

  public function index(){
    return view('dataLoad');
  }

  public function uploadFile(Request $request){

    if ($request->input('submit') != null ){

      $file = $request->file('file');

      // File Details
      $filename = $file->getClientOriginalName();
      $extension = $file->getClientOriginalExtension();
      $tempPath = $file->getRealPath();
      $fileSize = $file->getSize();
      $mimeType = $file->getMimeType();

      // Valid File Extensions
      $valid_extension = array("csv");

      // 2MB in Bytes
      $maxFileSize = 2097152;

      // Check file extension
      if(in_array(strtolower($extension),$valid_extension)){

        // Check file size
        if($fileSize <= $maxFileSize){

          // File upload location
          $location = 'uploads';

          // Upload file
          $file->move($location,$filename);

          // Import CSV to Database
          $filepath = public_path($location."/".$filename);

          // Reading file
          $file = fopen($filepath,"r");

          $importData_arr = array();
          $i = 0;

          while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE) {
             $num = count($filedata );

             // Skip first row (Remove below comment if you want to skip the first row)
             if($i == 0){
                $i++;
                continue;
             }
             for ($c=0; $c < $num; $c++) {
                $importData_arr[$i][] = mb_strtolower($filedata [$c]);
             }
             $i++;
          }
          fclose($file);

          // Insert to MySQL database
          foreach($importData_arr as $importData){
            for($ar = 0; $ar < 8; $ar++){
              if($importData[$ar] == ""){
                $importData[$ar] = 0;
              }
            }
            $insertData = array(
               "fname"=>ucfirst($importData[2]),
               "lname"=>ucfirst($importData[1]),
               "student_number"=>$importData[4],
               "dob"=>$importData[5],
               "gender"=>$importData[6],
               "district"=>$request->district,
               "school"=>ucfirst($importData[0]),
               "teacher"=>ucfirst($importData[7]),
               "last_edited" => now());
            Student::insertData($insertData);

          }

          Session::flash('message','Import Successful.');
        }else{
          Session::flash('message','File too large. File must be less than 2MB.');
        }

      }else{
         Session::flash('message','Invalid File Extension.');
      }

    }

    // Redirect to index
    return redirect()->action('DataController@index');
  }


public function exportIndex(){
  return view('download');
}

  public function exportData(Request $request){
    $headings = [
            'id',
            'fname',
            'lname',
            'student_number' ,
            'dob',
            'gender',
            'district',
            'school',
            'teacher',
            'last_edited',
            'complete',
            'od_dist',
            'od_near',
            'od_cyl',
            'ou_color',
            'os_dist',
            'os_near',
            'os_cyl',
            'ou_dist',
            'ou_near',
            'notes',
            'nurse',
            'r1k',
            'r2k',
            'r4k',
            'r5k',
            'l1k',
            'l2k',
            'l4k',
            'l5k',
            'grade'
        ];

    return Excel::download(new StudentsExport($headings), 'students.csv');
  }
  // public function exportData(Request $request){
  //   $date = Carbon::parse($request->date)->format('Y-m-d');
  //   $data = Student::where('last_edited', 'like', '%'.$date.'%')->get();
  //   return Excel::download($data, 'students.csv');
  // }

public function deleteDatabase(){
  $students = Student::all();
  $students->each->delete();
  return back();
}

public function exportRoster(Request $request){

$students = Student::whereDate('last_edited', $request->date)->get();
$pdf = PDF::loadView('printRoster', compact('students'), [], ['orientation' => 'L']);
return $pdf->stream('roster'.Carbon::today().'.pdf');





}




}
