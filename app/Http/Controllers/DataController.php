<?php

namespace App\Http\Controllers;

use Session;
use Illuminate\Http\Request;
use App\Student;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;
use App\Exports\StudentsExport;

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
               "created_at" => now());
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
  return view('Download');
}

  public function exportData(Request $request){

    return Excel::download(new StudentsExport, 'students.csv');
  }
  // public function exportData(Request $request){
  //   $date = Carbon::parse($request->date)->format('Y-m-d');
  //   $data = Student::where('updated_at', 'like', '%'.$date.'%')->get();
  //   return Excel::download($data, 'students.csv');
  // }

public function deleteDatabase(){
  $students = Student::all();
  $students->each->delete();
  return back();
}


}
