<!doctype html>
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

         <style>
             html{
                 font-size: 10pt;
             }
             li{
                 font-size: 12pt;
                 border-top: 1px solid black;
                 cursor: pointer;
                 list-style-type: none;
             }
             #search{
               margin-bottom: 15px;
             }
         </style>


       <title>Industrial Eyes</title>

     </head>
     <body onunload="closeChild();">

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
       </ul>
     </div>
   </nav>
     <div class="container">
   <br>
       <div class="row">
         <div class="chartForm">
           <div class="leftSideBar col-2 d-inline-block align-top">
             <input type="text" id="search" name="search" placeholder="Search" class="form-control"/>
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
           <div class="main-form-content col-7 d-inline-block align-top">
           <div class="content"><button onclick="reload()" class="btn btn-info">New Student</button>
             <form class="exam_data" method="post" action = "{{route('submitExam')}}">
               <input type="hidden" id="student_id" name="student_id"/>

               @csrf
               <h3>Student Data</h3>
               <hr>
               <div class="row">
                 <div class="col-md-6 col-lg-4">
                     <div class="form-group">
                       <label for="fname">First Name</label>
                       <input type="text" class="form-control" name="fname" id="fname"/>
                     </div>
                 </div>
                 <div class="col-md-6 col-lg-4">
                     <div class="form-group">
                       <label for="lname">Last Name</label>
                       <input type="text" class="form-control" name="lname" id="lname"/>
                     </div>
                 </div>
                 <div class="col-md-6 col-lg-4">
                     <div class="form-group">
                       <label for="dob">Date of Birth</label>
                       <input type="text" class="form-control" name="dob" id="dob" />
                     </div>
                 </div>
                 <div class="col-md-6 col-lg-4">
                     <div class="form-group">
                       <label for="gender">Gender</label>
                       <input type="text" class="form-control" name="gender" id="gender" />
                     </div>
                 </div>
                 <div class="col-md-6 col-lg-4">
                     <div class="form-group">
                       <label for="number">Student Number</label>
                       <input type="text" class="form-control" name="number" id="number" />
                     </div>
                 </div>
                 <div class="col-md-6 col-lg-4">
                     <div class="form-group">
                       <label for="district">District</label>
                       <input type="text" class="form-control" name="district" id="district" />
                     </div>
                 </div>
                 <div class="col-md-6 col-lg-4">
                     <div class="form-group">
                       <label for="school">School</label>
                       <input type="text" class="form-control" name="school" id="school" />
                 </div>
                 </div>
                 <div class="col-md-6 col-lg-4">
                     <div class="form-group">
                       <label for="teacher">Teacher</label>
                       <input type="text" class="form-control" name="teacher" id="teacher" />
                     </div>
                 </div>
               </div><!--/ .row ends-->
             </div>
             <div class="exam">
               <h3>Exam Data</h3>


                 <button type="button" class="btn btn-success" onclick="showExam()">10'</button>
                 <button type="button" class="btn btn-success" onclick="showExam4()">6'</button>
                 <button type="button" class="btn btn-success" onclick="showExam5()">HOTV</button>
                 <button type="button" class="btn btn-success" onclick="showExam2()">Near</button>
                 <button type="button" class="btn btn-success" onclick="showExam3()">Color</button>
                 <button  type="submit" class="btn btn-primary" id="startExam">Submit</button>
                  <a href="" id="printExam" target="_blank"><button  type="button" class="btn btn-warning" >Print</button></a>
                  <a href="" id="deleteExam"><button  type="button" class="btn btn-danger" >Delete Exam</button></a>
                 <div class="row">
                   <div class="col-6 od-group">
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
                   </div> <!--col-sm-3-->


                   <div class="col-6 os-group">
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
                   </div>
                 </div><!--/ .row ends-->
                   <div class="row">
                     <div class="col-6 offset-sm-3">
                       <div class="form-group">
                         <label for="ou_dist">OU Distance</label>
                         <input type="text" class="form-control" name="ou_dist" id="ou_dist">
                       </div>
                       <div class="form-group">
                           <label for="ou_near">OU Near</label>
                           <input type="text" class="form-control" name="ou_near" id="ou_near">
                         </div>
                     </div>

                   </div><!--/ .row ends-->

             </form>

             </div>
           </div><!--/ .main-form-content-->

              <div class="rightSideBar col-2 d-inline-block align-top">
             <ul id="students2" >
               {{-- @foreach($students as $student)
                 @if($student->complete == 1)
                   <li class="student_list" data-fname = "{{$student->fname}}" data-lname = "{{$student->lname}}" data-identify = "{{$student->id}}" data-dob = "{{$student->dob}}" data-gender = "{{$student->gender}}" data-number = "{{$student->student_number}}" data-school = "{{$student->school}}" data-teacher = "{{$student->teacher}}" data-district = "{{$student->district}}"
                      data-oddist = "{{$student->od_dist}}"
                       data-odnear = "{{$student->os_dist}}"
                        data-osdist = "{{$student->od_near}}"
                         data-osnear = "{{$student->os_near}}"
                          data-odcyl = "{{$student->od_cyl}}"
                           data-oscyl = "{{$student->os_cyl}}"
                            data-odcolor = "{{$student->od_color}}"
                             data-oscolor = "{{$student->os_color}}"
                              data-oudist = "{{$student->ou_dist}}"
                               data-ounear = "{{$student->ou_near}}"
                      onclick="loadStudent(this)">
                     {{$student->fname.' '.$student->lname}}
                   </li>
                 @endif
               @endforeach --}}

           </ul>

           </div>
          </div>

         </div><!--.row ends-->
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
    sessionStorage.setItem('currentFilter', query);
    // $('#total_records').text(data.total_data);
   }
  })
 }

 $(document).on('keyup', '#search', function(){
  var query = $(this).val();
  fetch_customer_data(query);
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
