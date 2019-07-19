<?php

namespace App\Exports;

use App\Student;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\Input;

class StudentsExport implements FromQuery, WithHeadings
{
  use Exportable;


  public function __construct($headings)
    {

        $this->headings = $headings;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function query()
    {
        // $date = Input::get('date');
        return Student::query()->where('complete', '1');
    }

    public function headings() : array
      {
          return $this->headings;
      }
}
