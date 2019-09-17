<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('/css/bootstrap.min.css')}}" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('/css/bootstrap-grid.min.css')}}" crossorigin="anonymous">
    {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> --}}
    <link href="{{asset('/css/form-styling.css')}}" rel="stylesheet" type="text/css">
    {{-- <link href="form-styling.css" rel="stylesheet" type="text/css"> --}}

         <style>
             html{
                 font-size: 13pt;
                 zoom: .8;

             }
             li{
                 font-size: 12pt;
                 border-top: 1px solid black;
                 cursor: pointer;
                 list-style-type: none;
                 color: black !important;
                 font-weight: bold;
             }

             #color-pass, #color-fail{
               margin-top: 20px;
               height: 20px;
               width: 20px;
             }

             .hearing_line{
               padding-bottom: 30px;
               border-bottom: 1px gray solid;
               border-right: 1px gray solid;
               margin-bottom: 10px;
             }

             .remove{
               width: 30px;
               height: 30px;
               background-color: red;
               border-radius: 20px;
              font-weight: 1000;
               color: white;
               margin: 0 15px 15px 15px;
               text-align: center;

               padding-bottom: 15px;
               cursor: pointer;
             }

             .pass{
               width: 30px;
               height: 30px;

               background-color: green;
               border-radius: 20px;
               font-weight: 1000;
               margin: 0 15px 15px 15px;
               color: white;
               padding-bottom: 15px;
               text-align: center;
               cursor: pointer;
             }

         </style>


       <title>Industrial Eyes</title>

     </head>
     <body>
