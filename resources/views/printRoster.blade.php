<html>
<head>
  <style>
  tr:nth-child(even) {
    background-color: #f2f2f2
  }
  body{
    margin: auto;
    width: 80%;
  }
  </style>
</head>

<body >


  <table style="width:100%;">
    <tr>
      <th align = "left">Student Name</th>
      <th align = "left">Student ID</th>
      <th align = "left">District</th>
      <th align = "left">School</th>
      <th align = "left">Test Date/Time</th>
      <th align = "left">Vision</th>
      <th align = "left">Color</th>
      <th>Nurse</th>
    </tr>
    @foreach($students as $student)
      @php
        $grade = array('20/40', '20/50', '20/60', '20/80', '20/100', '20/200', '20/400');
      @endphp
    <tr>
      <td>{{$student->fname.' '.$student->lname}}</td>
      <td>{{$student->student_number}}</td>
      <td>{{$student->district}}</td>
      <td>{{$student->school}}</td>
      <td>{{$student->updated_at}}</td>
      @if(in_array($student->od_dist, $grade) || in_array($student->os_dist, $grade) || in_array($student->ou_dist, $grade))
      <td>Failed</td>
    @else
      <td>
        Passed
      </td>
    @endif

      <td>{{$student->ou_color}}</td>
      <td>{{$student->nurse}}</td>
    </tr>
@endforeach
  </table>


</body>
</html>
