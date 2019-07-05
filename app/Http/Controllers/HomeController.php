<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
      $students = Student::all();
      $districts = $students->unique('district');
        return view('chartHome')->with(compact('districts'));
    }

    public function schoolSelect(){
      $students = Student::all();
      $districts = $students->unique('district');
      return view('schoolSelect')->with(compact('districts'));
    }
}