@if(Auth::user()->is_admin == 1)
       <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
     <a class="navbar-brand" href="#">Industrial Eyes</a>
     <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
       <span class="navbar-toggler-icon"></span>
     </button>
     <div class="collapse navbar-collapse" id="navbarNav">
       <ul class="navbar-nav">
         <li class="nav-item active">
           <a class="nav-link" href="{{url('/')}}">Home <span class="sr-only">(current)</span></a>
         </li>
         <li class="nav-item">
           <a class="nav-link" href="{{route('upload')}}">Upload Data</a>
         </li>
         <li class="nav-item">
           <a class="nav-link" href="{{route('export.index')}}">Download Data</a>
         </li>

         <li>


         </li>
       </ul>
     </div>

   </nav>
 @endif
 <div id="top-bar" >
     {{-- <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
         {{ Auth::user()->name }} <span class="caret"></span>
     </a> --}}

     {{-- <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown"> --}}
     <div class="top_item">
       <a class="btn btn-secondary" style="margin: 5px 20px 0 20px;" href="{{ route('logout') }}"
          onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
           {{ __('Logout') }}
       </a>

       <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
           @csrf
       </form>
     </div>

      <button type="button"  onclick="back()" id="back-button"  class="btn btn-primary" style="margin-left: 20px;">
         Back
       </button>

      Students Examined: {{$completed_students->count()}}




 </div>
 <br />
     <div class="container-fluid">
   <br>

         <div class="chartForm">
            <div class="row">
              <div class="col-md-4 d-inline-block align-top">
           <div class="leftSideBar">



             <div class="searh-box"><input  type="text" onkeyup="findName()" id="search" name="search" placeholder="Search" class="form-control"/></div>

             <div class="students-list " style="max-height: 500px;">
                    <ul id="students">


                            @foreach($students as $student)
                                <li class="student_list" data-fname = "{{$student->fname}}" data-lname = "{{$student->lname}}" data-identify = "{{$student->id}}"  data-number = "{{$student->student_number}}"  onclick="addTestee(this)">
                                  {{$student->fname.' '.$student->lname}}
                                </li>
                            @endforeach

                     </ul>

             </div>
             <br />
             <br />
 <h4>New Student</h4>
             <div class="row">

               <div class="col-md-6 col-lg-4">
                   <div class="form-group">
                     <!--<label for="fname">First Name</label>-->
                     <input type="text" class="form-control" name="fname" id="fname" placeholder="First Name"/>
                   </div>
               </div>
               <div class="col-md-6 col-lg-4">
                   <div class="form-group">
                     <!--<label for="lname">Last Name</label>-->
                     <input type="text" class="form-control" name="lname" id="lname" placeholder="Last Name"/>
                   </div>
               </div>
               <div class="col-md-6 col-lg-4">
                   <div class="form-group">
                     <!--<label for="dob">Date of Birth</label>-->
                     <input type="text" class="form-control" name="dob" id="dob" placeholder="Date of Birth" />
                   </div>
               </div>
               <div class="col-md-2 col-lg-2">
                   <div class="form-group">
                     <!--<label for="gender">Gender</label>-->
                     <input type="text" class="form-control" name="gender" id="gender" placeholder="Gender" />
                   </div>
               </div>
               <div class="col-md-2 col-lg-2">
                   <div class="form-group">
                     <!--<label for="gender">Gender</label>-->
                     <input type="text" class="form-control" name="grade" id="grade" placeholder="Grade" />
                   </div>
               </div>
               <div class="col-md-6 col-lg-4">
                   <div class="form-group">
                     <!--<label for="number">Student Number</label>-->
                     <input type="text" class="form-control" name="number" id="number" placeholder="Student Number" />
                   </div>
               </div>
               <div class="col-md-6 col-lg-4">
                   <div class="form-group">
                     <!--<label for="district">District</label>-->
                     <input type="text" class="form-control" name="district" id="district" placeholder="District" />
                   </div>
               </div>
               <div class="col-md-6 col-lg-4">
                   <div class="form-group">
                     <!--<label for="school">School</label>-->
                     <input type="text" class="form-control" name="school" id="school" placeholder="School" />
               </div>
               </div>
               <div class="col-md-6 col-lg-4">
                   <div class="form-group">
                     <!--<label for="teacher">Teacher</label>-->
                     <input type="text" class="form-control" name="teacher" id="teacher" placeholder="Teacher" />
                   </div>
               </div>
               <div class="col-md-6 col-lg-4">

                   <button class="btn btn-sm btn-success" onclick='newStudent()'>Add</button>
               </div>

             </div>


           </div>
            </div>
           <div class="main-form-content col-md-8 d-inline-block align-top">


                {{-- <h3>Student Data</h3> --}}
                <hr>
           <div class="content" style = "font-size: 20px;">
             <form class="exam_data" method="post" action = "{{route('submitHearingExam')}}">
               <button type="submit" class="btn btn-primary">Submit All Exams</button>
               <button type="button" class="btn btn-success" onclick="allPass()">All Pass</button>
                   @csrf
                   <div id="hearing-rows">
                     <div class="row">

                     <div class="hearing_line pull-left" id="studentLine1">
                     <div class="form-inline">
                     <div class = 'remove' onclick="remove(1)">X</div>
                     <div class = 'pass' onclick = 'pass(1)'>	&#10004;</div>
                     <div class = 'pass' onclick = 'refer(1)'>R</div>
                     <div style="background-color: #e8e5e5; padding: 10px; border-radius: 6px; cursor: pointer;" id="student1name" class="form-inline" onclick="addStudent(1)">
                     <strong>Booth 1</strong>


                       </div>
                       </div>

                      <input type='hidden' name='studentID[]' value= '' id="student1id"/>
                      <div class="form-inline">
                       <div class="form-inline">
                       <label for="r1k">R1k</label>
                       <select type="text" class="form-control hearing-dropdown" onchange="passFilter(this, 1)" name="r1k[]" id="r1k">
                         <option value="">
                         </option>
                         <option value = '25'>25</option>
                         <option value = '30'>30</option>
                         <option value = '35'>35</option>
                         <option value = '40'>40</option>
                         <option value = '45'>45</option>
                         <option value = '50'>50</option>
                         <option value = '55'>55</option>
                         <option value = '60'>60</option>
                         <option value = '65'>65</option>
                         <option value = '70'>70</option>
                         <option value = '75'>75</option>
                         <option value = '80'>80</option>
                         <option value = '85'>85</option>
                         <option value = '90'>90</option>
                         <option value = '95'>95</option>
                         <option value = 'NR'>NR</option>
                       </select>
                     </div>
                       <div class="form-inline">
                       <label for="r2k">R2k</label>
                       <select type="text" class="form-control hearing-dropdown" onchange="passFilter(this, 1)" name="r2k[]" id="r2k">
                         <option value="">
                         </option>
                         <option value = '25'>25</option>
                         <option value = '30'>30</option>
                         <option value = '35'>35</option>
                         <option value = '40'>40</option>
                         <option value = '45'>45</option>
                         <option value = '50'>50</option>
                         <option value = '55'>55</option>
                         <option value = '60'>60</option>
                         <option value = '65'>65</option>
                         <option value = '70'>70</option>
                         <option value = '75'>75</option>
                         <option value = '80'>80</option>
                         <option value = '85'>85</option>
                         <option value = '90'>90</option>
                         <option value = '95'>95</option>
                         <option value = 'NR'>NR</option>
                       </select>
                       </div>
                       <div class="form-inline">
                       <label for="r4k">R4k</label>
                       <select type="text" class="form-control hearing-dropdown" onchange="passFilter(this, 1)" name="r4k[]" id="r4k">
                         <option value="">
                         </option>
                         <option value = '25'>25</option>
                         <option value = '30'>30</option>
                         <option value = '35'>35</option>
                         <option value = '40'>40</option>
                         <option value = '45'>45</option>
                         <option value = '50'>50</option>
                         <option value = '55'>55</option>
                         <option value = '60'>60</option>
                         <option value = '65'>65</option>
                         <option value = '70'>70</option>
                         <option value = '75'>75</option>
                         <option value = '80'>80</option>
                         <option value = '85'>85</option>
                         <option value = '90'>90</option>
                         <option value = '95'>95</option>
                         <option value = 'NR'>NR</option>
                       </select>
                       </div>

                       <div class="form-inline" style="padding-left: 20px;">
                       <label for="l1k">L1k</label>
                       <select type="text" class="form-control hearing-dropdown" onchange="passFilter(this, 1)" name="l1k[]" id="l1k">
                         <option value="">
                         </option>
                         <option value = '25'>25</option>
                         <option value = '30'>30</option>
                         <option value = '35'>35</option>
                         <option value = '40'>40</option>
                         <option value = '45'>45</option>
                         <option value = '50'>50</option>
                         <option value = '55'>55</option>
                         <option value = '60'>60</option>
                         <option value = '65'>65</option>
                         <option value = '70'>70</option>
                         <option value = '75'>75</option>
                         <option value = '80'>80</option>
                         <option value = '85'>85</option>
                         <option value = '90'>90</option>
                         <option value = '95'>95</option>
                         <option value = 'NR'>NR</option>
                       </select>
                     </div>
                       <div class="form-inline">
                       <label for="l2k">L2k</label>
                       <select type="text" class="form-control hearing-dropdown" onchange="passFilter(this, 1)" name="l2k[]" id="l2k">
                         <option value="">
                         </option>
                         <option value = '25'>25</option>
                         <option value = '30'>30</option>
                         <option value = '35'>35</option>
                         <option value = '40'>40</option>
                         <option value = '45'>45</option>
                         <option value = '50'>50</option>
                         <option value = '55'>55</option>
                         <option value = '60'>60</option>
                         <option value = '65'>65</option>
                         <option value = '70'>70</option>
                         <option value = '75'>75</option>
                         <option value = '80'>80</option>
                         <option value = '85'>85</option>
                         <option value = '90'>90</option>
                         <option value = '95'>95</option>
                         <option value = 'NR'>NR</option>
                       </select>
                       </div>
                       <div class="form-inline">
                       <label for="l4k">L4k</label>
                       <select type="text" class="form-control hearing-dropdown" onchange="passFilter(this, 1)" name="l4k[]" id="l4k">
                         <option value="">
                         </option>
                         <option value = '25'>25</option>
                         <option value = '30'>30</option>
                         <option value = '35'>35</option>
                         <option value = '40'>40</option>
                         <option value = '45'>45</option>
                         <option value = '50'>50</option>
                         <option value = '55'>55</option>
                         <option value = '60'>60</option>
                         <option value = '65'>65</option>
                         <option value = '70'>70</option>
                         <option value = '75'>75</option>
                         <option value = '80'>80</option>
                         <option value = '85'>85</option>
                         <option value = '90'>90</option>
                         <option value = '95'>95</option>
                         <option value = 'NR'>NR</option>
                       </select>
                       </div>

  </div>
                    <div id="extraFreq1" style="visibility: hidden;">

                      <div class="form-inline" style="float: left;">
                     <label for="r5k">R5k</label>
                     <select type="text" class="form-control hearing-dropdown" name="r5k[]" id="r5k">
                       <option value="">
                       </option>
                       <option value = '25'>25</option>
                       <option value = '30'>30</option>
                       <option value = '35'>35</option>
                       <option value = '40'>40</option>
                       <option value = '45'>45</option>
                       <option value = '50'>50</option>
                       <option value = '55'>55</option>
                       <option value = '60'>60</option>
                       <option value = '65'>65</option>
                       <option value = '70'>70</option>
                       <option value = '75'>75</option>
                       <option value = '80'>80</option>
                       <option value = '85'>85</option>
                       <option value = '90'>90</option>
                       <option value = '95'>95</option>
                       <option value = 'NR'>NR</option>
                     </select>
                     </div>
                     <div class="form-inline" style = 'float: right;'>
                     <label for="l5k">L5k</label>
                     <select type="text" class="form-control hearing-dropdown" name="l5k[]" id="l5k">
                       <option value="">
                       </option>
                       <option value = '25'>25</option>
                       <option value = '30'>30</option>
                       <option value = '35'>35</option>
                       <option value = '40'>40</option>
                       <option value = '45'>45</option>
                       <option value = '50'>50</option>
                       <option value = '55'>55</option>
                       <option value = '60'>60</option>
                       <option value = '65'>65</option>
                       <option value = '70'>70</option>
                       <option value = '75'>75</option>
                       <option value = '80'>80</option>
                       <option value = '85'>85</option>
                       <option value = '90'>90</option>
                       <option value = '95'>95</option>
                       <option value = 'NR'>NR</option>
                     </select>
                     </div>

                   </div>
                     </div>
                     <div class="hearing_line" id="studentLine2" style="margin-left: 40px;">
                     <div class="form-inline">
                     <div class = 'remove' onclick="remove(2)">X</div>
                     <div class = 'pass' onclick = 'pass(2)'>	&#10004;</div>
                     <div class = 'pass' onclick = 'refer(2)'>R</div>
                     <div style="background-color: #e8e5e5; padding: 10px; border-radius: 6px; cursor: pointer;" id="student2name" class="form-inline" onclick="addStudent(2)">
                     <strong>Booth 2</strong>

                   </div>
                     </div>

                      <input type='hidden' name='studentID[]' value= '' id="student2id"/>
                      <div class="form-inline">
                       <div class="form-inline">
                       <label for="r1k">R1k</label>
                       <select type="text" class="form-control hearing-dropdown" onchange="passFilter(this, 2)" name="r1k[]" id="r1k">
                         <option value="">
                         </option>
                         <option value = '25'>25</option>
                         <option value = '30'>30</option>
                         <option value = '35'>35</option>
                         <option value = '40'>40</option>
                         <option value = '45'>45</option>
                         <option value = '50'>50</option>
                         <option value = '55'>55</option>
                         <option value = '60'>60</option>
                         <option value = '65'>65</option>
                         <option value = '70'>70</option>
                         <option value = '75'>75</option>
                         <option value = '80'>80</option>
                         <option value = '85'>85</option>
                         <option value = '90'>90</option>
                         <option value = '95'>95</option>
                         <option value = 'NR'>NR</option>
                       </select>

                       <div class="form-inline">
                       <label for="r2k">R2k</label>
                       <select type="text" class="form-control hearing-dropdown" onchange="passFilter(this, 2)" name="r2k[]" id="r2k">
                         <option value="">
                         </option>
                         <option value = '25'>25</option>
                         <option value = '30'>30</option>
                         <option value = '35'>35</option>
                         <option value = '40'>40</option>
                         <option value = '45'>45</option>
                         <option value = '50'>50</option>
                         <option value = '55'>55</option>
                         <option value = '60'>60</option>
                         <option value = '65'>65</option>
                         <option value = '70'>70</option>
                         <option value = '75'>75</option>
                         <option value = '80'>80</option>
                         <option value = '85'>85</option>
                         <option value = '90'>90</option>
                         <option value = '95'>95</option>
                         <option value = 'NR'>NR</option>
                       </select>
                       </div>
                       <div class="form-inline">
                       <label for="r4k">R4k</label>
                       <select type="text" class="form-control hearing-dropdown" onchange="passFilter(this, 2)" name="r4k[]" id="r4k">
                         <option value="">
                         </option>
                         <option value = '25'>25</option>
                         <option value = '30'>30</option>
                         <option value = '35'>35</option>
                         <option value = '40'>40</option>
                         <option value = '45'>45</option>
                         <option value = '50'>50</option>
                         <option value = '55'>55</option>
                         <option value = '60'>60</option>
                         <option value = '65'>65</option>
                         <option value = '70'>70</option>
                         <option value = '75'>75</option>
                         <option value = '80'>80</option>
                         <option value = '85'>85</option>
                         <option value = '90'>90</option>
                         <option value = '95'>95</option>
                         <option value = 'NR'>NR</option>
                       </select>
                       </div>

                       <div class="form-inline" style="padding-left: 20px;">
                       <label for="l1k">L1k</label>
                       <select type="text" class="form-control hearing-dropdown" onchange="passFilter(this, 2)" name="l1k[]" id="l1k">
                         <option value="">
                         </option>
                         <option value = '25'>25</option>
                         <option value = '30'>30</option>
                         <option value = '35'>35</option>
                         <option value = '40'>40</option>
                         <option value = '45'>45</option>
                         <option value = '50'>50</option>
                         <option value = '55'>55</option>
                         <option value = '60'>60</option>
                         <option value = '65'>65</option>
                         <option value = '70'>70</option>
                         <option value = '75'>75</option>
                         <option value = '80'>80</option>
                         <option value = '85'>85</option>
                         <option value = '90'>90</option>
                         <option value = '95'>95</option>
                         <option value = 'NR'>NR</option>
                       </select>
                     </div>
                       <div class="form-inline">
                       <label for="l2k">L2k</label>
                       <select type="text" class="form-control hearing-dropdown" onchange="passFilter(this, 2)" name="l2k[]" id="l2k">
                         <option value="">
                         </option>
                         <option value = '25'>25</option>
                         <option value = '30'>30</option>
                         <option value = '35'>35</option>
                         <option value = '40'>40</option>
                         <option value = '45'>45</option>
                         <option value = '50'>50</option>
                         <option value = '55'>55</option>
                         <option value = '60'>60</option>
                         <option value = '65'>65</option>
                         <option value = '70'>70</option>
                         <option value = '75'>75</option>
                         <option value = '80'>80</option>
                         <option value = '85'>85</option>
                         <option value = '90'>90</option>
                         <option value = '95'>95</option>
                         <option value = 'NR'>NR</option>
                       </select>
                       </div>
                       <div class="form-inline">
                       <label for="l4k">L4k</label>
                       <select type="text" class="form-control hearing-dropdown" onchange="passFilter(this, 2)" name="l4k[]" id="l4k">
                         <option value="">
                         </option>
                         <option value = '25'>25</option>
                         <option value = '30'>30</option>
                         <option value = '35'>35</option>
                         <option value = '40'>40</option>
                         <option value = '45'>45</option>
                         <option value = '50'>50</option>
                         <option value = '55'>55</option>
                         <option value = '60'>60</option>
                         <option value = '65'>65</option>
                         <option value = '70'>70</option>
                         <option value = '75'>75</option>
                         <option value = '80'>80</option>
                         <option value = '85'>85</option>
                         <option value = '90'>90</option>
                         <option value = '95'>95</option>
                         <option value = 'NR'>NR</option>
                       </select>
                       </div>

                       </div>

                     </div>
                     <div id="extraFreq2" style="visibility: hidden;">

                       <div class="form-inline" style="float: left;">
                      <label for="r5k">R5k</label>
                      <select type="text" class="form-control hearing-dropdown" name="r5k[]" id="r5k">
                        <option value="">
                        </option>
                        <option value = '25'>25</option>
                        <option value = '30'>30</option>
                        <option value = '35'>35</option>
                        <option value = '40'>40</option>
                        <option value = '45'>45</option>
                        <option value = '50'>50</option>
                        <option value = '55'>55</option>
                        <option value = '60'>60</option>
                        <option value = '65'>65</option>
                        <option value = '70'>70</option>
                        <option value = '75'>75</option>
                        <option value = '80'>80</option>
                        <option value = '85'>85</option>
                        <option value = '90'>90</option>
                        <option value = '95'>95</option>
                        <option value = 'NR'>NR</option>
                      </select>
                      </div>
                      <div class="form-inline" style = 'float: right;'>
                      <label for="l5k">L5k</label>
                      <select type="text" class="form-control hearing-dropdown" name="l5k[]" id="l5k">
                        <option value="">
                        </option>
                        <option value = '25'>25</option>
                        <option value = '30'>30</option>
                        <option value = '35'>35</option>
                        <option value = '40'>40</option>
                        <option value = '45'>45</option>
                        <option value = '50'>50</option>
                        <option value = '55'>55</option>
                        <option value = '60'>60</option>
                        <option value = '65'>65</option>
                        <option value = '70'>70</option>
                        <option value = '75'>75</option>
                        <option value = '80'>80</option>
                        <option value = '85'>85</option>
                        <option value = '90'>90</option>
                        <option value = '95'>95</option>
                        <option value = 'NR'>NR</option>
                      </select>
                      </div>

                    </div>
                   </div>
                   </div>
                   <div class="row">

                   <div class="hearing_line pull-left" id="studentLine3">
                   <div class="form-inline">
                   <div class = 'remove' onclick="remove(3)">X</div>
                   <div class = 'pass' onclick = 'pass(3)'>	&#10004;</div>
                   <div class = 'pass' onclick = 'refer(3)'>R</div>
                   <div style="background-color: #e8e5e5; padding: 10px; border-radius: 6px; cursor: pointer;" id="student3name" class="form-inline" onclick="addStudent(3)">
                   <strong>Booth 3</strong>

                 </div>
                   </div>

                    <input type='hidden' name='studentID[]' value= '' id="student3id"/>
                    <div class="form-inline">
                     <div class="form-inline">
                     <label for="r1k">R1k</label>
                     <select type="text" class="form-control hearing-dropdown" onchange="passFilter(this, 3)" name="r1k[]" id="r1k">
                       <option value="">
                       </option>
                       <option value = '25'>25</option>
                       <option value = '30'>30</option>
                       <option value = '35'>35</option>
                       <option value = '40'>40</option>
                       <option value = '45'>45</option>
                       <option value = '50'>50</option>
                       <option value = '55'>55</option>
                       <option value = '60'>60</option>
                       <option value = '65'>65</option>
                       <option value = '70'>70</option>
                       <option value = '75'>75</option>
                       <option value = '80'>80</option>
                       <option value = '85'>85</option>
                       <option value = '90'>90</option>
                       <option value = '95'>95</option>
                       <option value = 'NR'>NR</option>
                     </select>

                     <div class="form-inline">
                     <label for="r2k">R2k</label>
                     <select type="text" class="form-control hearing-dropdown" onchange="passFilter(this, 3)" name="r2k[]" id="r2k">
                       <option value="">
                       </option>
                       <option value = '25'>25</option>
                       <option value = '30'>30</option>
                       <option value = '35'>35</option>
                       <option value = '40'>40</option>
                       <option value = '45'>45</option>
                       <option value = '50'>50</option>
                       <option value = '55'>55</option>
                       <option value = '60'>60</option>
                       <option value = '65'>65</option>
                       <option value = '70'>70</option>
                       <option value = '75'>75</option>
                       <option value = '80'>80</option>
                       <option value = '85'>85</option>
                       <option value = '90'>90</option>
                       <option value = '95'>95</option>
                       <option value = 'NR'>NR</option>
                     </select>
                     </div>
                     <div class="form-inline">
                     <label for="r4k">R4k</label>
                     <select type="text" class="form-control hearing-dropdown" onchange="passFilter(this, 3)" name="r4k[]" id="r4k">
                       <option value="">
                       </option>
                       <option value = '25'>25</option>
                       <option value = '30'>30</option>
                       <option value = '35'>35</option>
                       <option value = '40'>40</option>
                       <option value = '45'>45</option>
                       <option value = '50'>50</option>
                       <option value = '55'>55</option>
                       <option value = '60'>60</option>
                       <option value = '65'>65</option>
                       <option value = '70'>70</option>
                       <option value = '75'>75</option>
                       <option value = '80'>80</option>
                       <option value = '85'>85</option>
                       <option value = '90'>90</option>
                       <option value = '95'>95</option>
                       <option value = 'NR'>NR</option>
                     </select>
                     </div>

                     <div class="form-inline" style="padding-left: 20px;">
                     <label for="l1k">L1k</label>
                     <select type="text" class="form-control hearing-dropdown" onchange="passFilter(this, 3)" name="l1k[]" id="l1k">
                       <option value="">
                       </option>
                       <option value = '25'>25</option>
                       <option value = '30'>30</option>
                       <option value = '35'>35</option>
                       <option value = '40'>40</option>
                       <option value = '45'>45</option>
                       <option value = '50'>50</option>
                       <option value = '55'>55</option>
                       <option value = '60'>60</option>
                       <option value = '65'>65</option>
                       <option value = '70'>70</option>
                       <option value = '75'>75</option>
                       <option value = '80'>80</option>
                       <option value = '85'>85</option>
                       <option value = '90'>90</option>
                       <option value = '95'>95</option>
                       <option value = 'NR'>NR</option>
                     </select>
                   </div>
                     <div class="form-inline">
                     <label for="l2k">L2k</label>
                     <select type="text" class="form-control hearing-dropdown" onchange="passFilter(this, 3)" name="l2k[]" id="l2k">
                       <option value="">
                       </option>
                       <option value = '25'>25</option>
                       <option value = '30'>30</option>
                       <option value = '35'>35</option>
                       <option value = '40'>40</option>
                       <option value = '45'>45</option>
                       <option value = '50'>50</option>
                       <option value = '55'>55</option>
                       <option value = '60'>60</option>
                       <option value = '65'>65</option>
                       <option value = '70'>70</option>
                       <option value = '75'>75</option>
                       <option value = '80'>80</option>
                       <option value = '85'>85</option>
                       <option value = '90'>90</option>
                       <option value = '95'>95</option>
                       <option value = 'NR'>NR</option>
                     </select>
                     </div>
                     <div class="form-inline">
                     <label for="l4k">L4k</label>
                     <select type="text" class="form-control hearing-dropdown"onchange="passFilter(this, 3)" name="l4k[]" id="l4k">
                       <option value="">
                       </option>
                       <option value = '25'>25</option>
                       <option value = '30'>30</option>
                       <option value = '35'>35</option>
                       <option value = '40'>40</option>
                       <option value = '45'>45</option>
                       <option value = '50'>50</option>
                       <option value = '55'>55</option>
                       <option value = '60'>60</option>
                       <option value = '65'>65</option>
                       <option value = '70'>70</option>
                       <option value = '75'>75</option>
                       <option value = '80'>80</option>
                       <option value = '85'>85</option>
                       <option value = '90'>90</option>
                       <option value = '95'>95</option>
                       <option value = 'NR'>NR</option>
                     </select>
                     </div>
                     </div>

                     </div>
                     <div id="extraFreq3" style="visibility: hidden;">

                       <div class="form-inline" style="float: left;">
                      <label for="r5k">R5k</label>
                      <select type="text" class="form-control hearing-dropdown" name="r5k[]" id="r5k">
                        <option value="">
                        </option>
                        <option value = '25'>25</option>
                        <option value = '30'>30</option>
                        <option value = '35'>35</option>
                        <option value = '40'>40</option>
                        <option value = '45'>45</option>
                        <option value = '50'>50</option>
                        <option value = '55'>55</option>
                        <option value = '60'>60</option>
                        <option value = '65'>65</option>
                        <option value = '70'>70</option>
                        <option value = '75'>75</option>
                        <option value = '80'>80</option>
                        <option value = '85'>85</option>
                        <option value = '90'>90</option>
                        <option value = '95'>95</option>
                        <option value = 'NR'>NR</option>
                      </select>
                      </div>
                      <div class="form-inline" style = 'float: right;'>
                      <label for="l5k">L5k</label>
                      <select type="text" class="form-control hearing-dropdown" name="l5k[]" id="l5k">
                        <option value="">
                        </option>
                        <option value = '25'>25</option>
                        <option value = '30'>30</option>
                        <option value = '35'>35</option>
                        <option value = '40'>40</option>
                        <option value = '45'>45</option>
                        <option value = '50'>50</option>
                        <option value = '55'>55</option>
                        <option value = '60'>60</option>
                        <option value = '65'>65</option>
                        <option value = '70'>70</option>
                        <option value = '75'>75</option>
                        <option value = '80'>80</option>
                        <option value = '85'>85</option>
                        <option value = '90'>90</option>
                        <option value = '95'>95</option>
                        <option value = 'NR'>NR</option>
                      </select>
                      </div>

                    </div>
                   </div>
                   <div class="hearing_line" id="studentLine4" style="margin-left: 40px;">
                   <div class="form-inline">
                   <div class = 'remove' onclick="remove(4)">X</div>
                   <div class = 'pass' onclick = 'pass(4)'>	&#10004;</div>
                   <div class = 'pass' onclick = 'refer(4)'>R</div>
                   <div style="background-color: #e8e5e5; padding: 10px; border-radius: 6px; cursor: pointer;" id="student4name" class="form-inline" onclick="addStudent(4)">
                   <strong>Booth 4</strong>

                 </div>
                   </div>

                    <input type='hidden' name='studentID[]' value= '' id="student4id"/>
                    <div class="form-inline">


                     <div class="form-inline">
                     <label for="r1k">R1k</label>
                     <select type="text" class="form-control hearing-dropdown" onchange="passFilter(this, 4)" name="r1k[]" id="r1k">
                       <option value="">
                       </option>
                       <option value = '25'>25</option>
                       <option value = '30'>30</option>
                       <option value = '35'>35</option>
                       <option value = '40'>40</option>
                       <option value = '45'>45</option>
                       <option value = '50'>50</option>
                       <option value = '55'>55</option>
                       <option value = '60'>60</option>
                       <option value = '65'>65</option>
                       <option value = '70'>70</option>
                       <option value = '75'>75</option>
                       <option value = '80'>80</option>
                       <option value = '85'>85</option>
                       <option value = '90'>90</option>
                       <option value = '95'>95</option>
                       <option value = 'NR'>NR</option>
                     </select>

                     <div class="form-inline">
                     <label for="r2k">R2k</label>
                     <select type="text" class="form-control hearing-dropdown" onchange="passFilter(this, 4)" name="r2k[]" id="r2k">
                       <option value="">
                       </option>
                       <option value = '25'>25</option>
                       <option value = '30'>30</option>
                       <option value = '35'>35</option>
                       <option value = '40'>40</option>
                       <option value = '45'>45</option>
                       <option value = '50'>50</option>
                       <option value = '55'>55</option>
                       <option value = '60'>60</option>
                       <option value = '65'>65</option>
                       <option value = '70'>70</option>
                       <option value = '75'>75</option>
                       <option value = '80'>80</option>
                       <option value = '85'>85</option>
                       <option value = '90'>90</option>
                       <option value = '95'>95</option>
                       <option value = 'NR'>NR</option>
                     </select>
                     </div>
                     <div class="form-inline">
                     <label for="r4k">R4k</label>
                     <select type="text" class="form-control hearing-dropdown" onchange="passFilter(this, 4)" name="r4k[]" id="r4k">
                       <option value="">
                       </option>
                       <option value = '25'>25</option>
                       <option value = '30'>30</option>
                       <option value = '35'>35</option>
                       <option value = '40'>40</option>
                       <option value = '45'>45</option>
                       <option value = '50'>50</option>
                       <option value = '55'>55</option>
                       <option value = '60'>60</option>
                       <option value = '65'>65</option>
                       <option value = '70'>70</option>
                       <option value = '75'>75</option>
                       <option value = '80'>80</option>
                       <option value = '85'>85</option>
                       <option value = '90'>90</option>
                       <option value = '95'>95</option>
                       <option value = 'NR'>NR</option>
                     </select>
                     </div>

                     <div class="form-inline" style="padding-left: 20px;">
                     <label for="l1k">L1k</label>
                     <select type="text" class="form-control hearing-dropdown" onchange="passFilter(this, 4)" name="l1k[]" id="l1k">
                       <option value="">
                       </option>
                       <option value = '25'>25</option>
                       <option value = '30'>30</option>
                       <option value = '35'>35</option>
                       <option value = '40'>40</option>
                       <option value = '45'>45</option>
                       <option value = '50'>50</option>
                       <option value = '55'>55</option>
                       <option value = '60'>60</option>
                       <option value = '65'>65</option>
                       <option value = '70'>70</option>
                       <option value = '75'>75</option>
                       <option value = '80'>80</option>
                       <option value = '85'>85</option>
                       <option value = '90'>90</option>
                       <option value = '95'>95</option>
                       <option value = 'NR'>NR</option>
                     </select>
                   </div>
                     <div class="form-inline">
                     <label for="l2k">L2k</label>
                     <select type="text" class="form-control hearing-dropdown" onchange="passFilter(this, 4)" name="l2k[]" id="l2k">
                       <option value="">
                       </option>
                       <option value = '25'>25</option>
                       <option value = '30'>30</option>
                       <option value = '35'>35</option>
                       <option value = '40'>40</option>
                       <option value = '45'>45</option>
                       <option value = '50'>50</option>
                       <option value = '55'>55</option>
                       <option value = '60'>60</option>
                       <option value = '65'>65</option>
                       <option value = '70'>70</option>
                       <option value = '75'>75</option>
                       <option value = '80'>80</option>
                       <option value = '85'>85</option>
                       <option value = '90'>90</option>
                       <option value = '95'>95</option>
                       <option value = 'NR'>NR</option>
                     </select>
                     </div>
                     <div class="form-inline">
                     <label for="l4k">L4k</label>
                     <select type="text" class="form-control hearing-dropdown" onchange="passFilter(this, 4)" name="l4k[]" id="l4k">
                       <option value="">
                       </option>
                       <option value = '25'>25</option>
                       <option value = '30'>30</option>
                       <option value = '35'>35</option>
                       <option value = '40'>40</option>
                       <option value = '45'>45</option>
                       <option value = '50'>50</option>
                       <option value = '55'>55</option>
                       <option value = '60'>60</option>
                       <option value = '65'>65</option>
                       <option value = '70'>70</option>
                       <option value = '75'>75</option>
                       <option value = '80'>80</option>
                       <option value = '85'>85</option>
                       <option value = '90'>90</option>
                       <option value = '95'>95</option>
                       <option value = 'NR'>NR</option>
                     </select>
                     </div>
                     </div>
                   </div>
                   <div id="extraFreq4" style="visibility: hidden;">

                     <div class="form-inline" style="float: left;">
                    <label for="r5k">R5k</label>
                    <select type="text" class="form-control hearing-dropdown" name="r5k[]" id="r5k">
                      <option value="">
                      </option>
                      <option value = '25'>25</option>
                      <option value = '30'>30</option>
                      <option value = '35'>35</option>
                      <option value = '40'>40</option>
                      <option value = '45'>45</option>
                      <option value = '50'>50</option>
                      <option value = '55'>55</option>
                      <option value = '60'>60</option>
                      <option value = '65'>65</option>
                      <option value = '70'>70</option>
                      <option value = '75'>75</option>
                      <option value = '80'>80</option>
                      <option value = '85'>85</option>
                      <option value = '90'>90</option>
                      <option value = '95'>95</option>
                      <option value = 'NR'>NR</option>
                    </select>
                    </div>
                    <div class="form-inline" style = 'float: right;'>
                    <label for="l5k">L5k</label>
                    <select type="text" class="form-control hearing-dropdown" name="l5k[]" id="l5k">
                      <option value="">
                      </option>
                      <option value = '25'>25</option>
                      <option value = '30'>30</option>
                      <option value = '35'>35</option>
                      <option value = '40'>40</option>
                      <option value = '45'>45</option>
                      <option value = '50'>50</option>
                      <option value = '55'>55</option>
                      <option value = '60'>60</option>
                      <option value = '65'>65</option>
                      <option value = '70'>70</option>
                      <option value = '75'>75</option>
                      <option value = '80'>80</option>
                      <option value = '85'>85</option>
                      <option value = '90'>90</option>
                      <option value = '95'>95</option>
                      <option value = 'NR'>NR</option>
                    </select>
                    </div>

                  </div>
</div>
                 </div>
                 <div class="row">

                 <div class="hearing_line pull-left" id="studentLine5">
                 <div class="form-inline">
                 <div class = 'remove' onclick="remove(5)">X</div>
                 <div class = 'pass' onclick = 'pass(5)'>	&#10004;</div>
                 <div class = 'pass' onclick = 'refer(5)'>R</div>
                 <div style="background-color: #e8e5e5; padding: 10px; border-radius: 6px; cursor: pointer;" id="student5name" class="form-inline" onclick="addStudent(5)">
                 <strong>Booth 5</strong>

               </div>
                 </div>

                  <input type='hidden' name='studentID[]' value= '' id="student5id"/>
                   <div class="form-inline">
                     <div class="form-inline">
                   <label for="r1k">R1k</label>
                   <select type="text" class="form-control hearing-dropdown" onchange="passFilter(this, 5)" name="r1k[]" id="r1k">
                     <option value="">
                     </option>
                     <option value = '25'>25</option>
                     <option value = '30'>30</option>
                     <option value = '35'>35</option>
                     <option value = '40'>40</option>
                     <option value = '45'>45</option>
                     <option value = '50'>50</option>
                     <option value = '55'>55</option>
                     <option value = '60'>60</option>
                     <option value = '65'>65</option>
                     <option value = '70'>70</option>
                     <option value = '75'>75</option>
                     <option value = '80'>80</option>
                     <option value = '85'>85</option>
                     <option value = '90'>90</option>
                     <option value = '95'>95</option>
                     <option value = 'NR'>NR</option>
                   </select>

                   <div class="form-inline">
                   <label for="r2k">R2k</label>
                   <select type="text" class="form-control hearing-dropdown" onchange="passFilter(this, 5)" name="r2k[]" id="r2k">
                     <option value="">
                     </option>
                     <option value = '25'>25</option>
                     <option value = '30'>30</option>
                     <option value = '35'>35</option>
                     <option value = '40'>40</option>
                     <option value = '45'>45</option>
                     <option value = '50'>50</option>
                     <option value = '55'>55</option>
                     <option value = '60'>60</option>
                     <option value = '65'>65</option>
                     <option value = '70'>70</option>
                     <option value = '75'>75</option>
                     <option value = '80'>80</option>
                     <option value = '85'>85</option>
                     <option value = '90'>90</option>
                     <option value = '95'>95</option>
                     <option value = 'NR'>NR</option>
                   </select>
                   </div>
                   <div class="form-inline">
                   <label for="r4k">R4k</label>
                   <select type="text" class="form-control hearing-dropdown" onchange="passFilter(this, 5)" name="r4k[]" id="r4k">
                     <option value="">
                     </option>
                     <option value = '25'>25</option>
                     <option value = '30'>30</option>
                     <option value = '35'>35</option>
                     <option value = '40'>40</option>
                     <option value = '45'>45</option>
                     <option value = '50'>50</option>
                     <option value = '55'>55</option>
                     <option value = '60'>60</option>
                     <option value = '65'>65</option>
                     <option value = '70'>70</option>
                     <option value = '75'>75</option>
                     <option value = '80'>80</option>
                     <option value = '85'>85</option>
                     <option value = '90'>90</option>
                     <option value = '95'>95</option>
                     <option value = 'NR'>NR</option>
                   </select>
                   </div>

                   <div class="form-inline" style="padding-left: 20px;">
                   <label for="l1k">L1k</label>
                   <select type="text" class="form-control hearing-dropdown" onchange="passFilter(this, 5)" name="l1k[]" id="l1k">
                     <option value="">
                     </option>
                     <option value = '25'>25</option>
                     <option value = '30'>30</option>
                     <option value = '35'>35</option>
                     <option value = '40'>40</option>
                     <option value = '45'>45</option>
                     <option value = '50'>50</option>
                     <option value = '55'>55</option>
                     <option value = '60'>60</option>
                     <option value = '65'>65</option>
                     <option value = '70'>70</option>
                     <option value = '75'>75</option>
                     <option value = '80'>80</option>
                     <option value = '85'>85</option>
                     <option value = '90'>90</option>
                     <option value = '95'>95</option>
                     <option value = 'NR'>NR</option>
                   </select>
                 </div>
                   <div class="form-inline">
                   <label for="l2k">L2k</label>
                   <select type="text" class="form-control hearing-dropdown" onchange="passFilter(this, 5)" name="l2k[]" id="l2k">
                     <option value="">
                     </option>
                     <option value = '25'>25</option>
                     <option value = '30'>30</option>
                     <option value = '35'>35</option>
                     <option value = '40'>40</option>
                     <option value = '45'>45</option>
                     <option value = '50'>50</option>
                     <option value = '55'>55</option>
                     <option value = '60'>60</option>
                     <option value = '65'>65</option>
                     <option value = '70'>70</option>
                     <option value = '75'>75</option>
                     <option value = '80'>80</option>
                     <option value = '85'>85</option>
                     <option value = '90'>90</option>
                     <option value = '95'>95</option>
                     <option value = 'NR'>NR</option>
                   </select>
                   </div>
                   <div class="form-inline">
                   <label for="l4k">L4k</label>
                   <select type="text" class="form-control hearing-dropdown" onchange="passFilter(this, 5)" name="l4k[]" id="l4k">
                     <option value="">
                     </option>
                     <option value = '25'>25</option>
                     <option value = '30'>30</option>
                     <option value = '35'>35</option>
                     <option value = '40'>40</option>
                     <option value = '45'>45</option>
                     <option value = '50'>50</option>
                     <option value = '55'>55</option>
                     <option value = '60'>60</option>
                     <option value = '65'>65</option>
                     <option value = '70'>70</option>
                     <option value = '75'>75</option>
                     <option value = '80'>80</option>
                     <option value = '85'>85</option>
                     <option value = '90'>90</option>
                     <option value = '95'>95</option>
                     <option value = 'NR'>NR</option>
                   </select>
                   </div>
                   </div>

                 </div>
                 <div id="extraFreq5" style="visibility: hidden;">

                   <div class="form-inline" style="float: left;">
                  <label for="r5k">R5k</label>
                  <select type="text" class="form-control hearing-dropdown" name="r5k[]" id="r5k">
                    <option value="">
                    </option>
                    <option value = '25'>25</option>
                    <option value = '30'>30</option>
                    <option value = '35'>35</option>
                    <option value = '40'>40</option>
                    <option value = '45'>45</option>
                    <option value = '50'>50</option>
                    <option value = '55'>55</option>
                    <option value = '60'>60</option>
                    <option value = '65'>65</option>
                    <option value = '70'>70</option>
                    <option value = '75'>75</option>
                    <option value = '80'>80</option>
                    <option value = '85'>85</option>
                    <option value = '90'>90</option>
                    <option value = '95'>95</option>
                    <option value = 'NR'>NR</option>
                  </select>
                  </div>
                  <div class="form-inline" style = 'float: right;'>
                  <label for="l5k">L5k</label>
                  <select type="text" class="form-control hearing-dropdown" name="l5k[]" id="l5k">
                    <option value="">
                    </option>
                    <option value = '25'>25</option>
                    <option value = '30'>30</option>
                    <option value = '35'>35</option>
                    <option value = '40'>40</option>
                    <option value = '45'>45</option>
                    <option value = '50'>50</option>
                    <option value = '55'>55</option>
                    <option value = '60'>60</option>
                    <option value = '65'>65</option>
                    <option value = '70'>70</option>
                    <option value = '75'>75</option>
                    <option value = '80'>80</option>
                    <option value = '85'>85</option>
                    <option value = '90'>90</option>
                    <option value = '95'>95</option>
                    <option value = 'NR'>NR</option>
                  </select>
                  </div>

                </div>
                 </div>
                 <div class="hearing_line" id="studentLine6" style="margin-left: 40px;">
                 <div class="form-inline">
                 <div class = 'remove' onclick="remove(6)">X</div>
                 <div class = 'pass' onclick = 'pass(6)'>	&#10004;</div>
                 <div class = 'pass' onclick = 'refer(6)'>R</div>
                 <div style="background-color: #e8e5e5; padding: 10px; border-radius: 6px; cursor: pointer;" id="student6name" class="form-inline" onclick="addStudent(6)">
                 <strong>Booth 6</strong>

               </div>
                 </div>

                  <input type='hidden' name='studentID[]' value= '' id="student6id"/>
                  <div class="form-inline">
                   <div class="form-inline">
                   <label for="r1k">R1k</label>
                   <select type="text" class="form-control hearing-dropdown" onchange="passFilter(this, 6)" name="r1k[]" id="r1k">
                     <option value="">
                     </option>
                     <option value = '25'>25</option>
                     <option value = '30'>30</option>
                     <option value = '35'>35</option>
                     <option value = '40'>40</option>
                     <option value = '45'>45</option>
                     <option value = '50'>50</option>
                     <option value = '55'>55</option>
                     <option value = '60'>60</option>
                     <option value = '65'>65</option>
                     <option value = '70'>70</option>
                     <option value = '75'>75</option>
                     <option value = '80'>80</option>
                     <option value = '85'>85</option>
                     <option value = '90'>90</option>
                     <option value = '95'>95</option>
                     <option value = 'NR'>NR</option>
                   </select>

                   <div class="form-inline">
                   <label for="r2k">R2k</label>
                   <select type="text" class="form-control hearing-dropdown" onchange="passFilter(this, 6)" name="r2k[]" id="r2k">
                     <option value="">
                     </option>
                     <option value = '25'>25</option>
                     <option value = '30'>30</option>
                     <option value = '35'>35</option>
                     <option value = '40'>40</option>
                     <option value = '45'>45</option>
                     <option value = '50'>50</option>
                     <option value = '55'>55</option>
                     <option value = '60'>60</option>
                     <option value = '65'>65</option>
                     <option value = '70'>70</option>
                     <option value = '75'>75</option>
                     <option value = '80'>80</option>
                     <option value = '85'>85</option>
                     <option value = '90'>90</option>
                     <option value = '95'>95</option>
                     <option value = 'NR'>NR</option>
                   </select>
                   </div>
                   <div class="form-inline">
                   <label for="r4k">R4k</label>
                   <select type="text" class="form-control hearing-dropdown" onchange="passFilter(this, 6)" name="r4k[]" id="r4k">
                     <option value="">
                     </option>
                     <option value = '25'>25</option>
                     <option value = '30'>30</option>
                     <option value = '35'>35</option>
                     <option value = '40'>40</option>
                     <option value = '45'>45</option>
                     <option value = '50'>50</option>
                     <option value = '55'>55</option>
                     <option value = '60'>60</option>
                     <option value = '65'>65</option>
                     <option value = '70'>70</option>
                     <option value = '75'>75</option>
                     <option value = '80'>80</option>
                     <option value = '85'>85</option>
                     <option value = '90'>90</option>
                     <option value = '95'>95</option>
                     <option value = 'NR'>NR</option>
                   </select>
                   </div>

                   <div class="form-inline" style="padding-left: 20px;">
                   <label for="l1k">L1k</label>
                   <select type="text" class="form-control hearing-dropdown" onchange="passFilter(this, 6)" name="l1k[]" id="l1k">
                     <option value="">
                     </option>
                     <option value = '25'>25</option>
                     <option value = '30'>30</option>
                     <option value = '35'>35</option>
                     <option value = '40'>40</option>
                     <option value = '45'>45</option>
                     <option value = '50'>50</option>
                     <option value = '55'>55</option>
                     <option value = '60'>60</option>
                     <option value = '65'>65</option>
                     <option value = '70'>70</option>
                     <option value = '75'>75</option>
                     <option value = '80'>80</option>
                     <option value = '85'>85</option>
                     <option value = '90'>90</option>
                     <option value = '95'>95</option>
                     <option value = 'NR'>NR</option>
                   </select>
                 </div>
                   <div class="form-inline">
                   <label for="l2k">L2k</label>
                   <select type="text" class="form-control hearing-dropdown" onchange="passFilter(this, 6)" name="l2k[]" id="l2k">
                     <option value="">
                     </option>
                     <option value = '25'>25</option>
                     <option value = '30'>30</option>
                     <option value = '35'>35</option>
                     <option value = '40'>40</option>
                     <option value = '45'>45</option>
                     <option value = '50'>50</option>
                     <option value = '55'>55</option>
                     <option value = '60'>60</option>
                     <option value = '65'>65</option>
                     <option value = '70'>70</option>
                     <option value = '75'>75</option>
                     <option value = '80'>80</option>
                     <option value = '85'>85</option>
                     <option value = '90'>90</option>
                     <option value = '95'>95</option>
                     <option value = 'NR'>NR</option>
                   </select>
                   </div>
                   <div class="form-inline">
                   <label for="l4k">L4k</label>
                   <select type="text" class="form-control hearing-dropdown" onchange="passFilter(this, 6)" name="l4k[]" id="l4k">
                     <option value="">
                     </option>
                     <option value = '25'>25</option>
                     <option value = '30'>30</option>
                     <option value = '35'>35</option>
                     <option value = '40'>40</option>
                     <option value = '45'>45</option>
                     <option value = '50'>50</option>
                     <option value = '55'>55</option>
                     <option value = '60'>60</option>
                     <option value = '65'>65</option>
                     <option value = '70'>70</option>
                     <option value = '75'>75</option>
                     <option value = '80'>80</option>
                     <option value = '85'>85</option>
                     <option value = '90'>90</option>
                     <option value = '95'>95</option>
                     <option value = 'NR'>NR</option>
                   </select>
                   </div>
                   </div>
                 </div>
                 <div id="extraFreq6" style="visibility: hidden;">

                   <div class="form-inline" style="float: left;">
                  <label for="r5k">R5k</label>
                  <select type="text" class="form-control hearing-dropdown" name="r5k[]" id="r5k">
                    <option value="">
                    </option>
                    <option value = '25'>25</option>
                    <option value = '30'>30</option>
                    <option value = '35'>35</option>
                    <option value = '40'>40</option>
                    <option value = '45'>45</option>
                    <option value = '50'>50</option>
                    <option value = '55'>55</option>
                    <option value = '60'>60</option>
                    <option value = '65'>65</option>
                    <option value = '70'>70</option>
                    <option value = '75'>75</option>
                    <option value = '80'>80</option>
                    <option value = '85'>85</option>
                    <option value = '90'>90</option>
                    <option value = '95'>95</option>
                    <option value = 'NR'>NR</option>
                  </select>
                  </div>
                  <div class="form-inline" style = 'float: right;'>
                  <label for="l5k">L5k</label>
                  <select type="text" class="form-control hearing-dropdown" name="l5k[]" id="l5k">
                    <option value="">
                    </option>
                    <option value = '25'>25</option>
                    <option value = '30'>30</option>
                    <option value = '35'>35</option>
                    <option value = '40'>40</option>
                    <option value = '45'>45</option>
                    <option value = '50'>50</option>
                    <option value = '55'>55</option>
                    <option value = '60'>60</option>
                    <option value = '65'>65</option>
                    <option value = '70'>70</option>
                    <option value = '75'>75</option>
                    <option value = '80'>80</option>
                    <option value = '85'>85</option>
                    <option value = '90'>90</option>
                    <option value = '95'>95</option>
                    <option value = 'NR'>NR</option>
                  </select>
                  </div>

                </div>
</div>
               </div>
               <div class="row">

               <div class="hearing_line pull-left" id="studentLine7">
               <div class="form-inline">
               <div class = 'remove' onclick="remove(7)">X</div>
               <div class = 'pass' onclick = 'pass(7)'>	&#10004;</div>
               <div class = 'pass' onclick = 'refer(7)'>R</div>
               <div style="background-color: #e8e5e5; padding: 10px; border-radius: 6px; cursor: pointer;" id="student7name" class="form-inline" onclick="addStudent(7)">
               <strong>Booth 7</strong>

             </div>
               </div>

                <input type='hidden' name='studentID[]' value= ''  id="student7id"/>
                <div class="form-inline">
                 <div class="form-inline">
                 <label for="r1k">R1k</label>
                 <select type="text" class="form-control hearing-dropdown" onchange="passFilter(this, 7)" name="r1k[]" id="r1k">
                   <option value="">
                   </option>
                   <option value = '25'>25</option>
                   <option value = '30'>30</option>
                   <option value = '35'>35</option>
                   <option value = '40'>40</option>
                   <option value = '45'>45</option>
                   <option value = '50'>50</option>
                   <option value = '55'>55</option>
                   <option value = '60'>60</option>
                   <option value = '65'>65</option>
                   <option value = '70'>70</option>
                   <option value = '75'>75</option>
                   <option value = '80'>80</option>
                   <option value = '85'>85</option>
                   <option value = '90'>90</option>
                   <option value = '95'>95</option>
                   <option value = 'NR'>NR</option>
                 </select>

                 <div class="form-inline">
                 <label for="r2k">R2k</label>
                 <select type="text" class="form-control hearing-dropdown" onchange="passFilter(this, 7)" name="r2k[]" id="r2k">
                   <option value="">
                   </option>
                   <option value = '25'>25</option>
                   <option value = '30'>30</option>
                   <option value = '35'>35</option>
                   <option value = '40'>40</option>
                   <option value = '45'>45</option>
                   <option value = '50'>50</option>
                   <option value = '55'>55</option>
                   <option value = '60'>60</option>
                   <option value = '65'>65</option>
                   <option value = '70'>70</option>
                   <option value = '75'>75</option>
                   <option value = '80'>80</option>
                   <option value = '85'>85</option>
                   <option value = '90'>90</option>
                   <option value = '95'>95</option>
                   <option value = 'NR'>NR</option>
                 </select>
                 </div>
                 <div class="form-inline">
                 <label for="r4k">R4k</label>
                 <select type="text" class="form-control hearing-dropdown" onchange="passFilter(this, 7)" name="r4k[]" id="r4k">
                   <option value="">
                   </option>
                   <option value = '25'>25</option>
                   <option value = '30'>30</option>
                   <option value = '35'>35</option>
                   <option value = '40'>40</option>
                   <option value = '45'>45</option>
                   <option value = '50'>50</option>
                   <option value = '55'>55</option>
                   <option value = '60'>60</option>
                   <option value = '65'>65</option>
                   <option value = '70'>70</option>
                   <option value = '75'>75</option>
                   <option value = '80'>80</option>
                   <option value = '85'>85</option>
                   <option value = '90'>90</option>
                   <option value = '95'>95</option>
                   <option value = 'NR'>NR</option>
                 </select>
                 </div>

                 <div class="form-inline" style="padding-left: 20px;">
                 <label for="l1k">L1k</label>
                 <select type="text" class="form-control hearing-dropdown" onchange="passFilter(this, 7)" name="l1k[]" id="l1k">
                   <option value="">
                   </option>
                   <option value = '25'>25</option>
                   <option value = '30'>30</option>
                   <option value = '35'>35</option>
                   <option value = '40'>40</option>
                   <option value = '45'>45</option>
                   <option value = '50'>50</option>
                   <option value = '55'>55</option>
                   <option value = '60'>60</option>
                   <option value = '65'>65</option>
                   <option value = '70'>70</option>
                   <option value = '75'>75</option>
                   <option value = '80'>80</option>
                   <option value = '85'>85</option>
                   <option value = '90'>90</option>
                   <option value = '95'>95</option>
                   <option value = 'NR'>NR</option>
                 </select>
               </div>
                 <div class="form-inline">
                 <label for="l2k">L2k</label>
                 <select type="text" class="form-control hearing-dropdown" onchange="passFilter(this, 7)" name="l2k[]" id="l2k">
                   <option value="">
                   </option>
                   <option value = '25'>25</option>
                   <option value = '30'>30</option>
                   <option value = '35'>35</option>
                   <option value = '40'>40</option>
                   <option value = '45'>45</option>
                   <option value = '50'>50</option>
                   <option value = '55'>55</option>
                   <option value = '60'>60</option>
                   <option value = '65'>65</option>
                   <option value = '70'>70</option>
                   <option value = '75'>75</option>
                   <option value = '80'>80</option>
                   <option value = '85'>85</option>
                   <option value = '90'>90</option>
                   <option value = '95'>95</option>
                   <option value = 'NR'>NR</option>
                 </select>
                 </div>
                 <div class="form-inline">
                 <label for="l4k">L4k</label>
                 <select type="text" class="form-control hearing-dropdown" onchange="passFilter(this, 7)" name="l4k[]" id="l4k">
                   <option value="">
                   </option>
                   <option value = '25'>25</option>
                   <option value = '30'>30</option>
                   <option value = '35'>35</option>
                   <option value = '40'>40</option>
                   <option value = '45'>45</option>
                   <option value = '50'>50</option>
                   <option value = '55'>55</option>
                   <option value = '60'>60</option>
                   <option value = '65'>65</option>
                   <option value = '70'>70</option>
                   <option value = '75'>75</option>
                   <option value = '80'>80</option>
                   <option value = '85'>85</option>
                   <option value = '90'>90</option>
                   <option value = '95'>95</option>
                   <option value = 'NR'>NR</option>
                 </select>
                 </div>
                 </div>

               </div>
               <div id="extraFreq7" style="visibility: hidden;">

                 <div class="form-inline" style="float: left;">
                <label for="r5k">R5k</label>
                <select type="text" class="form-control hearing-dropdown" name="r5k[]" id="r5k">
                  <option value="">
                  </option>
                  <option value = '25'>25</option>
                  <option value = '30'>30</option>
                  <option value = '35'>35</option>
                  <option value = '40'>40</option>
                  <option value = '45'>45</option>
                  <option value = '50'>50</option>
                  <option value = '55'>55</option>
                  <option value = '60'>60</option>
                  <option value = '65'>65</option>
                  <option value = '70'>70</option>
                  <option value = '75'>75</option>
                  <option value = '80'>80</option>
                  <option value = '85'>85</option>
                  <option value = '90'>90</option>
                  <option value = '95'>95</option>
                  <option value = 'NR'>NR</option>
                </select>
                </div>
                <div class="form-inline" style = 'float: right;'>
                <label for="l5k">L5k</label>
                <select type="text" class="form-control hearing-dropdown" name="l5k[]" id="l5k">
                  <option value="">
                  </option>
                  <option value = '25'>25</option>
                  <option value = '30'>30</option>
                  <option value = '35'>35</option>
                  <option value = '40'>40</option>
                  <option value = '45'>45</option>
                  <option value = '50'>50</option>
                  <option value = '55'>55</option>
                  <option value = '60'>60</option>
                  <option value = '65'>65</option>
                  <option value = '70'>70</option>
                  <option value = '75'>75</option>
                  <option value = '80'>80</option>
                  <option value = '85'>85</option>
                  <option value = '90'>90</option>
                  <option value = '95'>95</option>
                  <option value = 'NR'>NR</option>
                </select>
                </div>

              </div>
               </div>
               <div class="hearing_line" id="studentLine8" style="margin-left: 40px;">
               <div class="form-inline">
               <div class = 'remove' onclick="remove(8)">X</div>
               <div class = 'pass' onclick = 'pass(8)'>	&#10004;</div>
               <div class = 'pass' onclick = 'refer(8)'>R</div>
               <div style="background-color: #e8e5e5; padding: 10px; border-radius: 6px; cursor: pointer;" id="student8name" class="form-inline" onclick="addStudent(8)">
               <strong>Booth 8</strong>

             </div>
               </div>

                <input type='hidden' name='studentID[]' value= '' id="student8id"/>
                <div class="form-inline">
                 <div class="form-inline">
                 <label for="r1k">R1k</label>
                 <select type="text" class="form-control hearing-dropdown" onchange="passFilter(this, 8)" name="r1k[]" id="r1k">
                   <option value="">
                   </option>
                   <option value = '25'>25</option>
                   <option value = '30'>30</option>
                   <option value = '35'>35</option>
                   <option value = '40'>40</option>
                   <option value = '45'>45</option>
                   <option value = '50'>50</option>
                   <option value = '55'>55</option>
                   <option value = '60'>60</option>
                   <option value = '65'>65</option>
                   <option value = '70'>70</option>
                   <option value = '75'>75</option>
                   <option value = '80'>80</option>
                   <option value = '85'>85</option>
                   <option value = '90'>90</option>
                   <option value = '95'>95</option>
                   <option value = 'NR'>NR</option>
                 </select>

                 <div class="form-inline">
                 <label for="r2k">R2k</label>
                 <select type="text" class="form-control hearing-dropdown" onchange="passFilter(this, 8)" name="r2k[]" id="r2k">
                   <option value="">
                   </option>
                   <option value = '25'>25</option>
                   <option value = '30'>30</option>
                   <option value = '35'>35</option>
                   <option value = '40'>40</option>
                   <option value = '45'>45</option>
                   <option value = '50'>50</option>
                   <option value = '55'>55</option>
                   <option value = '60'>60</option>
                   <option value = '65'>65</option>
                   <option value = '70'>70</option>
                   <option value = '75'>75</option>
                   <option value = '80'>80</option>
                   <option value = '85'>85</option>
                   <option value = '90'>90</option>
                   <option value = '95'>95</option>
                   <option value = 'NR'>NR</option>
                 </select>
                 </div>
                 <div class="form-inline">
                 <label for="r4k">R4k</label>
                 <select type="text" class="form-control hearing-dropdown" onchange="passFilter(this, 8)" name="r4k[]" id="r4k">
                   <option value="">
                   </option>
                   <option value = '25'>25</option>
                   <option value = '30'>30</option>
                   <option value = '35'>35</option>
                   <option value = '40'>40</option>
                   <option value = '45'>45</option>
                   <option value = '50'>50</option>
                   <option value = '55'>55</option>
                   <option value = '60'>60</option>
                   <option value = '65'>65</option>
                   <option value = '70'>70</option>
                   <option value = '75'>75</option>
                   <option value = '80'>80</option>
                   <option value = '85'>85</option>
                   <option value = '90'>90</option>
                   <option value = '95'>95</option>
                   <option value = 'NR'>NR</option>
                 </select>
                 </div>

                 <div class="form-inline" style="padding-left: 20px;">
                 <label for="l1k">L1k</label>
                 <select type="text" class="form-control hearing-dropdown" onchange="passFilter(this, 8)" name="l1k[]" id="l1k">
                   <option value="">
                   </option>
                   <option value = '25'>25</option>
                   <option value = '30'>30</option>
                   <option value = '35'>35</option>
                   <option value = '40'>40</option>
                   <option value = '45'>45</option>
                   <option value = '50'>50</option>
                   <option value = '55'>55</option>
                   <option value = '60'>60</option>
                   <option value = '65'>65</option>
                   <option value = '70'>70</option>
                   <option value = '75'>75</option>
                   <option value = '80'>80</option>
                   <option value = '85'>85</option>
                   <option value = '90'>90</option>
                   <option value = '95'>95</option>
                   <option value = 'NR'>NR</option>
                 </select>
               </div>
                 <div class="form-inline">
                 <label for="l2k">L2k</label>
                 <select type="text" class="form-control hearing-dropdown" onchange="passFilter(this, 8)" name="l2k[]" id="l2k">
                   <option value="">
                   </option>
                   <option value = '25'>25</option>
                   <option value = '30'>30</option>
                   <option value = '35'>35</option>
                   <option value = '40'>40</option>
                   <option value = '45'>45</option>
                   <option value = '50'>50</option>
                   <option value = '55'>55</option>
                   <option value = '60'>60</option>
                   <option value = '65'>65</option>
                   <option value = '70'>70</option>
                   <option value = '75'>75</option>
                   <option value = '80'>80</option>
                   <option value = '85'>85</option>
                   <option value = '90'>90</option>
                   <option value = '95'>95</option>
                   <option value = 'NR'>NR</option>
                 </select>
                 </div>
                 <div class="form-inline">
                 <label for="l4k">L4k</label>
                 <select type="text" class="form-control hearing-dropdown" onchange="passFilter(this, 8)" name="l4k[]" id="l4k">
                   <option value="">
                   </option>
                   <option value = '25'>25</option>
                   <option value = '30'>30</option>
                   <option value = '35'>35</option>
                   <option value = '40'>40</option>
                   <option value = '45'>45</option>
                   <option value = '50'>50</option>
                   <option value = '55'>55</option>
                   <option value = '60'>60</option>
                   <option value = '65'>65</option>
                   <option value = '70'>70</option>
                   <option value = '75'>75</option>
                   <option value = '80'>80</option>
                   <option value = '85'>85</option>
                   <option value = '90'>90</option>
                   <option value = '95'>95</option>
                   <option value = 'NR'>NR</option>
                 </select>
                 </div>
                 </div>
               </div>
               <div id="extraFreq8" style="visibility: hidden;">

                 <div class="form-inline" style="float: left;">
                <label for="r5k">R5k</label>
                <select type="text" class="form-control hearing-dropdown" name="r5k[]" id="r5k">
                  <option value="">
                  </option>
                  <option value = '25'>25</option>
                  <option value = '30'>30</option>
                  <option value = '35'>35</option>
                  <option value = '40'>40</option>
                  <option value = '45'>45</option>
                  <option value = '50'>50</option>
                  <option value = '55'>55</option>
                  <option value = '60'>60</option>
                  <option value = '65'>65</option>
                  <option value = '70'>70</option>
                  <option value = '75'>75</option>
                  <option value = '80'>80</option>
                  <option value = '85'>85</option>
                  <option value = '90'>90</option>
                  <option value = '95'>95</option>
                  <option value = 'NR'>NR</option>
                </select>
                </div>
                <div class="form-inline" style = 'float: right;'>
                <label for="l5k">L5k</label>
                <select type="text" class="form-control hearing-dropdown" name="l5k[]" id="l5k">
                  <option value="">
                  </option>
                  <option value = '25'>25</option>
                  <option value = '30'>30</option>
                  <option value = '35'>35</option>
                  <option value = '40'>40</option>
                  <option value = '45'>45</option>
                  <option value = '50'>50</option>
                  <option value = '55'>55</option>
                  <option value = '60'>60</option>
                  <option value = '65'>65</option>
                  <option value = '70'>70</option>
                  <option value = '75'>75</option>
                  <option value = '80'>80</option>
                  <option value = '85'>85</option>
                  <option value = '90'>90</option>
                  <option value = '95'>95</option>
                  <option value = 'NR'>NR</option>
                </select>
                </div>

              </div>
</div>
             </div>
             <div class="row">

             <div class="hearing_line pull-left" id="studentLine9">
             <div class="form-inline">
             <div class = 'remove' onclick="remove(9)">X</div>
             <div class = 'pass' onclick = 'pass(9)'>	&#10004;</div>
             <div class = 'pass' onclick = 'refer(9)'>R</div>
             <div style="background-color: #e8e5e5; padding: 10px; border-radius: 6px; cursor: pointer; cursor: pointer;" id="student9name" class="form-inline" onclick="addStudent(9)">
             <strong>Booth 9</strong>

           </div>
             </div>

              <input type='hidden' name='studentID[]' value= '' id="student9id" />
              <div class="form-inline">
               <div class="form-inline">
               <label for="r1k">R1k</label>
               <select type="text" class="form-control hearing-dropdown" onchange="passFilter(this, 9)" name="r1k[]" id="r1k">
                 <option value="">
                 </option>
                 <option value = '25'>25</option>
                 <option value = '30'>30</option>
                 <option value = '35'>35</option>
                 <option value = '40'>40</option>
                 <option value = '45'>45</option>
                 <option value = '50'>50</option>
                 <option value = '55'>55</option>
                 <option value = '60'>60</option>
                 <option value = '65'>65</option>
                 <option value = '70'>70</option>
                 <option value = '75'>75</option>
                 <option value = '80'>80</option>
                 <option value = '85'>85</option>
                 <option value = '90'>90</option>
                 <option value = '95'>95</option>
                 <option value = 'NR'>NR</option>
               </select>

               <div class="form-inline">
               <label for="r2k">R2k</label>
               <select type="text" class="form-control hearing-dropdown" onchange="passFilter(this, 9)" name="r2k[]" id="r2k">
                 <option value="">
                 </option>
                 <option value = '25'>25</option>
                 <option value = '30'>30</option>
                 <option value = '35'>35</option>
                 <option value = '40'>40</option>
                 <option value = '45'>45</option>
                 <option value = '50'>50</option>
                 <option value = '55'>55</option>
                 <option value = '60'>60</option>
                 <option value = '65'>65</option>
                 <option value = '70'>70</option>
                 <option value = '75'>75</option>
                 <option value = '80'>80</option>
                 <option value = '85'>85</option>
                 <option value = '90'>90</option>
                 <option value = '95'>95</option>
                 <option value = 'NR'>NR</option>
               </select>
               </div>
               <div class="form-inline">
               <label for="r4k">R4k</label>
               <select type="text" class="form-control hearing-dropdown" onchange="passFilter(this, 9)" name="r4k[]" id="r4k">
                 <option value="">
                 </option>
                 <option value = '25'>25</option>
                 <option value = '30'>30</option>
                 <option value = '35'>35</option>
                 <option value = '40'>40</option>
                 <option value = '45'>45</option>
                 <option value = '50'>50</option>
                 <option value = '55'>55</option>
                 <option value = '60'>60</option>
                 <option value = '65'>65</option>
                 <option value = '70'>70</option>
                 <option value = '75'>75</option>
                 <option value = '80'>80</option>
                 <option value = '85'>85</option>
                 <option value = '90'>90</option>
                 <option value = '95'>95</option>
                 <option value = 'NR'>NR</option>
               </select>
               </div>

               <div class="form-inline" style="padding-left: 20px;">
               <label for="l1k">L1k</label>
               <select type="text" class="form-control hearing-dropdown" onchange="passFilter(this, 9)" name="l1k[]" id="l1k">
                 <option value="">
                 </option>
                 <option value = '25'>25</option>
                 <option value = '30'>30</option>
                 <option value = '35'>35</option>
                 <option value = '40'>40</option>
                 <option value = '45'>45</option>
                 <option value = '50'>50</option>
                 <option value = '55'>55</option>
                 <option value = '60'>60</option>
                 <option value = '65'>65</option>
                 <option value = '70'>70</option>
                 <option value = '75'>75</option>
                 <option value = '80'>80</option>
                 <option value = '85'>85</option>
                 <option value = '90'>90</option>
                 <option value = '95'>95</option>
                 <option value = 'NR'>NR</option>
               </select>
             </div>
               <div class="form-inline">
               <label for="l2k">L2k</label>
               <select type="text" class="form-control hearing-dropdown" onchange="passFilter(this, 9)" name="l2k[]" id="l2k">
                 <option value="">
                 </option>
                 <option value = '25'>25</option>
                 <option value = '30'>30</option>
                 <option value = '35'>35</option>
                 <option value = '40'>40</option>
                 <option value = '45'>45</option>
                 <option value = '50'>50</option>
                 <option value = '55'>55</option>
                 <option value = '60'>60</option>
                 <option value = '65'>65</option>
                 <option value = '70'>70</option>
                 <option value = '75'>75</option>
                 <option value = '80'>80</option>
                 <option value = '85'>85</option>
                 <option value = '90'>90</option>
                 <option value = '95'>95</option>
                 <option value = 'NR'>NR</option>
               </select>
               </div>
               <div class="form-inline">
               <label for="l4k">L4k</label>
               <select type="text" class="form-control hearing-dropdown" onchange="passFilter(this, 9)" name="l4k[]" id="l4k">
                 <option value="">
                 </option>
                 <option value = '25'>25</option>
                 <option value = '30'>30</option>
                 <option value = '35'>35</option>
                 <option value = '40'>40</option>
                 <option value = '45'>45</option>
                 <option value = '50'>50</option>
                 <option value = '55'>55</option>
                 <option value = '60'>60</option>
                 <option value = '65'>65</option>
                 <option value = '70'>70</option>
                 <option value = '75'>75</option>
                 <option value = '80'>80</option>
                 <option value = '85'>85</option>
                 <option value = '90'>90</option>
                 <option value = '95'>95</option>
                 <option value = 'NR'>NR</option>
               </select>
               </div>
               </div>
             </div>
             <div id="extraFreq9" style="visibility: hidden;">

               <div class="form-inline" style="float: left;">
              <label for="r5k">R5k</label>
              <select type="text" class="form-control hearing-dropdown" name="r5k[]" id="r5k">
                <option value="">
                </option>
                <option value = '25'>25</option>
                <option value = '30'>30</option>
                <option value = '35'>35</option>
                <option value = '40'>40</option>
                <option value = '45'>45</option>
                <option value = '50'>50</option>
                <option value = '55'>55</option>
                <option value = '60'>60</option>
                <option value = '65'>65</option>
                <option value = '70'>70</option>
                <option value = '75'>75</option>
                <option value = '80'>80</option>
                <option value = '85'>85</option>
                <option value = '90'>90</option>
                <option value = '95'>95</option>
                <option value = 'NR'>NR</option>
              </select>
              </div>
              <div class="form-inline" style = 'float: right;'>
              <label for="l5k">L5k</label>
              <select type="text" class="form-control hearing-dropdown" name="l5k[]" id="l5k">
                <option value="">
                </option>
                <option value = '25'>25</option>
                <option value = '30'>30</option>
                <option value = '35'>35</option>
                <option value = '40'>40</option>
                <option value = '45'>45</option>
                <option value = '50'>50</option>
                <option value = '55'>55</option>
                <option value = '60'>60</option>
                <option value = '65'>65</option>
                <option value = '70'>70</option>
                <option value = '75'>75</option>
                <option value = '80'>80</option>
                <option value = '85'>85</option>
                <option value = '90'>90</option>
                <option value = '95'>95</option>
                <option value = 'NR'>NR</option>
              </select>
              </div>

            </div>
             </div>
             <div class="hearing_line" id="studentLine10" style="margin-left: 40px;">
             <div class="form-inline">
             <div class = 'remove' onclick="remove(10)">X</div>
             <div class = 'pass' onclick = 'pass(10)'>	&#10004;</div>
             <div class = 'pass' onclick = 'refer(10)'>R</div>
             <div style="background-color: #e8e5e5; padding: 10px; border-radius: 6px; cursor: pointer;" id="student10name" class="form-inline" onclick="addStudent(10)">
             <strong>Booth 10</strong>

           </div>
             </div>

              <input type='hidden' name='studentID[]' value= ''  id="student10id"/>
              <div class="form-inline">
               <div class="form-inline">
               <label for="r1k">R1k</label>
               <select type="text" class="form-control hearing-dropdown" onchange="passFilter(this, 10)" name="r1k[]" id="r1k">
                 <option value="">
                 </option>
                 <option value = '25'>25</option>
                 <option value = '30'>30</option>
                 <option value = '35'>35</option>
                 <option value = '40'>40</option>
                 <option value = '45'>45</option>
                 <option value = '50'>50</option>
                 <option value = '55'>55</option>
                 <option value = '60'>60</option>
                 <option value = '65'>65</option>
                 <option value = '70'>70</option>
                 <option value = '75'>75</option>
                 <option value = '80'>80</option>
                 <option value = '85'>85</option>
                 <option value = '90'>90</option>
                 <option value = '95'>95</option>
                 <option value = 'NR'>NR</option>
               </select>


               <div class="form-inline">
               <label for="r2k">R2k</label>
               <select type="text" class="form-control hearing-dropdown" onchange="passFilter(this, 10)" name="r2k[]" id="r2k">
                 <option value="">
                 </option>
                 <option value = '25'>25</option>
                 <option value = '30'>30</option>
                 <option value = '35'>35</option>
                 <option value = '40'>40</option>
                 <option value = '45'>45</option>
                 <option value = '50'>50</option>
                 <option value = '55'>55</option>
                 <option value = '60'>60</option>
                 <option value = '65'>65</option>
                 <option value = '70'>70</option>
                 <option value = '75'>75</option>
                 <option value = '80'>80</option>
                 <option value = '85'>85</option>
                 <option value = '90'>90</option>
                 <option value = '95'>95</option>
                 <option value = 'NR'>NR</option>
               </select>
               </div>
               <div class="form-inline">
               <label for="r4k">R4k</label>
               <select type="text" class="form-control hearing-dropdown" onchange="passFilter(this, 10)" name="r4k[]" id="r4k">
                 <option value="">
                 </option>
                 <option value = '25'>25</option>
                 <option value = '30'>30</option>
                 <option value = '35'>35</option>
                 <option value = '40'>40</option>
                 <option value = '45'>45</option>
                 <option value = '50'>50</option>
                 <option value = '55'>55</option>
                 <option value = '60'>60</option>
                 <option value = '65'>65</option>
                 <option value = '70'>70</option>
                 <option value = '75'>75</option>
                 <option value = '80'>80</option>
                 <option value = '85'>85</option>
                 <option value = '90'>90</option>
                 <option value = '95'>95</option>
                 <option value = 'NR'>NR</option>
               </select>
               </div>

               <div class="form-inline" style="padding-left: 20px;">
               <label for="l1k">L1k</label>
               <select type="text" class="form-control hearing-dropdown" onchange="passFilter(this, 10)" name="l1k[]" id="l1k">
                 <option value="">
                 </option>
                 <option value = '25'>25</option>
                 <option value = '30'>30</option>
                 <option value = '35'>35</option>
                 <option value = '40'>40</option>
                 <option value = '45'>45</option>
                 <option value = '50'>50</option>
                 <option value = '55'>55</option>
                 <option value = '60'>60</option>
                 <option value = '65'>65</option>
                 <option value = '70'>70</option>
                 <option value = '75'>75</option>
                 <option value = '80'>80</option>
                 <option value = '85'>85</option>
                 <option value = '90'>90</option>
                 <option value = '95'>95</option>
                 <option value = 'NR'>NR</option>
               </select>
             </div>
               <div class="form-inline">
               <label for="l2k">L2k</label>
               <select type="text" class="form-control hearing-dropdown" onchange="passFilter(this, 10)" name="l2k[]" id="l2k">
                 <option value="">
                 </option>
                 <option value = '25'>25</option>
                 <option value = '30'>30</option>
                 <option value = '35'>35</option>
                 <option value = '40'>40</option>
                 <option value = '45'>45</option>
                 <option value = '50'>50</option>
                 <option value = '55'>55</option>
                 <option value = '60'>60</option>
                 <option value = '65'>65</option>
                 <option value = '70'>70</option>
                 <option value = '75'>75</option>
                 <option value = '80'>80</option>
                 <option value = '85'>85</option>
                 <option value = '90'>90</option>
                 <option value = '95'>95</option>
                 <option value = 'NR'>NR</option>
               </select>
               </div>
               <div class="form-inline">
               <label for="l4k">L4k</label>
               <select type="text" class="form-control hearing-dropdown" onchange="passFilter(this, 10)" name="l4k[]" id="l4k">
                 <option value="">
                 </option>
                 <option value = '25'>25</option>
                 <option value = '30'>30</option>
                 <option value = '35'>35</option>
                 <option value = '40'>40</option>
                 <option value = '45'>45</option>
                 <option value = '50'>50</option>
                 <option value = '55'>55</option>
                 <option value = '60'>60</option>
                 <option value = '65'>65</option>
                 <option value = '70'>70</option>
                 <option value = '75'>75</option>
                 <option value = '80'>80</option>
                 <option value = '85'>85</option>
                 <option value = '90'>90</option>
                 <option value = '95'>95</option>
                 <option value = 'NR'>NR</option>
               </select>
               </div>
               </div>
             </div>
             <div id="extraFreq10" style="visibility: hidden;">

               <div class="form-inline" style="float: left;">
              <label for="r5k">R5k</label>
              <select type="text" class="form-control hearing-dropdown" name="r5k[]" id="r5k">
                <option value="">
                </option>
                <option value = '25'>25</option>
                <option value = '30'>30</option>
                <option value = '35'>35</option>
                <option value = '40'>40</option>
                <option value = '45'>45</option>
                <option value = '50'>50</option>
                <option value = '55'>55</option>
                <option value = '60'>60</option>
                <option value = '65'>65</option>
                <option value = '70'>70</option>
                <option value = '75'>75</option>
                <option value = '80'>80</option>
                <option value = '85'>85</option>
                <option value = '90'>90</option>
                <option value = '95'>95</option>
                <option value = 'NR'>NR</option>
              </select>
              </div>
              <div class="form-inline" style = 'float: right;'>
              <label for="l5k">L5k</label>
              <select type="text" class="form-control hearing-dropdown" name="l5k[]" id="l5k">
                <option value="">
                </option>
                <option value = '25'>25</option>
                <option value = '30'>30</option>
                <option value = '35'>35</option>
                <option value = '40'>40</option>
                <option value = '45'>45</option>
                <option value = '50'>50</option>
                <option value = '55'>55</option>
                <option value = '60'>60</option>
                <option value = '65'>65</option>
                <option value = '70'>70</option>
                <option value = '75'>75</option>
                <option value = '80'>80</option>
                <option value = '85'>85</option>
                <option value = '90'>90</option>
                <option value = '95'>95</option>
                <option value = 'NR'>NR</option>
              </select>
              </div>

            </div>
           </div>
           </div>


                   </div>









             </div>

           </div><!--/ .main-form-content-->

            </div><!--row ends-->



          </div>



</form>
       </div><!--.container ends-->


       <!-- jQuery first, then Popper.js, then Bootstrap JS -->
          <script src="{{asset('/js/jquery.js')}}"></script>
       <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
       <script src="{{asset('/js/bootstrap.min.js')}}"></script>
          <script src="{{asset('/js/cleave.min.js')}}"></script>


<script>


    var cleave = new Cleave('#dob', {
    date: true,
    delimiter: '/',
    datePattern: ['m', 'd', 'Y']
});

function remove(e){
  $('#appended'+e).remove();
  $('#student'+e+'id').val('');
  $("#studentLine"+e).find('.hearing-dropdown').val("");
}

function pass(e){
  var h = $("#studentLine"+e).find('.hearing-dropdown').val("25");

}

function refer(e){
  var h = $("#studentLine"+e).find('.hearing-dropdown').val("NR");

}



function allPass(){
  var i;
  for(i = 0; i< 11; i++){
    $('#studentLine'+i).find('.hearing-dropdown').val('25');
    $('#studentLine'+i).css('background-color', 'white');
    $('#studentLine'+i).find('.hearing-dropdown').css('background-color', 'white');
  }
}

function back(){
  window.location.href = '/';
}


function passFilter(e, cell){
  if($(e).val() != '25'){
    $("#studentLine"+cell).css('background-color', '#ff6060');
    $('#extraFreq'+cell).css('visibility', 'visible');
  }
}


var a = 1;

function addTestee(e){


  if(booth == ""){
      remove(a);
    $("#student"+a+"name").append(`<div id='appended${a}' style='margin-left: 15px;'>
      ${$(e).data('fname')+' '+$(e).data('lname')}
      </div>`);
    $("#student"+a+"id").val($(e).data('identify'));
    a ++;
    for(i= 0; i< 11; i++){
      $('#student'+i+'name').css('background-color', '#e8e5e5');
    }

  } else {
      remove(booth);
    $("#student"+booth+"name").append(`<div id='appended${booth}' style='margin-left: 15px;'>
      ${$(e).data('fname')+' '+$(e).data('lname')}
      </div>`);
    $("#student"+booth+"id").val($(e).data('identify'));
    booth = "";
    for(i= 0; i< 11; i++){
      $('#student'+i+'name').css('background-color', '#e8e5e5');
    }


  }

}


function addStudent(e){
  booth = e;

  var i;
  for(i= 0; i< 11; i++){
    $('#student'+i+'name').css('background-color', '#e8e5e5');
  }

  $('#student'+e+'name').css('background-color', '#14ff62');


}






function findName() {
  // Declare variables
  var input, filter, ul, li, a, i, txtValue, numValue;
  input = document.getElementById('search');
  filter = input.value.toUpperCase();
  ul = document.getElementById("students");
  li = ul.getElementsByTagName('li');

  // Loop through all list items, and hide those who don't match the search query
  for (i = 0; i < li.length; i++) {
    // a = li[i].getElementsByTagName("a")[0];
    txtValue = $(li[i]).html();
    numValue = $(li[i]).data('number');

    if (txtValue.toUpperCase().indexOf(filter) > -1 || numValue == filter) {
      li[i].style.display = "";
    } else {
      li[i].style.display = "none";
    }
  }

}

var booth = "";

$(document).keydown(function(event){
    if(event.which=="49"){
      booth = '1';
    }
    if(event.which=="50"){
      booth = '2';
    }
    if(event.which=="51"){
      booth = '3';
    }
    if(event.which=="52"){
      booth = '4';
    }
    if(event.which=="53"){
      booth = '5';
    }
    if(event.which=="54"){
      booth = '6';
    }
    if(event.which=="55"){
      booth = '7';
    }
    if(event.which=="56"){
      booth = '8';
    }
    if(event.which=="57"){
      booth = '9';
    }
    if(event.which=="48"){
      booth = '10';
    }

});

$(document).keyup(function(){
    booth = "";
});


$(document).ready(function(){
  $('#district').val(sessionStorage.getItem('district'));
  $('#school').val(sessionStorage.getItem('school'));
});

function newStudent(){
  $.ajax({
    url: '{{route('newHearingStudent')}}',
    method: 'POST',
    data:{
      fname: $("#fname").val(),
      lname: $("#lname").val(),
      dob: $("#dob").val(),
      gender: $("#gender").val(),
      grade: $("#grade").val(),
      district: $("#district").val(),
      school: $("#school").val(),
      teacher: $("#teacher").val(),
      nurse: $("#nurse").val(),
      number: $("#number").val(),
    },
    success: function(data){
      $('#students').prepend(
      `<li class="student_list" data-fname = "${data.student.fname}" data-lname = "${data.student.lname}" data-identify = "${data.student.id}"  data-number = "${data.student.student_number}"  onclick="addTestee(this)">
        ${data.student.fname} ${data.student.lname}
      </li>`
    )
        alert('Student Successfully Saved');
    },
    error: function(){
      alert("Unable to save student");
    }
  });
}




</script>



    <!-- Optional JavaScript -->


  </body>
</html>
