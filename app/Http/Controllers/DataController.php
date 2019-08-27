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
                        $parsedData = ltrim($importData[0], ';');
                        $parsedData = explode(';', $parsedData);

                        $insertData = array(
                            "fname" => ucfirst($parsedData[0]),
                            "lname" => ucfirst($parsedData[1]),
                            "student_number" => empty($parsedData[2]) ? 'NULL' : $parsedData[2],
                            "dob" => empty($parsedData[3]) ? 'NULL' : $parsedData[3],
                            "gender" => empty($parsedData[4]) ? 'NULL' : $parsedData[4],
                            "district" => empty($parsedData[5]) ? 'NULL' : ucfirst($parsedData[5]),
                            "school" => empty($parsedData[6]) ? 'NULL' : $parsedData[6],
                            "teacher" => empty($parsedData[7]) ? 'NULL' : ucfirst($parsedData[7]),
                            "grade" => empty($parsedData[8]) ? 'NULL' : $parsedData[8],
                            "complete" => empty($parsedData[9]) ? 'NULL' : $parsedData[9],
                            "od_dist" => empty($parsedData[10]) ? 'NULL' : $parsedData[10],
                            "od_near" => empty($parsedData[11]) ? 'NULL' : $parsedData[11],
                            "od_cyl" => empty($parsedData[12]) ? 'NULL' : $parsedData[12],
                            "ou_color" => empty($parsedData[13]) ? 'NULL' : $parsedData[13],
                            "os_dist" => empty($parsedData[14]) ? 'NULL' : $parsedData[14],
                            "os_near" => empty($parsedData[15]) ? 'NULL' : $parsedData[15],
                            "os_cyl" => empty($parsedData[16]) ? 'NULL' : $parsedData[16],
                            "ou_dist" => empty($parsedData[17]) ? 'NULL' : $parsedData[17],
                            "ou_near" => empty($parsedData[18]) ? 'NULL' : $parsedData[18],
                            "notes" => empty($parsedData[19]) ? 'NULL' : $parsedData[19],
                            "nurse" => empty($parsedData[20]) ? 'NULL' : ucfirst($parsedData[20]),
                            "r1k" => empty($parsedData[21]) ? 'NULL' : $parsedData[21],
                            "r2k" => empty($parsedData[22]) ? 'NULL' : $parsedData[22],
                            "r4k" => empty($parsedData[23]) ? 'NULL' : $parsedData[23],
                            "r5k" => empty($parsedData[24]) ? 'NULL' : $parsedData[24],
                            "l1k" => empty($parsedData[25]) ? 'NULL' : $parsedData[25],
                            "l2k" => empty($parsedData[26]) ? 'NULL' : $parsedData[26],
                            "l4k" => empty($parsedData[27]) ? 'NULL' : $parsedData[27],
                            "l5k" => empty($parsedData[28]) ? 'NULL' : $parsedData[28],
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
        $students = Student::all();
        $students->each->delete();
        return back();
    }

    public function exportRoster(Request $request)
    {

        $students = Student::whereDate('last_edited', $request->date)->get();
        $pdf = PDF::loadView('printRoster', compact('students'), [], ['orientation' => 'L']);
        return $pdf->stream('roster' . Carbon::today() . '.pdf');


    }

}
