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
          <label for="exampleFormControlFile1">Click below to download every student with a completed exam</label>
          {{-- <input type="date" name="date" class="form-control" id="exampleFormControlFile1"> --}}
          <br /><br />
          <input type='submit' name='submit' value='Export' class="btn btn-primary">
        </div>
     </form>
     <hr>
     <form method='get' action='{{route('exportRoster')}}' >
       {{ csrf_field() }}
       <div class="form-group">
          <label for="exampleFormControlFile1">Click below to download a pass or fail roster</label>
          <input type="date" name="date" class="form-control" id="exampleFormControlFile1">
          <br /><br />
          <input type='submit' name='submit' value='Download' class="btn btn-primary">
        </div>
     </form>

     <form method='get' action='{{route('adminBatchPrint')}}' >
       @if ($message = Session::get('error'))
       <div class="alert alert-danger alert-block">
         <button type="button" class="close" data-dismiss="alert">×</button>
               <strong>{{ $message }}</strong>
       </div>
       @endif
       {{ csrf_field() }}
       <div class="form-group">
          <label for="exampleFormControlFile1">Click below to download a batch of student reports</label>
          <input type="date" name="date" class="form-control" >
          <br /><br />
          <input type='submit' name='submit' value='Download' class="btn btn-primary">
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
