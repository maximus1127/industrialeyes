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
      <th align = 'left'>Nurse</th>
    </tr>
    @foreach($students as $student)
      @php
        $score = array('20/40', '20/50', '20/60', '20/70', '20/80', '20/100', '20/200', '20/400');
        $score2 = array('20/50', '20/60', '20/70', '20/80', '20/100', '20/200', '20/400');
        $grade = array('1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12');
        $grade2 = array('-1', '0', 'tk', 'k', 'TK', 'K', 'Tk');

      @endphp
      @if(in_array($student->grade, $grade))
        @if(in_array($student->od_dist, $score) || in_array($student->os_dist, $score) || in_array($student->ou_dist, $score))
      <tr>
        <td>{{$student->fname.' '.$student->lname}}</td>
        <td>{{$student->student_number}}</td>
        <td>{{$student->district}}</td>
        <td>{{$student->school}}</td>
        <td>{{$student->last_edited}}</td>
        <td>Failed</td>
        <td>{{$student->ou_color}}</td>
        <td>{{$student->nurse}}</td>
      </tr>
          @endif
      @elseif(in_array($student->grade, $grade2))
        @if(in_array($student->od_dist, $score2) || in_array($student->os_dist, $score2) || in_array($student->ou_dist, $score2))
      <tr>
        <td>{{$student->fname.' '.$student->lname}}</td>
        <td>{{$student->student_number}}</td>
        <td>{{$student->district}}</td>
        <td>{{$student->school}}</td>
        <td>{{$student->last_edited}}</td>
        <td>Failed</td>
        <td>{{$student->ou_color}}</td>
        <td>{{$student->nurse}}</td>
      </tr>
          @endif


      @endif
@endforeach
  </table>


</body>
</html>
