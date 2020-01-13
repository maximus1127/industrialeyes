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
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> --}}
    <link href="{{asset('/css/form-styling.css')}}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{asset('/css/selectize.css')}}" crossorigin="anonymous">
    {{-- <link href="form-styling.css" rel="stylesheet" type="text/css"> --}}

         <style>

         .ui-widget-overlay{
           background-color: black;
           opacity: .6;
         }
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

             .delete-student img {
               width: 10px;
               height: 10px;

             }
             .secondList{

               max-height: 600px;
               overflow: hidden;
             }
             ul#students2 li{
               font-size: 48pt;
             }
             .searh-box2{
               height: 150px;
               background-color: white;
               font-size: 48pt;
               color: white;
             }
             .searh-box2:active{
               height: 150px;
               background-color: white;
               font-size: 48pt;
               color: Black;
             }

             .form-control{

               font-size: 30px;
               margin-top: 20px;
             }

             #mailcsv{
               position: absolute;
               bottom: 4px;
               left: 4px;
             }

             .container{
               width: 80% !important;
             }


         </style>


       <title>Industrial Eyes</title>

     </head>
     <body onunload="closeChild();" onload="autoFill(); studentCount();" class="container">

       <div id="dialog" title="Autosave Error" style="display: none">
  <p>Unable to save vision. Enter the acuities and press submit to save exam data.</p>
</div>
<div id="dialog2" title="Selection Error" style="display: none">
<p>Please select a student before starting an exam.</p>
</div>
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
         <li class="nav-item">
           <a class="nav-link" href="{{route('combine-data-index')}}">Combine Data</a>
         </li>
         <li class="nav-item">
           <a class="nav-link" href="{{route('manage-staff')}}">Manage Staff</a>
         </li>
       </ul>
     </div>

   </nav>
 @endif
 @if ($message = Session::get('success'))
<div class="alert alert-success alert-block">
	<button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
