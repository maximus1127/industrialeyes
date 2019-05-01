<?php

namespace App\Exports;

use App\Student;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Support\Facades\Input;

class StudentsExport implements FromQuery
{
  use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function query()
    {
        // $date = Input::get('date');
        return Student::query()->where('completed', '1');
    }
}
