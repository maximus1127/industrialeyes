<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Milon\Barcode\DNS1D;
use PDF;
use Mpdf\Tag\P;
use App\Student;

class BarcodeController extends Controller
{
    public function index(Request $request)
    {
        $students = Student::where('school', $request->school)->orderBy('teacher', 'asc')->orderBy('lname', 'asc')->get();
        $pdf = PDF::loadView('printBarcode', compact('students'));
        return $pdf->stream('barcodes.pdf');
    }
}
