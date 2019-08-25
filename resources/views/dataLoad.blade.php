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

        form {
            margin: 50px;
        }
    </style>


    <title>Industrial Eyes</title>

</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">Industrial Eyes</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
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
    @if(Session::has('message'))
        <p>{{ Session::get('message') }}</p>
@endif

<!-- Form -->
    <form method='post' action='/uploadFile' enctype='multipart/form-data'>
        {{ csrf_field() }}
        {{-- <input type='file' name='file' class="form-control"> --}}


        <div class="form-group">
            <label for="exampleFormControlFile1">CSV Upload</label>
            <input type="file" name="csv_import" class="form-control-file" id="exampleFormControlFile1">
            <br/><br/>
            <label for="district">What district is this for?</label>
            <input type="text" name="district" class="form-control-file" id="district">
            <br/><br/>
            <input type='submit' name='submit' value='Import' class="btn btn-primary">
        </div>
    </form>
</body>
</html>
