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
           <a class="nav-link" href="#">Upload Data</a>
         </li>
         <li class="nav-item">
           <a class="nav-link" href="#">Download Data</a>
         </li>
       </ul>
     </div>
   </nav>
     <div class="container">
       <form method="post" action="{{route('search')}}">
         @csrf
          <div class="form-group">
            <label for="district">Search</label>
            <input type="text" class="form-control" id="district" placeholder="Search District, School, Teacher, or Student" name="district">
          </div>
          {{-- <div class="form-group">
            <label for="school">School</label>
            <input type="text" class="form-control" id="school" placeholder="Search School" name="school">
          </div>
          <div class="form-group">
            <label for="teacher">Teacher</label>
            <input type="text" class="form-control" id="teacher" placeholder="Search Teacher" name="teacher">
          </div>
          <div class="form-group">
            <label for="student">Student</label>
            <input type="text" class="form-control" id="student" placeholder="Search Student" name="student">
          </div> --}}
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
     </div><!--.container ends-->


       <!-- jQuery first, then Popper.js, then Bootstrap JS -->
       <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
       <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
       <script src="{{asset('/js/bootstrap.min.js')}}"></script>
       <script src="{{asset("/js/chart.js")}}"></script>





    <!-- Optional JavaScript -->


  </body>
</html>
