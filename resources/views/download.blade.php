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

          form{
            margin: 50px;
          }
         </style>


       <title>Industrial Eyes</title>

     </head>
     <body>

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
     <!-- Message -->


     <!-- Form -->
     <form method='get' action='{{route('export')}}' >
       {{ csrf_field() }}
       <div class="form-group">
          <label for="search_district">Delete a single district</label>
          <select  id="search_district" name="search_district"  class="form-control" style="height: 40px;"/>
             <option>
               Select District....
             </option>
              @foreach($districts as $district)
               <option value="{{$district->district}}">
                   {{$district->district}}
               </option>
              @endforeach

          </select>
          <input type='submit' name='submit' value='Go' class="btn btn-primary">
        </div>
     </form>
     <hr>
     <form method='get' action='{{route('deleteSchool')}}' >
       {{ csrf_field() }}
       <div class="form-group">
          <label for="search_school">Delete a single school</label>
          <select  id="search_school" name="search_school"  class="form-control" style="height: 40px;"/>
             <option>
               Select School....
             </option>
              @foreach($schools as $school)
               <option value="{{$school->school}}">
                   {{$school->school}}
               </option>
              @endforeach

          </select>
          <input type='submit' name='submit' value='Go' class="btn btn-primary">
        </div>
     </form>

     <hr />
     <form method='get' action='{{route('deleteDatabase')}}' >
       {{ csrf_field() }}
       <div class="form-group">
          <label for="exampleFormControlFile2">Click below to delete the database</label><br />
          <strong style="color: red">This action cannot be undone. Only proceed if you are certain you want to delete the entire database and prepare this device for a new upload of separate student files.</strong>
          {{-- <input type="date" name="date" class="form-control" id="exampleFormControlFile1"> --}}
          <br /><br />
          <input type='submit' name='submit' value='Delete' class="btn btn-danger">
        </div>
     </form>
  </body>
</html>
