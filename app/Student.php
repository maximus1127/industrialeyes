<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    public static function insertData($data)
    {
        DB::table('students')->insert($data);
    }

    public $timestamps = false;
}
