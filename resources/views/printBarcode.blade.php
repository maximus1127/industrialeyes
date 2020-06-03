<html>
<head>
  <style>

  body{
    margin: auto;
    width: 80%;
  }

  td {
    border-top: 1px solid black;
    border-bottom: 1px solid black;
    padding-top: 50px;
  }

  </style>
</head>

<body>
  <h1>{{$students[0]->school}}</h1>

<table style="width: 100%">
@foreach($students->chunk(2) as $chunk)
  <tr >
    @foreach($chunk as $student)
      <td>
        {!!$student->barcode($student)!!}
          <p>{{$student->lname.', '.$student->fname}}</p>
          <p>Teacher: {{$student->teacher}}</p>
          <p>Grade: {{$student->grade}}</p>
      </td>
    @endforeach
  </tr>
  @endforeach
</table>


</body>
</html>
