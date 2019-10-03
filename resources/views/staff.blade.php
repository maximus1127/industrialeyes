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
<div class="container" style="margin-top: 30px;">

 <form method="post" action="{{route('add-staff')}}" class="form-group">
@csrf
   <input type="text" id="staff-name" name="staff_name" class="form-control" placeholder="Enter name then select department" autofocus/>
   <select id="department" name="department">
     <option value="Vision">
       Vision
     </option>
     <option value="Hearing">
       Hearing
     </option>
   </select>
   <br />
   <input type="submit" value="Submit" class="btn btn-success"/>
 </form>

 <table class="table">
   <thead>
     <tr>

       <th scope="col">Name</th>
       <th scope="col">Department</th>
       <th scope="col">

       </th>
     </tr>
   </thead>
   <tbody>
     @foreach($staffs as $staff)
     <tr>
       <td>{{$staff->name}}</td>
       <td>{{$staff->department}}</td>
       <td>
         <a href="/remove-staff/{{$staff->id}}">Delete</a>
       </td>
     </tr>
   @endforeach

   </tbody>
 </table>


</div>

<script src="{{asset('/js/jquery.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="{{asset('/js/bootstrap.min.js')}}"></script>
</body>
</html>
