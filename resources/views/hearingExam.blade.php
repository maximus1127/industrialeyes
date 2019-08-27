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

             .hearing_line{
               padding-bottom: 30px;
               border-bottom: 1px gray solid;
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




 </div>
 <br />
     <div class="container-fluid">
   <br>

         <div class="chartForm">
            <div class="row">
              <div class="col-md-4 d-inline-block align-top">
           <div class="leftSideBar">



             <div class="searh-box"><input  type="text" onkeyup="findName()" id="search" name="search" placeholder="Search" class="form-control"/></div>

             <div class="students-list" style="max-height: 500px;">
                    <ul id="students">


                            @foreach($students as $student)
                                <li class="student_list" data-fname = "{{$student->fname}}" data-lname = "{{$student->lname}}" data-identify = "{{$student->id}}"  data-number = "{{$student->student_number}}"  onclick="addTestee(this)">
                                  {{$student->fname.' '.$student->lname}}
                                </li>
                            @endforeach

                     </ul>

             </div>


           </div>
            </div>
           <div class="main-form-content col-md-8 d-inline-block align-top">


                {{-- <h3>Student Data</h3> --}}
                <hr>
           <div class="content" style = "font-size: 20px;">
             <form class="exam_data" method="post" action = "{{route('submitHearingExam')}}">
               <button type="submit" class="btn btn-primary">Submit All Exams</button>
                   @csrf
                   <div id="hearing-rows">




                   </div>









             </div>

           </div><!--/ .main-form-content-->

            </div><!--row ends-->



          </div>



</form>
       </div><!--.container ends-->


       <!-- jQuery first, then Popper.js, then Bootstrap JS -->
       <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script>
       <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
       <script src="{{asset('/js/bootstrap.min.js')}}"></script>


<script>

function remove(e){
  $("#studentLine"+e).remove();
}

function pass(e){
  var h = $("#studentLine"+e).find('.hearing-dropdown').val("25");

}

function back(){
  window.history.back();
}



var studentCount = 0;
function addTestee(e){
  studentCount ++;
  $(e).remove();
  if(studentCount < 11){
  $('#hearing-rows').append(`
     <div class="hearing_line" id="studentLine${studentCount}">
     <div class="form-inline">
     <div class = 'remove' onclick="remove(${studentCount})">X</div>
     <div class = 'pass' onclick = 'pass(${studentCount})'>	&#10004;</div>
     <p style="background-color: #e8e5e5; padding: 10px; border-radius: 6px;">
     <strong>${$(e).data('fname')} ${$(e).data('lname')}</strong>

     </p>
     </div>

      <input type='hidden' name='studentID[]' value= '${$(e).data('identify')}' />
       <div class="form-inline">
       <label for="r1k">R1k</label>
       <select type="text" class="form-control hearing-dropdown" name="r1k[]" id="r1k">
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

       <div class="form-inline">
       <label for="r2k">R2k</label>
       <select type="text" class="form-control hearing-dropdown" name="r2k[]" id="r2k">
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
       <div class="form-inline">
       <label for="r4k">R4k</label>
       <select type="text" class="form-control hearing-dropdown" name="r4k[]" id="r4k">
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

       <div class="form-inline" style="padding-left: 80px;">
       <label for="l1k">L1k</label>
       <select type="text" class="form-control hearing-dropdown" name="l1k[]" id="l1k">
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
       <div class="form-inline">
       <label for="l2k">L2k</label>
       <select type="text" class="form-control hearing-dropdown" name="l2k[]" id="l2k">
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
       <div class="form-inline">
       <label for="l4k">L4k</label>
       <select type="text" class="form-control hearing-dropdown" name="l4k[]" id="l4k">
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
       </div>
     </div>`);
   }
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






</script>



    <!-- Optional JavaScript -->


  </body>
</html>
