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
      <th align = "left">Hearing</th>

    </tr>
    @foreach($students as $student)
      @php
        $grade = array('40', '45', '50', '55', '60', '65', '70', '75', '80', '85', '90', '95', 'NR');
      @endphp
      @if(in_array($student->r1k, $grade) || in_array($student->r2k, $grade) || in_array($student->r4k, $grade) || in_array($student->r5k, $grade) || in_array($student->l1k, $grade) || in_array($student->l2k, $grade) || in_array($student->l4k, $grade) || in_array($student->l5k, $grade))
    <tr>
      <td>{{$student->fname.' '.$student->lname}}</td>
      <td>{{$student->student_number}}</td>
      <td>{{$student->district}}</td>
      <td>{{$student->school}}</td>
      <td>{{$student->last_edited}}</td>
      <td>Failed</td>

    </tr>
        @endif
@endforeach
  </table>


</body>
</html>
