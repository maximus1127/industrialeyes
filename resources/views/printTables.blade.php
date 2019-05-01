<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    {{-- <link rel="stylesheet" href="{{asset('/css/bootstrap.min.css')}}" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('/css/bootstrap-grid.min.css')}}" crossorigin="anonymous"> --}}
         <style>
             html{
                 font-size: 10pt;
             }

             table{
               margin: 30px;
             }


         </style>


       <title>Industrial Eyes</title>

     </head>
     <body style="width: 80%; margin: auto;">

       <div class="row">
         <div class="chartForm">

           <div class="main-form-content col-7 d-inline-block align-top">
           <div class="content">
             <table style="width:100%">
                <tr>
                  <th>Student Name</th>
                  <th>DOB</th>
                  <th>Date of Screening</th>

                </tr>
                <tr>
                  <td>{{$student->fname.' '.$student->lname}}</td>
                  <td>{{Carbon\Carbon::parse($student->dob)->format('m/d/Y')}}</td>
                  <td>{{$student->updated_at->format('m/d/Y')}}</td>
                </tr>

              </table>
              <br /><br />
              <h2>Screening Results</h2>
              <table style="width:100%;">
                 <tr>
                   <th>Right Eye</th>


                 </tr>
                 <tr>
                   <td>Distance:</td>
                   <td>{{$student->od_dist}}</td>
                   <tr>
                     <td>Near:</td>
                     <td>{{$student->od_near}}</td>
                   </tr>
                   <tr>
                     <td>Astigmatism:</td>
                     <td>{{$student->od_cyl}}</td>
                   </tr>
                   <tr>
                     <td>Color:</td>
                     <td>{{$student->od_color}}</td>
                   </tr>

                 </tr>

               </table>
               <table style="width:100%;">
                  <tr>
                    <th>Left Eye</th>


                  </tr>
                  <tr>
                    <td>Distance:</td>
                    <td>{{$student->os_dist}}</td>
                    <tr>
                      <td>Near:</td>
                      <td>{{$student->os_near}}</td>
                    </tr>
                    <tr>
                      <td>Astigmatism:</td>
                      <td>{{$student->os_cyl}}</td>
                    </tr>
                    <tr>
                      <td>Color:</td>
                      <td>{{$student->os_color}}</td>
                    </tr>

                  </tr>

                </table>
                <table style="width:100%;">
                   <tr>
                     <th>Both Eyes</th>


                   </tr>
                   <tr>
                     <td>Distance:</td>
                     <td>{{$student->ou_dist}}</td>
                   </tr>
                     <tr>
                       <td>Near:</td>
                       <td>{{$student->ou_near}}</td>
                     </tr>

                 </table>
             </div>
           </div><!--/ .main-form-content-->


          </div>

         </div><!--.row ends-->









    <!-- Optional JavaScript -->

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="{{asset('/js/bootstrap.min.js')}}"></script>
    <script src="{{asset("/js/chart.js")}}"></script>
  </body>
</html>
