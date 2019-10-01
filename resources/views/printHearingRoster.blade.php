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

    <tr>
      <td>{{$student->fname.' '.$student->lname}}</td>
      <td>{{$student->student_number}}</td>
      <td>{{$student->district}}</td>
      <td>{{$student->school}}</td>
      <td>{{Carbon\Carbon::parse($student->last_edited)->format('m-d-Y')}}</td>
      <td>{{$student->hearingPassOrFail($student)}}</td>

    </tr>


@endforeach
  </table>


</body>
</html>
