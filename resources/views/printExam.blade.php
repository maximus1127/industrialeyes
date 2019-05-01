<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('/css/bootstrap.min.css')}}" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('/css/bootstrap-grid.min.css')}}" crossorigin="anonymous">
         <style>
             html{
                 font-size: 10pt;
             }

         </style>


       <title>Industrial Eyes</title>

     </head>
     <body>


     <div class="container">
   <br>
       <div class="row">
         <div class="chartForm">

           <div class="main-form-content col-7 d-inline-block align-top">
           <div class="content">
             <form class="exam_data" method="post" action = "{{route('submitExam')}}">
               <input type="hidden" id="student_id" name="student_id"/>

               @csrf
               <h3>Student Data</h3>
               <hr>
               <div class="row">
                 <div class="col-md-6 col-lg-4">
                     <div class="form-group">
                       <label for="fname">First Name</label>
                       <input type="text" class="form-control" name="fname" id="fname" value="{{$student->fname}}"/>
                     </div>
                 </div>
                 <div class="col-md-6 col-lg-4">
                     <div class="form-group">
                       <label for="lname">Last Name</label>
                       <input type="text" class="form-control" name="lname" id="lname" value="{{$student->lname}}"/>
                     </div>
                 </div>
                 <div class="col-md-6 col-lg-4">
                     <div class="form-group">
                       <label for="dob">Date of Birth</label>
                       <input type="text" class="form-control" name="dob" id="dob" value="{{$student->dob}}"/>
                     </div>
                 </div>
                 <div class="col-md-6 col-lg-4">
                     <div class="form-group">
                       <label for="gender">Gender</label>
                       <input type="text" class="form-control" name="gender" id="gender" value="{{$student->gender}}"/>
                     </div>
                 </div>
                 <div class="col-md-6 col-lg-4">
                     <div class="form-group">
                       <label for="number">Student Number</label>
                       <input type="text" class="form-control" name="number" id="number" value="{{$student->student_number}}"/>
                     </div>
                 </div>
                 <div class="col-md-6 col-lg-4">
                     <div class="form-group">
                       <label for="district">District</label>
                       <input type="text" class="form-control" name="district" id="district" value="{{$student->district}}"/>
                     </div>
                 </div>
                 <div class="col-md-6 col-lg-4">
                     <div class="form-group">
                       <label for="school">School</label>
                       <input type="text" class="form-control" name="school" id="school" value="{{$student->school}}"/>
                 </div>
                 </div>
                 <div class="col-md-6 col-lg-4">
                     <div class="form-group">
                       <label for="teacher">Teacher</label>
                       <input type="text" class="form-control" name="teacher" id="teacher" value="{{$student->teacher}}"/>
                     </div>
                 </div>
               </div><!--/ .row ends-->
             </div>
             <div class="exam">
               <h3>Exam Data</h3>

                 <div class="row">
                   <div class="col-6 od-group">
                     <div class="form-group">
                       <label for="od_dist">Right Eye Distance</label>
                       <input type="text" class="form-control" name="od_dist" id="od_dist" value="{{$student->od_dist}}">
                     </div>
                     <div class="form-group">
                         <label for="od_near">Right Eye Near</label>
                         <input type="text" class="form-control" name="od_near" id="od_near" value="{{$student->od_near}}">
                     </div>
                     <div class="form-group">
                         <label for="od_cyl">Right Eye Astigmatism</label>
                         <input type="text" class="form-control" name="od_cyl" id="od_cyl" value="{{$student->od_cyl}}">
                     </div>
                     <div class="form-group">
                         <label for="od_color">Right Eye Color</label>
                         <input type="text" class="form-control" name="od_color" id="od_color" value="{{$student->od_color}}">
                     </div>
                   </div> <!--col-sm-3-->


                   <div class="col-6 os-group">
                       <div class="form-group">
                         <label for="os_dist">Left Eye Distance</label>
                         <input type="text" class="form-control" name="os_dist" id="os_dist" value="{{$student->os_dist}}">
                       </div>
                       <div class="form-group">
                           <label for="os_near">Left Eye Near</label>
                           <input type="text" class="form-control" name="os_near" id="os_near" value="{{$student->os_near}}">
                       </div>
                       <div class="form-group">
                           <label for="os_cyl">Left Eye Astigmatism</label>
                           <input type="text" class="form-control" name="os_cyl" id="os_cyl" value="{{$student->os_cyl}}">
                       </div>
                       <div class="form-group">
                           <label for="os_cyl">Left Eye Color</label>
                           <input type="text" class="form-control" name="os_color" id="os_color" value="{{$student->os_color}}">
                       </div>
                   </div>
                 </div><!--/ .row ends-->
                   <div class="row">
                     <div class="col-6 offset-sm-3">
                       <div class="form-group">
                         <label for="ou_dist">Both Eyes Distance</label>
                         <input type="text" class="form-control" name="ou_dist" id="ou_dist" value="{{$student->ou_dist}}">
                       </div>
                       <div class="form-group">
                           <label for="ou_near">Both Eyes Near</label>
                           <input type="text" class="form-control" name="ou_near" id="ou_near" value="{{$student->ou_near}}">
                         </div>
                     </div>

                   </div><!--/ .row ends-->

             </form>

             </div>
           </div><!--/ .main-form-content-->


          </div>

         </div><!--.row ends-->
       </div><!--.container ends-->








    <!-- Optional JavaScript -->

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="{{asset('/js/bootstrap.min.js')}}"></script>
    <script src="{{asset("/js/chart.js")}}"></script>
  </body>
</html>
