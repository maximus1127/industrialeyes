<?php

namespace App\Http\Controllers;

use Mpdf\Tag\P;
use Session;
use Illuminate\Http\Request;
use App\Student;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;
use App\Exports\StudentsExport;
use PDF;
use DB;

class DataController extends Controller
{

    public function index()
    {
        return view('dataLoad');
    }

    public function uploadFile(Request $request)
    {

        if ($request->input('submit') != null) {

            $file = $request->file('csv_import');

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
            if (in_array(strtolower($extension), $valid_extension)) {

                // Check file size
                if ($fileSize <= $maxFileSize) {

                    // File upload location
                    $location = 'uploads';

                    // Upload file
                    $file->move($location, $filename);

                    // Import CSV to Database
                    $filepath = public_path($location . "/" . $filename);

                    // Reading file
                    $file = fopen($filepath, "r");

                    $importData_arr = array();
                    $i = 0;

                    while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE) {
                        $num = count($filedata);

                        // Skip first row (Remove below comment if you want to skip the first row)
                        if ($i == 0) {
                            $i++;
                            continue;
                        }
                        for ($c = 0; $c < $num; $c++) {
                            $importData_arr[$i][] = mb_strtolower($filedata [$c]);
                        }
                        $i++;
                    }
                    fclose($file);

                    $totalStudentData = [];
                    $studentData = [];
                    //$district = empty($request->district) ? 'NULL' : $request->district;
                    $totalCount = count($importData_arr);

                    // Insert to Sqlite database
                    foreach ($importData_arr as $key => $importData) {
                        //var_dump($importData); exit;
                        //$parsedData = preg_replace('/;+/', ';', $importData[0]);

                        $insertData = array(
                            "fname" => ucfirst($importData[1]),
                            "lname" => ucfirst($importData[2]),
                            "student_number" => empty($importData[3]) ? 'NULL' : $importData[3],
                            "dob" => empty($importData[4]) ? 'NULL' : $importData[4],
                            "gender" => empty($importData[5]) ? 'NULL' : $importData[5],
                            "district" => empty($importData[6]) ? 'NULL' : ucfirst($importData[6]),
                            "school" => empty($importData[7]) ? 'NULL' : $importData[7],
                            "teacher" => empty($importData[8]) ? 'NULL' : ucfirst($importData[8]),
                            "grade" => empty($importData[9]) ? 'NULL' : $importData[9],
                            "complete" => empty($importData[10]) ? 'NULL' : $importData[10],
                            "od_dist" => empty($importData[11]) ? 'NULL' : $importData[11],
                            "od_near" => empty($importData[12]) ? 'NULL' : $importData[12],
                            "od_cyl" => empty($importData[13]) ? 'NULL' : $importData[13],
                            "ou_color" => empty($importData[14]) ? 'NULL' : $importData[14],
                            "os_dist" => empty($importData[15]) ? 'NULL' : $importData[15],
                            "os_near" => empty($importData[16]) ? 'NULL' : $importData[16],
                            "os_cyl" => empty($importData[17]) ? 'NULL' : $importData[17],
                            "ou_dist" => empty($importData[18]) ? 'NULL' : $importData[18],
                            "ou_near" => empty($importData[19]) ? 'NULL' : $importData[19],
                            "notes" => empty($importData[20]) ? 'NULL' : $importData[20],
                            "nurse" => empty($importData[21]) ? 'NULL' : ucfirst($importData[21]),
                            "r1k" => empty($importData[22]) ? 'NULL' : $importData[22],
                            "r2k" => empty($importData[23]) ? 'NULL' : $importData[23],
                            "r4k" => empty($importData[24]) ? 'NULL' : $importData[24],
                            "r5k" => empty($importData[25]) ? 'NULL' : $importData[25],
                            "l1k" => empty($importData[26]) ? 'NULL' : $importData[26],
                            "l2k" => empty($importData[27]) ? 'NULL' : $importData[27],
                            "l4k" => empty($importData[28]) ? 'NULL' : $importData[28],
                            "l5k" => empty($importData[29]) ? 'NULL' : $importData[29],
                            "last_edited" => now()->format('Y-m-d H:i:s'),
                        );
                        $studentData [] = $insertData;

                        if ($key != 0 && $key % 29 == 0) {
                            $totalStudentData [] = $studentData;
                            $studentData = [];
                        }

                        if ($key == $totalCount && $key % 29 != 0) {
                            $totalStudentData [] = $studentData;
                        }
                    }

                    foreach ($totalStudentData as $key => $groupData) {
                        Student::insertData($groupData);
                    }

                    Session::flash('message', 'Import Successful.');
                } else {
                    Session::flash('message', 'File too large. File must be less than 2MB.');
                }

            } else {
                Session::flash('message', 'Invalid File Extension.');
            }

        }

        // Redirect to index
        return redirect()->action('DataController@index');
    }


    public function exportIndex()
    {
        return view('download');
    }

    public function exportData(Request $request)
    {
        $headings = [
            'id',
            'fname',
            'lname',
            'student_number',
            'dob',
            'gender',
            'district',
            'school',
            'teacher',
            'grade',
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
            'last_edited',
        ];

        return Excel::download(new StudentsExport($headings), 'students.csv');
    }
    // public function exportData(Request $request){
    //   $date = Carbon::parse($request->date)->format('Y-m-d');
    //   $data = Student::where('last_edited', 'like', '%'.$date.'%')->get();
    //   return Excel::download($data, 'students.csv');
    // }

    public function deleteDatabase()
    {
        Student::truncate();
        return back();
    }

    public function exportVisionRoster(Request $request)
    {
      if($request->date){
        $students = Student::whereDate('last_edited', $request->date)->get();
      } else {
        $students = Student::whereDate('last_edited', Carbon::today())->get();
      }
        $pdf = PDF::loadView('printRoster', compact('students'), [], ['orientation' => 'L']);
        return $pdf->stream('roster' . Carbon::today() . '.pdf');


    }

    public function exportHearingRoster(Request $request)
    {

      if($request->date){
        $students = Student::whereDate('last_edited', $request->date)->get();
      } else {
        $students = Student::whereDate('last_edited', Carbon::today())->get();
      }
        $pdf = PDF::loadView('printHearingRoster', compact('students'), [], ['orientation' => 'L']);
        return $pdf->stream('roster' . Carbon::today() . '.pdf');


    }

}