</div>
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
@if(Auth::user()->is_admin == 1)
<a href="" style="margin-left: 20px;" target="_blank" id="hearingBatch"><button type="button" class="btn btn-info">Download Hearing Batches</button></a>
<a href="" style="margin-left: 20px;" target="_blank" id="visionBatch"><button type="button" class="btn btn-info">Download Vision Batches</button></a>
@endif
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

         Total Examined Today: <span id="total"></span>

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
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Filter</button>

                      </div>
                    </div>
                  </div>
                </div>




              <div class="modal fade bd-example-modal-lg1"  role="dialog" aria-labelledby="myLargeModalLabel" id="studentModal" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content secondList">
                    <div class="searh-box"><input  type="text" onkeyup="findName2()" id="search2" name="search2" placeholder="Search" class="form-control searh-box2" autofocus /></div>
                    <ul id="students2">

                     </ul>
                  </div>
                </div>
              </div>


           </div>
            </div>
           <div class="main-form-content col-md-12 d-inline-block align-top">
                <div class="add-student">
                  <button onclick="deleteStudent()" class="btn btn-info new-student"><img src="/images/delete-icon.png" style="width: 20px;"></button>
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
                       <input type="text" class="form-control" name="fname" id="fname" placeholder="First Name" required/>
                     </div>
                 </div>
                 <div class="col-md-6 col-lg-4">
                     <div class="form-group">
                       <!--<label for="lname">Last Name</label>-->
                       <input type="text" class="form-control" name="lname" id="lname" placeholder="Last Name" required/>
                     </div>
                 </div>
                 <div class="col-md-6 col-lg-4">
                     <div class="form-group">
                       <!--<label for="dob">Date of Birth</label>-->
                       <input type="text" class="form-control" name="dob" id="dob" placeholder="DOB M/D/YYYY" />
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
                       <input type="text" class="form-control" name="grade" id="grade" placeholder="Grade"  required/>
                     </div>
                 </div>
                 <div class="col-md-6 col-lg-4">
                     <div class="form-group">
                       <!--<label for="number">Student Number</label>-->
                       <input type="text" class="form-control" name="number" id="number" placeholder="Student Number"  required/>
                     </div>
                 </div>
                 <div class="col-md-6 col-lg-4">
                     <div class="form-group">
                       <!--<label for="district">District</label>-->
                       <input type="text" class="form-control" name="district" id="district" placeholder="District" required />
                     </div>
                 </div>
                 <div class="col-md-6 col-lg-4">
                     <div class="form-group">
                       <!--<label for="school">School</label>-->
                       <input type="text" class="form-control" name="school" id="school" placeholder="School" required />
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
                       {{-- <input type="text" id="nurse" name="nurse" class="form-control" placeholder="Nurse Name"/> --}}
                       <select id="nurse" name="nurse" class="demo-default" onchange="setNurse()">
                         <option value="">Select a nurse... </option>
                         @foreach($staffs as $staff)
                           <option value="{{$staff->name}}">
                             {{$staff->name}}
                           </option>

                         @endforeach
                       </select>
                     </div>
                          <button  type="submit" class="btn btn-primary"><img src="images/submit-icon.png" class="submit-icon">Submit</button>
                 </div>

               </div><!--/ .row ends-->

               </form>
             </div>

           </div><!--/ .main-form-content-->

            </div><!--row ends-->
           <div class="exam">
                <hr>
                <div class="all-btns text-center">

                  <div class="row">
                      <div class="col-md-12">
                        <a href="" id="startExam" target="_blank"><button  type="button" class="btn btn-success" id="startButton" disabled>Start Exam</button></a>
                        <button  type="button" class="btn btn-warning" data-toggle="modal" data-target="#exampleModalCenter" ><img src="images/print-icon.png" class="print-icon" >View Exam</button>
                        <a href="" id="deleteExam"><button  type="button" class="btn btn-danger" ><img src="images/delete-icon.png" class="delete-icon">Delete Exam</button></a>
                      </div>
                  </div>
                </div>
            </div>


          </div>


    <a href="" id="mailcsv"><button class="btn btn-sm btn-info">Data Transfer</button></a>

    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Todays Exam Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row mt20" >
          <div class="col-md-4 od-group">
              <h5>Right</h5>
          <div class="exam-data-new od-background">
            <div class="form-group">
              <label for="od_dist">OD Distance</label>
              <input type="text" class="form-control" name="od_dist" id="od_dist" value="">
            </div>

            </div><!--exam-data-new ends-->
          </div> <!--col-md-4-->
          <div class="col-md-4">
                  <h5>Both</h5>
                  <div class="exam-data-new ou-background">
                    <div class="form-group">
                        <label for="ou_dist">OU Dist</label>
                        <input type="text" class="form-control" name="ou_dist" id="ou_dist" value="">
                      </div>
                  <div class="form-group">
                      <label for="ou_near">OU Near</label>
                      <input type="text" class="form-control" name="ou_near" id="ou_near" value="">
                    </div>
                    <div class="form-group">
                        <label for="ou_color">OU Color</label>
                        <input type="text" class="form-control" name="ou_color" id="ou_color" value="">
                      </div>
                </div>
          </div>
          <div class="col-md-4 os-group">
                  <h5>Left</h5>
              <div class="exam-data-new os-background">
                  <div class="form-group">
                  <label for="os_dist">OS Distance</label>
                  <input type="text" class="form-control" name="os_dist" id="os_dist" value="">
                  </div>
              </div>
          </div>
          Notes: &nbsp;<span id="notes"></span>
          <div class="row" style="width: 100%;">
                <div class="col-md-6" style="padding: 40px;">
                        <h5>Right</h5>
                    <div class="exam-data-new">
                      <div class="form-group">
                        <p>R5K: <span id="r5k"></span></p>
                      </div>
                        <div class="form-group">
                        <p>R1K: <span id="r1k"></span></p>
                        </div>
                        <div class="form-group">
                        <p>R2K: <span id="r2k"></span></p>
                        </div>
                        <div class="form-group">
                        <p>R4K: <span id="r4k"></span></p>
                        </div>


                    </div><!--exam-data-new ends-->
                </div>
                <div class="col-md-6" style="padding: 40px;">
                        <h5>Left</h5>
                    <div class="exam-data-new" >
                      <div class="form-group">
                      <p>L5K: <span id="l5k"></span></p>
                      </div>
                        <div class="form-group">
                        <p>L1K: <span id="l1k"></span></p>
                        </div>
                        <div class="form-group">
                        <p>L2K: <span id="l2k"></span></p>
                        </div>
                        <div class="form-group">
                        <p>L4K: <span id="l4k"></span></p>
                        </div>


                    </div><!--exam-data-new ends-->
                </div>


      </div>

    </div>
  </div>
