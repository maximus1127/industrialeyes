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
         table{
           border: 2px solid black;
         }

         td{
           border: 1px solid gray;
         }

         img {
     display: block;
     margin-left: 215px;
     height: 50px;
   }



         </style>


       <title>Industrial Eyes</title>

     </head>
     <body style="width: 80%; margin: auto;">




       <div>
              <img src="{{asset('/images/industriallogo.PNG')}}" id="logo"/>
       </div>

       <div style="float: left; position: relative;">


       <table style="height: 97px;" border="2px" width="700">
<tbody>
<tr>
<td style="width: 342px;"><strong>Student:</strong> {{$student->fname.' '.$student->lname}}</td>
<td style="width: 342px;"><strong>District:</strong> {{$student->district}}</td>
</tr>
<tr>
<td style="width: 342px;"><strong>ID#:</strong> {{$student->student_number}}</td>
<td style="width: 342px;"><strong>School:</strong> {{$student->school}}</td>
</tr>
<tr>
<td style="width: 342px;"><strong>Date:</strong> {{Carbon\Carbon::parse($student->last_edited)->format('m/d/Y')}}</td>
<td style="width: 342px;"><strong>Teacher:</strong> {{$student->teacher}}</td>
</tr>
<tr>
<td style="width: 342px;"><strong>Nurse:</strong> {{$student->nurse}}</td>
<td style="width: 342px;">&nbsp;</td>
</tr>
</tbody>
</table>
<p>&nbsp;</p>
<h1 style="text-align: center;">Hearing and Vision Summary</h1>
<p>&nbsp;</p>
<table style="width: 303px; float: left;" border="1px">
<tbody>
<tr>
<td style="width: 150px; border: none;"><strong>Distance:</strong>
  @php
    $score = array('20/40', '20/50', '20/60', '20/70', '20/80', '20/100', '20/200', '20/400');
    $score2 = array('20/50', '20/60', '20/70', '20/80', '20/100', '20/200', '20/400');
    $grade = array('1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12');
    $grade2 = array('-1', '0', 'tk', 'k', 'TK', 'K', 'Tk');


  if(in_array($student->grade, $grade)){
    if(in_array($student->od_dist, $score) || in_array($student->os_dist, $score) || in_array($student->ou_dist, $score)){
        echo "Failed";
    } else {
      echo "Passed";
    }
  }
    elseif(in_array($student->grade, $grade2)){
      if(in_array($student->od_dist, $score2) || in_array($student->os_dist, $score2) || in_array($student->ou_dist, $score2)){
      echo "Failed";
    } else {
      echo "Passed";
    }
  }


  @endphp
</td>
<td style="width: 150px; border: none;">&nbsp;</td>
</tr>
<tr>
<td style="width: 150px;"><strong>Right Eye</strong></td>
<td style="width: 150px;">{{$student->od_dist}}</td>
</tr>
<tr>
<td style="width: 150px;"><strong>Left Eye</strong></td>
<td style="width: 150px;">{{$student->os_dist}}</td>
</tr>
<tr>
<td style="width: 150px;"><strong>Both Eyes</strong></td>
<td style="width: 150px;">{{$student->ou_dist}}</td>
</tr>
</tbody>
</table>
<table style="width: 303px; float: left; margin-top: 25px;" border="1px">
<tbody>
<tr>
<td style="width: 150px; border: none;"><strong>Near:</strong>
@php

  if(in_array($student->grade, $grade)){
    if(in_array($student->ou_near, $score)){
        echo "Failed";
    } else {
      echo "Passed";
    }
  }
    elseif(in_array($student->grade, $grade2)){
      if( in_array($student->ou_near, $score2)){
      echo "Failed";
    } else {
      echo "Passed";
    }
  }
  @endphp
</td>
<td style="width: 150px; border: none;">&nbsp;</td>
</tr>

