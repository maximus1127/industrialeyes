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
             }
             #notes{
             }
         </style>


       <title>Industrial Eyes</title>

     </head>
     <body onunload="closeChild();">
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
       <a class="dropdown-item" href="{{ route('logout') }}"
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

               <input type='submit' name='submit' value='Download Roster' class="btn btn-primary">

          </form>
        </div>


     {{-- </div> --}}


 </div>
 <br />
     <div class="container-fluid">
   <br>

         <div class="chartForm">
            <div class="row">
              <div class="col-md-4 d-inline-block align-top">
           <div class="leftSideBar">
             <div class="searh-box"><input  type="text" id="search" name="search" placeholder="Search" class="form-control"/></div>

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
                 <div class="col-md-6 col-lg-4">
                     <div class="form-group">
                       <!--<label for="gender">Gender</label>-->
                       <input type="text" class="form-control" name="gender" id="gender" placeholder="Gender" />
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
                  <button type="button" class="btn btn-success" onclick="showExam5()">HOTV</button>
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
                  <div class="row mt20">
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
                      <div class="form-group">
                          <label for="od_color">OD Color</label>
                          <input type="text" class="form-control" name="od_color" id="od_color">
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
                            <div class="form-group">
                                <label for="os_cyl">OS Color</label>
                                <input type="text" class="form-control" name="os_color" id="os_color">
                            </div>
                        </div><!--exam-data-new ends-->
                    </div>
                  </div><!--/ .row ends-->
                  <br />
                  <label for="notes"><h3>Notes</h3></label>
                  <textarea class="form-control" rows="4" name="notes" id="notes">


                  </textarea>



              </div>


          </div>
          <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" onload="loadHearingValues()">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <button type="button" class="btn btn-success" data-dismiss="modal" style="width: 10%;margin: 30px;">Save</button>
                <div class="row">
                  <div class="col-md-6" style="padding: 40px;">
                          <h5>Right</h5>
                      <div class="exam-data-new">
                          <div class="form-group">
                          <label for="r1k">R1k</label>
                          <select type="text" class="form-control" name="r1k" id="r1k">
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
                          <select type="text" class="form-control" name="r2k" id="r2k">
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
                          <select type="text" class="form-control" name="r4k" id="r4k">
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
                          <label for="r5k">R5k</label>
                          <select type="text" class="form-control" name="r5k" id="r5k">
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
                          <label for="l1k">L1k</label>
                          <select type="text" class="form-control" name="l1k" id="l1k">
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
                          <select type="text" class="form-control" name="l2k" id="l2k">
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
                          <select type="text" class="form-control" name="l4k" id="l4k">
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
                          <label for="l5k">L5k</label>
                          <select type="text" class="form-control" name="l5k" id="l5k">
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

              </div>
            </div>

          </div>
</form>
       </div><!--.container ends-->


       <!-- jQuery first, then Popper.js, then Bootstrap JS -->
       <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
       <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
       <script src="{{asset('/js/bootstrap.min.js')}}"></script>
       <script src="{{asset("/js/chart.js")}}"></script>

<script>
$(document).ready(function(){
var search = sessionStorage.getItem('currentFilter');
$("#search").val(search);
 fetch_customer_data(search);
 function fetch_customer_data(query = '')
 {
  $.ajax({
   url:"{{ route('live_search.action') }}",
   method:'GET',
   data:{query:query},
   dataType:'json',
   success:function(data)
   {
    $('#students').html(data.table_data);
    $('#students2').html(data.table_data2);
    // $('#total_records').text(data.total_data);
   }
  })
 }
 $(document).on('keyup', '#search', function(){
  var query = $(this).val();
  fetch_customer_data(query);
  sessionStorage.setItem('currentFilter', query);
 });
});
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
  var fails = ['20/40', '20/50', '20/60', '20/80', '20/100', '20/200', '20/400'];
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
}
function fillIn2(){
  $("#od_near").val(win2.student_responses[0]);
  $("#os_near").val(win2.student_responses[1]);
  $("#ou_near").val(win2.student_responses[2]);
}
function reload(){
  location.reload();
}
function closeChild(){
     win2.close();
 }



</script>



    <!-- Optional JavaScript -->


  </body>
</html>
