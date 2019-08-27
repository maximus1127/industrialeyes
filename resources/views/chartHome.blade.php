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

         </style>


       <title>Industrial Eyes</title>

     </head>
     <body onunload="closeChild();" onload="autoFill()">
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
        <div class="top_item">
          <form method='get' action='{{route('exportRoster')}}' >
            {{ csrf_field() }}

               <input type='submit' name='submit' value='Download Roster' class="btn btn-primary" target="_blank">

          </form>
        </div>

<a href="{{route('batchPrint')}}" style="margin-left: 20px;" target="_blank"><button type="button" class="btn btn-info">Daily Batch</button></a>
     {{-- </div> --}}
     <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#exampleModal2" style="margin-left: 20px;">
        Select District/School
      </button>
      <button type="button"  onclick="bilateral()" id="bilateral-button"  style="margin-left: 20px;">
         Bilateral Distance
       </button>
       <a href="" id="hearingURL"><button type="button" class="btn btn-success" style="margin-left: 20px;">
          Hearing Exam (10)
        </button></a>

         Total Examined Today: <span id="total">{{$total}}</span>

 </div>
 <br />
     <div class="container-fluid">
   <br>

         <div class="chartForm">
            <div class="row">
              <div class="col-md-4 d-inline-block align-top">
           <div class="leftSideBar">


              <!-- Modal -->
                <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel2">Filter Students</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">

                                     <select  id="search_district" name="search_district" onchange="populateSchool()"  class="form-control" style="height: 40px;"/>
                                        <option>
                                          Select District....
                                        </option>
                                         @foreach($districts as $district)
                                          <option value="{{$district->district}}">
                                              {{$district->district}}
                                          </option>
                                         @endforeach

                                     </select>
                                     <select  id="search_school" name="search_school"  class="form-control" onchange="populateStudents()" style="height: 40px;"/>
                                        <option>
                                          Select School....
                                        </option>


                                     </select>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" onclick="location.reload()" data-dismiss="modal">Filter</button>
                        {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                      </div>
                    </div>
                  </div>
                </div>
             <div class="searh-box"><input  type="text" onkeyup="findName()" id="search" name="search" placeholder="Search" class="form-control"/></div>

             <div class="students-list">
                    <ul id="students">


                            {{-- @foreach($students as $student)
                              @if($student->complete == 0)
                                <li class="student_list" data-fname = "{{$student->fname}}" data-lname = "{{$student->lname}}" data-identify = "{{$student->id}}" data-dob = "{{Carbon\Carbon::parse($student->dob)->format('m/d/Y')}}" data-gender = "{{$student->gender}}" data-number = "{{$student->student_number}}" data-school = "{{$student->school}}" data-teacher = "{{$student->teacher}}" data-district = "{{$student->district}}" onclick="loadStudent(this)">
                                  {{$student->fname.' '.$student->lname}}
                                </li>
                              @endif
                            @endforeach --}}

                     </ul>

             </div>


           </div>
            </div>
           <div class="main-form-content col-md-8 d-inline-block align-top">
                <div class="add-student">
                    <h3>Add New Student</h3>
                    <button onclick="reload()" class="btn btn-info new-student"><img src="/images/add-student-icon.png"></button>
                    <div class="clearfix"></div>
                </div>

                {{-- <h3>Student Data</h3> --}}
                <hr>
           <div class="content" style = "font-size: 20px;">
             <form class="exam_data" method="post" action = "{{route('submitExam')}}">
               <input type="hidden" id="student_id" name="student_id"/>
                   @csrf



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
                     <div class="form-group">
                       <!--<label for="teacher">Teacher</label>-->
                       <input type="text" id="nurse" name="nurse" class="form-control" placeholder="Nurse Name"/>
                     </div>
                 </div>
               </div><!--/ .row ends-->
             </div>

           </div><!--/ .main-form-content-->

            </div><!--row ends-->
           <div class="exam">
                {{-- <h3 class="text-center">Exam Data</h3> --}}
                <hr>
                <div class="all-btns text-center">

                  <button type="button" class="btn btn-success" onclick="showExam()">10'</button>
                  <button type="button" class="btn btn-success" onclick="showExam4()">6'</button>
                  <button type="button" class="btn btn-success" onclick="showExam5()">HOTV/LEA</button>
                  <button type="button" class="btn btn-success" onclick="showExam2()">Near</button>
                  <button type="button" class="btn btn-success" onclick="showExam3()">Color</button>
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Hearing</button>
                  <div class="row">
                      <div class="col-md-12">
                  <button  type="submit" class="btn btn-primary" id="startExam"><img src="images/submit-icon.png" class="submit-icon">Submit</button>
                   <a href="" id="printExam" target="_blank"><button  type="button" class="btn btn-warning" ><img src="images/print-icon.png" class="print-icon">Print</button></a>
                   <a href="" id="deleteExam"><button  type="button" class="btn btn-danger" ><img src="images/delete-icon.png" class="delete-icon">Delete</button></a>
                 </div>
                 </div>
                </div><!--all-btns-->
                  <div class="row mt20" >
                    <div class="col-md-4 od-group">
                        <h5>Right</h5>
                    <div class="exam-data-new od-background">
                      <div class="form-group">
                        <label for="od_dist">OD Distance</label>
                        <input type="text" class="form-control" name="od_dist" id="od_dist">
                      </div>
                      <div class="form-group">
                          <label for="od_near">OD Near</label>
                          <input type="text" class="form-control" name="od_near" id="od_near">
                      </div>
                      <div class="form-group">
                          <label for="od_cyl">OD Astigmatism</label>
                          <input type="text" class="form-control" name="od_cyl" id="od_cyl">
                      </div>

                      </div><!--exam-data-new ends-->
                    </div> <!--col-md-4-->
                    <div class="col-md-4">
                            <h5>Center</h5>
                            <div class="exam-data-new ou-background">
                            <div class="form-group">
                              <label for="ou_dist">OU Distance</label>
                              <input type="text" class="form-control" name="ou_dist" id="ou_dist">
                            </div>
                            <div class="form-group">
                                <label for="ou_near">OU Near</label>
                                <input type="text" class="form-control" name="ou_near" id="ou_near">
                              </div>
                              <div class="form-group">
                                  <label for="ou_near">OU Color</label>
                                  <br />
                                  <input type="radio" name="ou_color" id="color-pass" value="Pass">Pass
                                  <input type="radio" name="ou_color" id="color-fail" value="Fail">Fail<br>
                                </div>
                              {{-- <div class="form-group">
                                  <label for="r_ear">Right Ear</label>
                                  <input type="text" class="form-control" name="r_ear" id="r_ear">
                                </div>
                                <div class="form-group">
                                    <label for="l_ear">Left Ear</label>
                                    <input type="text" class="form-control" name="l_ear" id="l_ear">
                                  </div> --}}
                          </div><!--exam-data-new ends-->
                    </div>

                    <div class="col-md-4 os-group">
                            <h5>Left</h5>
                        <div class="exam-data-new os-background">
                            <div class="form-group">
                            <label for="os_dist">OS Distance</label>
                            <input type="text" class="form-control" name="os_dist" id="os_dist">
                            </div>
                            <div class="form-group">
                                <label for="os_near">OS Near</label>
                                <input type="text" class="form-control" name="os_near" id="os_near">
                            </div>
                            <div class="form-group">
                                <label for="os_cyl">OS Astigmatism</label>
                                <input type="text" class="form-control" name="os_cyl" id="os_cyl">
                            </div>

                        </div><!--exam-data-new ends-->
                    </div>
                  </div><!--/ .row ends-->
                  <br />
                  <label for="notes"><h3>Notes</h3></label>
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal3">
                    Select Notes
                  </button>
                  <textarea class="form-control"  name="notes" id="notes"></textarea>



              </div>


          </div>
          <div class="modal fade" id="exampleModal3" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel3">Select Notes</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <input type="checkbox" style = "height: 20px; width: 20px;" onchange="addNote(this)" name="note21" value="Wears Glasses. "> Wears Glasses<br>
                  <input type="checkbox" style = "height: 20px; width: 20px;" onchange="addNote(this)" name="note1" value="Language Barrier. "> Language Barrier<br>
                  <input type="checkbox" style = "height: 20px; width: 20px;" onchange="addNote(this)" name="note2" value="Uncooperative. "> Uncooperative<br>
                  <input type="checkbox" style = "height: 20px; width: 20px;" onchange="addNote(this)" name="note3" value="Immature. "> Immature<br>
                  <input type="checkbox" style = "height: 20px; width: 20px;" onchange="addNote(this)" name="note4" value="Blurring. "> Blurring<br>
                  <input type="checkbox" style = "height: 20px; width: 20px;" onchange="addNote(this)" name="note5" value="Blinking / Squinting. "> Blinking / Squinting<br>
                  <input type="checkbox" style = "height: 20px; width: 20px;" onchange="addNote(this)" name="note6" value="Straining. "> Straining<br>
                  <input type="checkbox" style = "height: 20px; width: 20px;" onchange="addNote(this)" name="note7" value="Eyes Water / Red. "> Eyes Water / Red<br>
                  <input type="checkbox" style = "height: 20px; width: 20px;" onchange="addNote(this)" name="note8" value="Eyes Cross / Wandering. "> Eyes Cross / Wandering<br>
                  <input type="checkbox" style = "height: 20px; width: 20px;" onchange="addNote(this)" name="note9" value="Does not have glasses at exam. "> Does not have glasses at exam<br>
                  <input type="checkbox" style = "height: 20px; width: 20px;" onchange="addNote(this)" name="note10" value="Wore glasses previously. "> Wore glasses previously<br>
                  <input type="checkbox" style = "height: 20px; width: 20px;" onchange="addNote(this)" name="note11" value="Headaches. "> Headaches<br>
                  <input type="checkbox" style = "height: 20px; width: 20px;" onchange="addNote(this)" name="note12" value="Cold / Congested. "> Cold / Congested<br>
                  <input type="checkbox" style = "height: 20px; width: 20px;" onchange="addNote(this)" name="note13" value="Recent or present earaches. "> Recent or present earaches<br>
                  <input type="checkbox" style = "height: 20px; width: 20px;" onchange="addNote(this)" name="note14" value="Reports history of ear problems. "> Reports history of ear problems<br>
                  <input type="checkbox" style = "height: 20px; width: 20px;" onchange="addNote(this)" name="note15" value="Reports ringing or head noises. "> Reports ringing or head noises<br>
                  <input type="checkbox" style = "height: 20px; width: 20px;" onchange="addNote(this)" name="note16" value="Legal pass Ck 500 Hz. "> Legal pass Ck 500 Hz<br>
                  <input type="checkbox" style = "height: 20px; width: 20px;" onchange="addNote(this)" name="note17" value="Reports awareness problem. "> Reports awareness problem<br>
                  <input type="checkbox" style = "height: 20px; width: 20px;" onchange="addNote(this)" name="note18" value="Surgery. "> Surgery<br>
                  <input type="checkbox" style = "height: 20px; width: 20px;" onchange="addNote(this)" name="note19" value="Exam within last year. "> Exam within last year<br>
                  <input type="checkbox" style = "height: 20px; width: 20px;" onchange="addNote(this)" name="note20" value="Known problem / Under medical care. "> Known problem / Under medical care<br>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Save</button>
                  {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                </div>
              </div>
            </div>
          </div>



          <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" onload="loadHearingValues()">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">

                <div class="row">
                  <div class="col-md-6" style="padding: 40px;">
                          <h5>Right</h5>
                      <div class="exam-data-new">
                        <div class="form-group">
                        <label for="r5k">R5k</label>
                        <select type="text" class="form-control hearing-dropdown" name="r5k" id="r5k">
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
                        </select>
                        </div>
                          <div class="form-group">
                          <label for="r1k">R1k</label>
                          <select type="text" class="form-control hearing-dropdown" name="r1k" id="r1k">
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
                          </select>
                          </div>
                          <div class="form-group">
                          <label for="r2k">R2k</label>
                          <select type="text" class="form-control hearing-dropdown" name="r2k" id="r2k">
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
                          </select>
                          </div>
                          <div class="form-group">
                          <label for="r4k">R4k</label>
                          <select type="text" class="form-control hearing-dropdown" name="r4k" id="r4k">
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
                          </select>
                          </div>


                      </div><!--exam-data-new ends-->
                  </div>
                  <div class="col-md-6" style="padding: 40px;">
                          <h5>Left</h5>
                      <div class="exam-data-new" >
                        <div class="form-group">
                        <label for="l5k">L5k</label>
                        <select type="text" class="form-control hearing-dropdown" name="l5k" id="l5k">
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
                        </select>
                        </div>
                          <div class="form-group">
                          <label for="l1k">L1k</label>
                          <select type="text" class="form-control hearing-dropdown" name="l1k" id="l1k">
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
                          </select>
                          </div>
                          <div class="form-group">
                          <label for="l2k">L2k</label>
                          <select type="text" class="form-control hearing-dropdown" name="l2k" id="l2k">
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
                          </select>
                          </div>
                          <div class="form-group">
                          <label for="l4k">L4k</label>
                          <select type="text" class="form-control hearing-dropdown" name="l4k" id="l4k">
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
                          </select>
                          </div>


                      </div><!--exam-data-new ends-->
                  </div>



                </div>
                <div class="row">
                  <button type="button" class="btn btn-success" data-dismiss="modal" style="width: 10%;margin-left: 10%;">Close</button>
                  <button type="button" class="btn btn-info" onclick="allPass()"  style="width: 10%;margin-left: 10%;">All Pass</button>
                </div>

              </div>
            </div>

          </div>
</form>
       </div><!--.container ends-->


       <!-- jQuery first, then Popper.js, then Bootstrap JS -->
       <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script>
       <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
       <script src="{{asset('/js/bootstrap.min.js')}}"></script>
       <script src="{{asset("/js/chart.js")}}"></script>

<script>

function showExam(){
    return win2=window.open('{{route('exam')}}');
}
function showExam2(){
    return win2=window.open('{{route('exam2')}}');
}
function showExam3(){
    return win2=window.open('{{route('exam3')}}');
}
function showExam4(){
    return win2=window.open('{{route('exam4')}}');
}
function showExam5(){
    return win2=window.open('{{route('exam5')}}');
}








function fillIn(){
  var fails = ['20/40', '20/50', '20/60', '20/70', '20/80', '20/100', '20/200', '20/300', '20/400'];
if (fails.includes(win2.student_responses[0])){
    $(".od-background").css('background', '#d84b4b');
  } else {
    $(".od-background").css('background', '#11b21c');
  }
  if (fails.includes(win2.student_responses[1])){
      $(".os-background").css('background', '#d84b4b');
    } else {
      $(".os-background").css('background', '#11b21c');
    }
    if (fails.includes(win2.student_responses[2])){
        $(".ou-background").css('background', '#d84b4b');
      } else {
        $(".ou-background").css('background', '#11b21c');
      }
  $("#od_dist").val(win2.student_responses[0]);
  $("#os_dist").val(win2.student_responses[1]);
  $("#ou_dist").val(win2.student_responses[2]);

  $.ajax({
    url: "{{route('autosave')}}",
    method: "GET",
    data: {
      ODdist: win2.student_responses[0],
      OSdist: win2.student_responses[1],
      OUdist: win2.student_responses[2],
      studentID: $("#student_id").val(),
    },
    success: function(data){
      var stAssign = $("li[data-identify='"+ $('#student_id').val() +"']");
      stAssign.data('oddist', win2.student_responses[0]);
      stAssign.data('osdist', win2.student_responses[1]);
      stAssign.data('oudist', win2.student_responses[2]);
      $("#total").html(data.total);
    }
  });

}





function addNote(f){
  var note = $(f).val();
  var noteBox = $('#notes');
if($(f).prop('checked')==1){
  note = noteBox.val() + note;
  noteBox.val(note);
  $.ajax({
    url: "{{route('noteSave')}}",
    data: {
      studentID: $("#student_id").val(),
      note: note,
    },
    error: function(){
      alert("Unable to save note");
    }
  });
}else{
  note = noteBox.val().replace($(f).val(), '');
  noteBox.val(note);
  $.ajax({
    url: "{{route('noteSave')}}",
    data: {
      studentID: $("#student_id").val(),
      note: note,
    },
    error: function(){
      alert('Unable to save note');
    }
  });
}

}





function fillIn2(){
  $("#od_near").val(win2.student_responses[0]);
  $("#os_near").val(win2.student_responses[1]);
  $("#ou_near").val(win2.student_responses[2]);

  $.ajax({
    url: "{{route('autosave2')}}",
    method: "GET",
    data: {
      ODnear: win2.student_responses[0],
      OSnear: win2.student_responses[1],
      OUnear: win2.student_responses[2],
      studentID: $("#student_id").val(),
    },
    success: function(data){
      var stAssign = $("li[data-identify='"+ $('#student_id').val() +"']");
      stAssign.data('odnear', win2.student_responses[0]);
      stAssign.data('osnear', win2.student_responses[1]);
      stAssign.data('ounear', win2.student_responses[2]);

    }
  });



}

function autoFill(){
  if(sessionStorage.getItem('newStudent') == 1){
    $("#district").val(sessionStorage.getItem('district'));
    $("#school").val(sessionStorage.getItem('school'));
    sessionStorage.removeItem('newStudent');
  }
}


function reload(){
  sessionStorage.setItem('autoSelect', '');
  sessionStorage.setItem('newStudent', 1);
  location.reload();
}
function closeChild(){
     win2.close();
 }

 function allPass(){
   $(".hearing-dropdown").each(function(){
     $(this).val('25');
   })
 }

function populateSchool(){
  $.ajax({
   url:"{{ route('get_schools') }}",
   method:'GET',
   data:{district:$('#search_district').val()},
   dataType:'json',
   success:function(data)
   {
      $('#search_school').html(data.school_data);

   }
 });
}

function populateStudents(){
  $.ajax({
   url:"{{ route('get_students') }}",
   method:'GET',
   data:{
            district:$('#search_district').val(),
            school:$('#search_school').val()
            },
   dataType:'json',
   success:function(childs)
   {
     // console.log(childs);
      $('#students').html(childs.student_data);
      sessionStorage.setItem("school", $('#search_school').val());
      sessionStorage.setItem("district", $('#search_district').val());
   }
 });
}

function autoPopulateStudents(){
  $.ajax({
   url:"{{ route('get_students') }}",
   method:'GET',
   data:{
            district:sessionStorage.getItem('district'),
            school:sessionStorage.getItem('school')
            },
   dataType:'json',
   success:function(childs)
   {
     // console.log(childs);
      $('#students').html(childs.student_data);

   }
 });
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

function autoDistrict(){
  if( sessionStorage.getItem('district')){
  $('#search_district').val(sessionStorage.getItem('district'));
  setTimeout(autoSchool(), 400)
}
}

function autoSchool(){
  if(sessionStorage.getItem('school'))
  $("#search_school").val(sessionStorage.getItem('school'));
}

$(document).ready(function(){
  if(sessionStorage.getItem('district') || sessionStorage.getItem('school')){
    autoPopulateStudents();
    $("#search").attr('placeholder', sessionStorage.getItem('school')+ ' in ' + sessionStorage.getItem('district') + ' district');


}
    if(!sessionStorage.getItem('bilateral')){
      $("#bilateral-button").addClass('btn btn-danger');
    } else {
        $("#bilateral-button").addClass('btn btn-success');
    }


  // $("li[data-identify='"+sessionStorage.getItem('autoSelect')+"']").trigger('click');
  // setTimeout(function(){
  //   var kid = sessionStorage.getItem("autoSelect").toString();
  //    $("li[data-identify='"+kid+"']").trigger('click');
  //
  // }, 500);

  $("#hearingURL").attr('href', '/hearing-exam/'+sessionStorage.getItem('district')+'/'+sessionStorage.getItem('school'));


});

function bilateral(){
  if(!sessionStorage.getItem('bilateral')){
    sessionStorage.setItem('bilateral', 1);
    $("#bilateral-button").removeClass();
    $("#bilateral-button").addClass('btn btn-success');
  } else {
      sessionStorage.removeItem('bilateral');
      $("#bilateral-button").removeClass();
      $("#bilateral-button").addClass('btn btn-danger');
  }
}



</script>



    <!-- Optional JavaScript -->


  </body>
</html>