</div>


       </div><!--.container ends-->


       <!-- jQuery first, then Popper.js, then Bootstrap JS -->
       <script src="{{asset('/js/jquery.js')}}"></script>
       <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
       <script src="{{asset('/js/bootstrap.min.js')}}"></script>
         <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
       <script src="{{asset("/js/chart.js")}}"></script>
       <script src="{{asset('/js/cleave.min.js')}}"></script>
       <script src="{{asset('/js/selectize.js')}}"></script>


<script>


    var cleave = new Cleave('#dob', {
    date: true,
    delimiter: '/',
    datePattern: ['m', 'd', 'Y']
});

$('#nurse').selectize({
    create: true,
    sortField: 'text'
});


function setNurse(){
  sessionStorage.setItem('nurse', $("#nurse").val());
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
      $('#students2').html(childs.student_data);
      sessionStorage.setItem("school", $('#search_school').val());
      sessionStorage.setItem("district", $('#search_district').val());
      $("#search").attr('placeholder', sessionStorage.getItem('school')+ ' in ' + sessionStorage.getItem('district') + ' district');
      $("#mailcsv").attr('href', '/mailcsv/'+sessionStorage.getItem('school')+'/'+sessionStorage.getItem('nurse'));
      $("#hearingURL").attr('href', '/hearing-exam/'+sessionStorage.getItem('district')+'/'+sessionStorage.getItem('school'));
      $("#visionBatch").attr('href', '/export-vision-batches/'+sessionStorage.getItem('district')+'/'+sessionStorage.getItem('school'));
      $("#hearingBatch").attr('href', '/export-hearing-batches/'+sessionStorage.getItem('district')+'/'+sessionStorage.getItem('school'));
      $("#studentModal").modal('show');
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
      $('#students2').html(childs.student_data);

   }
 });
}

function findName2() {
  // Declare variables
  var input, filter, ul, li, a, i, txtValue, numValue;
  input = document.getElementById('search2');
  filter = input.value.toUpperCase();
  ul = document.getElementById("students2");
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
      $("#mailcsv").attr('href', '/mailcsv/'+sessionStorage.getItem('school')+'/'+sessionStorage.getItem('nurse'));
      $('#school').attr('placeholder', sessionStorage.getItem('school'));
      $('#district').attr('placeholder', sessionStorage.getItem('district'));
      $("#studentModal").modal('show');
    }
    if(!sessionStorage.getItem('bilateral')){
        $("#bilateral-button").addClass('btn btn-danger');
    } else {
          $("#bilateral-button").addClass('btn btn-success');
    }

    if(sessionStorage.getItem('nurse')){
        document.getElementById("nurse-selectized").value = sessionStorage.getItem('nurse');
        document.getElementById("nurse-selectized").innerHTML = sessionStorage.getItem('nurse');
    }
  $("#hearingURL").attr('href', '/hearing-exam/'+sessionStorage.getItem('district')+'/'+sessionStorage.getItem('school'));
  $("#visionBatch").attr('href', '/export-vision-batches/'+sessionStorage.getItem('district')+'/'+sessionStorage.getItem('school'));
  $("#hearingBatch").attr('href', '/export-hearing-batches/'+sessionStorage.getItem('district')+'/'+sessionStorage.getItem('school'));
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
  location.reload();
}

function studentCount(){
  $.ajax({
    method: "GET",
    url: "{{route('studentCount')}}",
    data:{
      school: sessionStorage.getItem('school'),
      district: sessionStorage.getItem('district')
    },
    success: function(data){
      $("#total").html(data.total);
    }
  });
}

function deleteStudent(){
  var r = confirm("Are you sure you want to delete this student?");
  if(r == true && $("#fname").val() !=""){
  $.ajax({
    url: "{{route('deleteStudent')}}",
    data: {
      studentID: $("#student_id").val(),
    },
    success: function(){
      location.reload();
    }
  });
}
}

$(document).on('keydown', function(e){
  if(e.which == 36){
    $("#studentModal").modal('toggle');
    $("#search2").prop('autofocus');
    // alert('good');
  }
})



</script>



    <!-- Optional JavaScript -->


  </body>
</html>
