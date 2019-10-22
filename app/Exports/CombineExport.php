<?php

namespace App\Exports;

use App\Combine;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\Input;

class CombineExport implements FromCollection, WithHeadings
{
    public function headings(): array
    {
        return [
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
            'hearing_complete',
            'hearing_nurse',
            'vision_pass',
            'hearing_pass'
        ];
    }


  use Exportable;



    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // $date = Input::get('date');
        return Combine::all();
    }


}