<tr>
<td style="width: 150px;"><strong>Both Eyes</strong></td>
<td style="width: 150px;">{{$student->ou_near}}</td>
</tr>
</tbody>
</table>
<table style="width: 303px; float: left; margin-top: 25px;" border="1px">
<tbody>
<tr>
<td style="width: 150px;"><strong>Color (boys only):</strong></td>
<td style="width: 150px;">{{$student->ou_color}}</td>
</tr>
<tr>
<td style="width: 150px;"><strong>Astigmatism:</strong></td>
<td style="width: 150px;">R: {{$student->od_cyl}} / L: {{$student->os_cyl}}</td>
</tr>
</tbody>
</table>
<table style="width: 303px; float: left; margin-top: 25px;" border="1px">


    <tr>
      <td>Right Ear </td>
      <td>Frequency </td>
      <td>Left Ear </td>
    </tr>
		<tr>
			<td>{{$student->r5k}} </td>
			<td>5k Hertz </td>
			<td>{{$student->l5k}} </td>
		</tr>
		<tr>
			<td>{{$student->r1k}} </td>
			<td>1k Hertz </td>
			<td>{{$student->l1k}} </td>
		</tr>
		<tr>
			<td>{{$student->r2k}} </td>
			<td>2k Hertz </td>
			<td>{{$student->l2k}} </td>
		</tr>
		<tr>
			<td>{{$student->r4k}} </td>
			<td>4k Hertz </td>
			<td>{{$student->l4k}} </td>
		</tr>

	</tbody>

</table>

    @php
    $hearinggrade = array('40', '45', '50', '55', '60', '65', '70', '75', '80', '85', '90', '95', 'NR');
    $chances = 0;
    if(in_array($student->r1k, $hearinggrade)){
      $chances++;
    }
    if(in_array($student->r2k, $hearinggrade)){
      $chances++;
    }
    if(in_array($student->r4k, $hearinggrade)){
      $chances++;
    }
    if(in_array($student->r5k, $hearinggrade)){
      $chances++;
    }
    if(in_array($student->l1k, $hearinggrade)){
      $chances++;
    }
    if(in_array($student->l2k, $hearinggrade)){
      $chances++;
    }
    if(in_array($student->l4k, $hearinggrade)){
      $chances++;
    }
    if(in_array($student->l5k, $hearinggrade)){
      $chances++;
    }
    if($chances > 1){
      echo "FAILED";
    } else {
      echo "PASSED";
    }
  @endphp
</div>
<div style="float: left; position: relative; margin-top: -450px; margin-left: 350px;">

{{-- <p style="padding-left: 30px;">&nbsp;</p> --}}
<table style="height: 295px; margin-left: auto; margin-right: auto; margin-top: -35px;" border="3px" width="290">
<tbody>
<tr>
<td style="width: 310px; text-align: center;"><strong>A Note About Vision Screenings:</strong></td>
</tr>
<tr>
<td style="width: 310px;">
<p>&nbsp;<strong>Myopia&nbsp;</strong>(Nearsightedness):</p>
<p>Children who may be nearsighted and struggling with seeing objects at a distance clearly.</p>
</td>
</tr>
<tr>
<td style="width: 310px;">
<p><strong>&nbsp;Hyperopia&nbsp;</strong>(Farsightedness):</p>
<p>Children who may be farsighted and sturggling with seeing objects that are close to them, especially for reading and writing.</p>
</td>
</tr>
<tr>
<td style="width: 310px;">
<p>&nbsp;<strong>Color:&nbsp;</strong></p>
<p>Children, usually boys, who may not see red and/or green hues accurately. Colorblindness is hereditary, cannot be treated, and should be discussed with a pediatrician.</p>
</td>
</tr>
<tr>
<td style="width: 310px;">
<p>&nbsp;<strong>Astigmatism:</strong></p>
<p>Astigmatism distorts images and can affect vision at all distances, near and far. Astigmatism cannot be seen, it can only be detected by an eye exam.</p>
</td>
</tr>
<tr>
<td style="width: 310px; text-align: center; font-weight: bold;">If your child received a Referral Recommendation Result, please have your child's vision examined by an eye doctor</td>
</tr>
</tbody>
</table>
</div>
<p>&nbsp;</p>
<p><strong>Notes:</strong> {{$student->notes}}</p>
<p>&nbsp;</p>
<p>The screening criteria has been established by the State Department of Health and Education. They are for screening purposes only and are not a replacement for diagnostic tests. If you notice any problems with your child's vision, even after passing a screening test, please consult wiht your pediatrician or family doctor right away.</p>










    <!-- Optional JavaScript -->

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="{{asset('/js/bootstrap.min.js')}}"></script>
    <script src="{{asset("/js/chart.js")}}"></script>
  </body>
</html>
