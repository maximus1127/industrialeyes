<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
<link rel="stylesheet" href="{{asset('/css/bootstrap.min.css')}}" crossorigin="anonymous">
    <style>
    #testDisplay {
      position: absolute;
      width: 100%;
      height: 90%;
      display: table;
      top: 3%;
      bottom: 0;
      left: 0;
      right:0;
    }
    #content {
      display: table-cell;
      text-align: center;
      vertical-align: middle;
    }
    @font-face{
    font-family: 'Sloan';
    src: url('/font/Sloan.ttf') format('truetype');
    }
    #patient1{
    font-family: 'Sloan';
    letter-spacing: .8em;
    }
    .tumble400 {

    font-size: 2000%;

  }

  .tumble300 {

    font-size: 1500%;

  }

  .tumble200 {

    font-size: 1000%;

  }

  .tumble100 {
    text-align: center;
    padding: 20px 0;
    margin: 0;
    font-size: 500%;

  }

  .tumble80 {
    padding: 20px 0;
    margin: 0;
    font-size: 400%;
  }

  .tumble70 {
    padding: 20px 0;
    margin: 0;
    font-size: 350%;
  }

  .tumble60 {
    padding: 20px 20px;
    margin: 0;
    font-size: 300%;


  }

  .tumble50 {
    padding: 20px 20px;
    margin: 0;
    font-size: 250%;


  }

  .tumble40 {
    padding: 20px 20px;
    margin: 0;
    font-size: 200%;

  }

  .tumble30 {
    padding: 20px 20px;
    margin: 0;
    font-size: 150%;

  }

  .tumble25 {
    padding: 20px 20px;
    margin: 0;
    font-size: 125%;


  }

  .tumble20 {
    padding: 20px 20px;
    margin: 0;
    font-size: 100%;
  }

  #letterSize{
    bottom: 0;
    left: 0;
    position: absolute;
    font-weight: bolder;
    font-size: 18pt;
    float: left;
  }

  #page{
    bottom: 0;
    right: 10px;
    position: absolute;
    font-weight: bolder;
    font-size: 18pt;
    float: left;
  }
  #currentExam{
    bottom: 0;
    left: 0;
    position: fixed;
    font-weight: bolder;
    font-size: 18pt;
    float: left;
  }

  img {
    max-width: 30%;
    max-height: 30%;
    min-width: 10%;

  }



    </style>

  </head>
  <body onload="randomize()" class="container">
    <div id="testDisplay">
      <div id="content">


        <div id="patient1"></div>


      </div>

      <p id="currentExam">
        Both Eyes
      </p>
      <p id="letterSize"></p>
        <p id="page">2ft</p>
    </div>


    {{-- <script src="{{asset("/js/jquery.js")}}"></script> --}}
    <script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>
    <script>
    var student_responses = [];
    var progress = 0;
    var sixSize = {{$calibration->size}};

    var letters = ["C", "D", "H", "K", "N", "O", "R", "S", "V", "Z"];
    var numbers = ["1", "2", "3", "4", "5", "6", "7", "8", "9" , "5"];
    var ees = ["d","j","i","e", "d","j","i","e","i","j"];
    var pictures = ["k", "h", "f", "g", "b", "c", "k", "h", "f", "g", "b", "c"];
    var sizes = ['tumble20', 'tumble25', 'tumble30', 'tumble40', 'tumble50', 'tumble60', 'tumble70', 'tumble80', 'tumble100', 'tumble200', 'tumble300', 'tumble400'];
    var images = ['1.jpg', '2.jpg', '3.jpg', '4.jpg', '5.jpg', '6.jpg', '7.jpg', '8.jpg', '9.jpg', '10.jpg', '11.jpg', '12.jpg', '13.jpg', '14.jpg', '15.jpg', '16.jpg', '17.jpg']

    var selection = letters;
    var colorPassing = 0;
    var currentSize = 2;
    var currentImage = 0;
    var loopCount = 5;
    var single = false;
    $("#patient1").addClass(sizes[currentSize]);

    function setSingle(){
      single = !single;
      console.log(single);
    }
    function loopSet(){
    if ($('#patient1').hasClass('tumble400')){
      loopCount = 1;
    } else if ($('#patient1').hasClass('tumble200') && single == false) {
      loopCount = 3;
    } else if ($('#patient1').hasClass('tumble100') && single == false) {
      loopCount = 4;
    } else if ($('#patient1').hasClass('tumble300')) {
      loopCount = 1;
    } else if(single == true){
      loopCount = 1;
    } else {
      loopCount = 5;
    }
  }
  function showImages(){
    if (currentImage < 5){
    $('#patient1').html( "<img src=/images/" + images[currentImage] + ">");
        currentImage++;
        console.log(currentImage);
    $('#letterSize').html("");
      $('#page').html("");
        $('#currentExam').html("");
        console.log(progress);
  } else {
    $('body').html(`
      <div class="container">
        <h1>{{$student->fname.' '.$student->lname}}</h1>
      </div>
      <div class="row mt20" >
        <div class="col-md-4 od-group">
            <h5>Right</h5>
        <div class="exam-data-new od-background">
          <div class="form-group">
            <label for="od_dist">OD Distance</label>
            <input type="text" class="form-control" name="od_dist" id="od_dist" value="${student_responses[1]}">
          </div>

          </div><!--exam-data-new ends-->
        </div> <!--col-md-4-->
        <div class="col-md-4">
                <h5>Both</h5>
                <div class="exam-data-new ou-background">
                <div class="form-group">
                  <label for="ou_dist">OU Distance</label>
                  <input type="text" class="form-control" name="ou_dist" id="ou_dist" value="${student_responses[3]}">
                </div>
                <div class="form-group">
                    <label for="ou_near">OU Near</label>
                    <input type="text" class="form-control" name="ou_near" id="ou_near" value="${student_responses[0]}">
                    <label for="ou_color">Color</label>
                    <input type="text" class="form-control" name="color" id="ou_color" value="${colorPassing >=3? 'Pass':'Fail'}">
                  </div>
              </div>
        </div>

        <div class="col-md-4 os-group">
                <h5>Left</h5>
            <div class="exam-data-new os-background">
                <div class="form-group">
                <label for="os_dist">OS Distance</label>
                <input type="text" class="form-control" name="os_dist" id="os_dist" value="${student_responses[2]}">
                </div>
            </div>
        </div>
        <div class="row" style="width: 100%">
          <div class="col-md-4">
            <input type="checkbox" style = "height: 20px; width: 20px;" onchange="addNote(this)" name="note21" value="Wears Glasses. "> Wears Glasses<br>
            <input type="checkbox" style = "height: 20px; width: 20px;" onchange="addNote(this)" name="note1" value="Language Barrier. "> Language Barrier<br>
            <input type="checkbox" style = "height: 20px; width: 20px;" onchange="addNote(this)" name="note2" value="Uncooperative. "> Uncooperative<br>
            <input type="checkbox" style = "height: 20px; width: 20px;" onchange="addNote(this)" name="note3" value="Immature. "> Immature<br>
            <input type="checkbox" style = "height: 20px; width: 20px;" onchange="addNote(this)" name="note4" value="Blurring. "> Blurring<br>
            <input type="checkbox" style = "height: 20px; width: 20px;" onchange="addNote(this)" name="note5" value="Blinking / Squinting. "> Blinking / Squinting<br>
            <input type="checkbox" style = "height: 20px; width: 20px;" onchange="addNote(this)" name="note6" value="Straining. "> Straining<br>
          </div>
          <div class="col-md-4">
          <input type="checkbox" style = "height: 20px; width: 20px;" onchange="addNote(this)" name="note7" value="Eyes Water / Red. "> Eyes Water / Red<br>
          <input type="checkbox" style = "height: 20px; width: 20px;" onchange="addNote(this)" name="note8" value="Eyes Cross / Wandering. "> Eyes Cross / Wandering<br>
          <input type="checkbox" style = "height: 20px; width: 20px;" onchange="addNote(this)" name="note9" value="Does not have glasses at exam. "> Does not have glasses at exam<br>
          <input type="checkbox" style = "height: 20px; width: 20px;" onchange="addNote(this)" name="note10" value="Wore glasses previously. "> Wore glasses previously<br>
          <input type="checkbox" style = "height: 20px; width: 20px;" onchange="addNote(this)" name="note11" value="Headaches. "> Headaches<br>
          <input type="checkbox" style = "height: 20px; width: 20px;" onchange="addNote(this)" name="note12" value="Cold / Congested. "> Cold / Congested<br>
          <input type="checkbox" style = "height: 20px; width: 20px;" onchange="addNote(this)" name="note13" value="Recent or present earaches. "> Recent or present earaches<br>
          </div>
          <div class="col-md-4">
          <input type="checkbox" style = "height: 20px; width: 20px;" onchange="addNote(this)" name="note14" value="Reports history of ear problems. "> Reports history of ear problems<br>
          <input type="checkbox" style = "height: 20px; width: 20px;" onchange="addNote(this)" name="note15" value="Reports ringing or head noises. "> Reports ringing or head noises<br>
          <input type="checkbox" style = "height: 20px; width: 20px;" onchange="addNote(this)" name="note16" value="Legal pass Ck 500 Hz. "> Legal pass Ck 500 Hz<br>
          <input type="checkbox" style = "height: 20px; width: 20px;" onchange="addNote(this)" name="note17" value="Reports awareness problem. "> Reports awareness problem<br>
          <input type="checkbox" style = "height: 20px; width: 20px;" onchange="addNote(this)" name="note18" value="Surgery. "> Surgery<br>
          <input type="checkbox" style = "height: 20px; width: 20px;" onchange="addNote(this)" name="note19" value="Exam within last year. "> Exam within last year<br>
          <input type="checkbox" style = "height: 20px; width: 20px;" onchange="addNote(this)" name="note20" value="Known problem / Under medical care. "> Known problem / Under medical care<br>
          </div>
          <label for="notes">Notes</label>
          <input type="text" class="form-control" name="notes" id="notes" value="">
        </div>

      </div>

      <input type="hidden" name="student_id" value="{{$student->id}}" id="student_id" /><br />
      <input type="button" class="btn btn-primary" onclick="wereDone()" value="Submit">
    `);
  }
  }


    function randomize(){
    var display_string = "";
    copy1 = selection.slice();
    for (i=0; i<loopCount; i++){
            loopArray = copy1.splice( Math.floor(Math.random()*copy1.length), 1 );
            display_string += loopArray;
        }
        $("#patient1").html("&nbsp;"+display_string);
        if($("#patient1").hasClass('tumble20')){
          $("#letterSize").html("20/20");
        }
        if($("#patient1").hasClass('tumble25')){
          $("#letterSize").html("20/25");
        }
        if($("#patient1").hasClass('tumble30')){
          if(progress == 0){
          $("#letterSize").html("20/32");
        } else {
          $('#letterSize').html('20/30');
        }
        }
        if($("#patient1").hasClass('tumble40')){
          $("#letterSize").html("20/40");
        }
        if($("#patient1").hasClass('tumble50')){
          $("#letterSize").html("20/50");
        }
        if($("#patient1").hasClass('tumble60')){
          $("#letterSize").html("20/60");
        }
        if($("#patient1").hasClass('tumble70')){
          $("#letterSize").html("20/70");
        }
        if($("#patient1").hasClass('tumble80')){
          $("#letterSize").html("20/80");
        }
        if($("#patient1").hasClass('tumble100')){
          $("#letterSize").html("20/100");
        }
        if($("#patient1").hasClass('tumble200')){
          $("#letterSize").html("20/200");
        }
        if($("#patient1").hasClass('tumble300')){
          $("#letterSize").html("20/300");
        }
        if($("#patient1").hasClass('tumble400')){
          $("#letterSize").html("20/400");
        }
    }




    $('html').on('keydown', function(event){
      if(event.which == 79){
        setSingle();
        loopSet();
        randomize();
      }
      if (event.which == 13){
        randomize();
      }
      if (event.which == 83 ){
        selection = letters;
          randomize();
      };
      if (event.which == 78 ){
        selection = numbers;
        randomize();
      };
      if (event.which == 69 ){
        selection = ees;
          randomize();
      };
      if (event.which == 75 ){
        selection = pictures;
          randomize();
      };


      if (event.which == 88 ){
        var sixSize = {{$calibration->size}};
        $("#content").css('font-size', (sixSize * .6) + 'px');
        $("#page").html("6ft");
      };

      if (event.which == 83 ){
        setSingle();
        console.log('single set');
      };

      if (event.which == 38 ){
        if(currentSize != 11){
        currentSize++;
        $("#patient1").removeClass();
        $("#patient1").addClass(sizes[currentSize]);
      }
      loopSet();
      randomize();
      };

      if (event.which == 40 ){
        if(currentSize != 0){
        currentSize--;
        $("#patient1").removeClass();
        $("#patient1").addClass(sizes[currentSize]);
      }
        loopSet();
        randomize();
      };

      if(event.which == 70 && $('#patient1').length > 0){
        showImages();

      }



      if (event.which == 32 && $('#patient1').length > 0 ){
          if(progress == 0){

            student_responses.push($("#letterSize").html());
            loopSet();
            randomize();
            setSix();
            if($('#letterSize').html() == '20/32'){
              $('#letterSize').html('20/30');
            }
            $("#page").html("6ft");
            $('#currentExam').html('Right Eye Distance');
            progress++;
          }
          else if(progress == 1){
            student_responses.push($("#letterSize").html());
            loopSet();
            randomize();
            $('#currentExam').html('Left Eye Distance');
            progress++;
          }
          else if(progress == 2){
            student_responses.push($("#letterSize").html());
            loopSet();
            randomize();
            $('#currentExam').html('Both Eyes Distance');
            progress++;
          }
          else if (progress == 3){
            if(currentImage == 0){
              student_responses.push($("#letterSize").html());
            }
            showImages();
            colorPassing++;
          }



      };

      if (event.which == 37 || event.which == 39){
        randomize();
      }
      if(event.which == 49 && ($("#patient1").hasClass('tumble20') || $("#patient1").hasClass('tumble25') || $("#patient1").hasClass('tumble30') || $("#patient1").hasClass('tumble40') || $("#patient1").hasClass('tumble50') || $("#patient1").hasClass('tumble60') || $("#patient1").hasClass('tumble70') || $("#patient1").hasClass('tumble80'))) {
        $("#patient1").html("&nbsp;"+letters[1] +letters[2] +letters[3] +letters[4] +letters[5])
      }
      if(event.which == 49 && $("#patient1").hasClass('tumble100')) {
        $("#patient1").html("&nbsp;"+letters[1] +letters[2] +letters[3]);
      }
      if(event.which == 49 && $("#patient1").hasClass('tumble200')) {
        $("#patient1").html("&nbsp;"+letters[1] +letters[2] );
      }
      if(event.which == 49 && ($("#patient1").hasClass('tumble300') || $("#patient1").hasClass('tumble400'))) {
        $("#patient1").html("&nbsp;"+letters[1]);  }
      if(event.which == 50 && ($("#patient1").hasClass('tumble20') || $("#patient1").hasClass('tumble25') || $("#patient1").hasClass('tumble30') || $("#patient1").hasClass('tumble40') || $("#patient1").hasClass('tumble50') || $("#patient1").hasClass('tumble60') || $("#patient1").hasClass('tumble70') || $("#patient1").hasClass('tumble80'))) {
        $("#patient1").html("&nbsp;"+letters[3] +letters[1]+letters[9] +letters[6] +letters[4])
      }
      if(event.which == 50 && $("#patient1").hasClass('tumble100')) {
        $("#patient1").html("&nbsp;"+letters[3] +letters[1]+letters[9]);
      }
      if(event.which == 50 && $("#patient1").hasClass('tumble200')) {
        $("#patient1").html("&nbsp;"+letters[3] +letters[1] );
      }
      if(event.which == 50 && ($("#patient1").hasClass('tumble300') || $("#patient1").hasClass('tumble400'))) {
        $("#patient1").html("&nbsp;"+letters[3]);  }
      if(event.which == 51 && ($("#patient1").hasClass('tumble20') || $("#patient1").hasClass('tumble25') || $("#patient1").hasClass('tumble30') || $("#patient1").hasClass('tumble40') || $("#patient1").hasClass('tumble50') || $("#patient1").hasClass('tumble60') || $("#patient1").hasClass('tumble70') || $("#patient1").hasClass('tumble80'))) {
        $("#patient1").html("&nbsp;"+letters[1] +letters[8]+letters[0]+letters[4]+letters[7])
      }
      if(event.which == 51 && $("#patient1").hasClass('tumble100')) {
        $("#patient1").html("&nbsp;"+letters[1] +letters[8] +letters[0] );
      }
      if(event.which == 51 && $("#patient1").hasClass('tumble200')) {
        $("#patient1").html("&nbsp;"+letters[1] +letters[8] );
      }
      if(event.which == 51 && ($("#patient1").hasClass('tumble300') || $("#patient1").hasClass('tumble400'))) {
        $("#patient1").html("&nbsp;"+letters[1]);  }
      if(event.which == 52 && ($("#patient1").hasClass('tumble20') || $("#patient1").hasClass('tumble25') || $("#patient1").hasClass('tumble30') || $("#patient1").hasClass('tumble40') || $("#patient1").hasClass('tumble50') || $("#patient1").hasClass('tumble60') || $("#patient1").hasClass('tumble70') || $("#patient1").hasClass('tumble80'))) {
        $("#patient1").html("&nbsp;"+letters[2] +letters[6] + letters[7] + letters[3] + letters[9])
      }
      if(event.which == 52 && $("#patient1").hasClass('tumble100')) {
        $("#patient1").html("&nbsp;"+letters[2] +letters[6] + letters[7] + " ");
      }
      if(event.which == 52 && $("#patient1").hasClass('tumble200')) {
        $("#patient1").html("&nbsp;"+letters[2] +letters[6] + " ");
      }
      if(event.which == 52 && ($("#patient1").hasClass('tumble300') || $("#patient1").hasClass('tumble400'))) {
        $("#patient1").html("&nbsp;"+letters[2]);  }
      if(event.which == 53 && ($("#patient1").hasClass('tumble20') || $("#patient1").hasClass('tumble25') || $("#patient1").hasClass('tumble30') || $("#patient1").hasClass('tumble40') || $("#patient1").hasClass('tumble50') || $("#patient1").hasClass('tumble60') || $("#patient1").hasClass('tumble70') || $("#patient1").hasClass('tumble80'))) {
        $("#patient1").html("&nbsp;"+letters[7] +letters[2] + letters[6] + letters[1] + letters[8] + " ")
      }
      if(event.which == 53 && $("#patient1").hasClass('tumble100')) {
        $("#patient1").html("&nbsp;"+letters[7] +letters[2] + letters[6] + " ");
      }
      if(event.which == 53 && $("#patient1").hasClass('tumble200')) {
        $("#patient1").html("&nbsp;"+letters[7] +letters[2] + " ");
      }
      if(event.which == 53 && ($("#patient1").hasClass('tumble300') || $("#patient1").hasClass('tumble400'))) {
        $("#patient1").html("&nbsp;"+letters[7]);  }
      if(event.which == 54 && ($("#patient1").hasClass('tumble20') || $("#patient1").hasClass('tumble25') || $("#patient1").hasClass('tumble30') || $("#patient1").hasClass('tumble40') || $("#patient1").hasClass('tumble50') || $("#patient1").hasClass('tumble60') || $("#patient1").hasClass('tumble70') || $("#patient1").hasClass('tumble80'))) {
        $("#patient1").html("&nbsp;"+letters[2] +letters[4] + letters[8] + letters[5] + letters[9] + " ")
      }
      if(event.which == 54 && $("#patient1").hasClass('tumble100')) {
        $("#patient1").html("&nbsp;"+letters[2] +letters[4] + letters[8] + " ");
      }
      if(event.which == 54 && $("#patient1").hasClass('tumble200')) {
        $("#patient1").html("&nbsp;"+letters[2] +letters[4] + " ");
      }
      if(event.which == 54 && ($("#patient1").hasClass('tumble300') || $("#patient1").hasClass('tumble400'))) {
        $("#patient1").html("&nbsp;"+letters[2]);  }
      if(event.which == 55 && ($("#patient1").hasClass('tumble20') || $("#patient1").hasClass('tumble25') || $("#patient1").hasClass('tumble30') || $("#patient1").hasClass('tumble40') || $("#patient1").hasClass('tumble50') || $("#patient1").hasClass('tumble60') || $("#patient1").hasClass('tumble70') || $("#patient1").hasClass('tumble80'))) {
        $("#patient1").html("&nbsp;"+letters[0] +letters[1] + letters[4] + letters[6] + letters[7] + " ")
      }
      if(event.which == 55 && $("#patient1").hasClass('tumble100')) {
        $("#patient1").html("&nbsp;"+letters[0] +letters[1] + letters[4] + " ");
      }
      if(event.which == 55 && $("#patient1").hasClass('tumble200')) {
        $("#patient1").html("&nbsp;"+letters[0] +letters[1] + " ");
      }
      if(event.which == 55 && ($("#patient1").hasClass('tumble300') || $("#patient1").hasClass('tumble400'))) {
        $("#patient1").html("&nbsp;"+letters[0]);  }
      if(event.which == 56 && ($("#patient1").hasClass('tumble20') || $("#patient1").hasClass('tumble25') || $("#patient1").hasClass('tumble30') || $("#patient1").hasClass('tumble40') || $("#patient1").hasClass('tumble50') || $("#patient1").hasClass('tumble60') || $("#patient1").hasClass('tumble70') || $("#patient1").hasClass('tumble80'))) {
        $("#patient1").html("&nbsp;"+letters[8] +letters[9] + letters[4] + letters[7] + letters[0] + " ")
      }
      if(event.which == 56 && $("#patient1").hasClass('tumble100')) {
        $("#patient1").html("&nbsp;"+letters[8] +letters[9] + letters[4] + " ");
      }
      if(event.which == 56 && $("#patient1").hasClass('tumble200')) {
        $("#patient1").html("&nbsp;"+letters[8] +letters[9] + " ");
      }
      if(event.which == 56 && ($("#patient1").hasClass('tumble300') || $("#patient1").hasClass('tumble400'))) {
        $("#patient1").html("&nbsp;"+letters[8]);  }
      if(event.which == 57 && ($("#patient1").hasClass('tumble20') || $("#patient1").hasClass('tumble25') || $("#patient1").hasClass('tumble30') || $("#patient1").hasClass('tumble40') || $("#patient1").hasClass('tumble50') || $("#patient1").hasClass('tumble60') || $("#patient1").hasClass('tumble70') || $("#patient1").hasClass('tumble80'))) {
        $("#patient1").html("&nbsp;"+letters[9] +letters[3] + letters[1] + letters[8] + letters[2] + " ")
      }
      if(event.which == 57 && $("#patient1").hasClass('tumble100')) {
        $("#patient1").html("&nbsp;"+letters[9] +letters[3] + letters[1] + " ");
      }
      if(event.which == 57 && $("#patient1").hasClass('tumble200')) {
        $("#patient1").html("&nbsp;"+letters[9] +letters[3] + " ");
      }
      if(event.which == 57 && ($("#patient1").hasClass('tumble300') || $("#patient1").hasClass('tumble400'))) {
        $("#patient1").html("&nbsp;"+letters[9]);
      }
    });



function setNear(){
    var smallLine = {{$calibration->size}};
    $("#content").css('font-size', (smallLine * .2) + "px");
}
function setSix(){
    var smallLine = {{$calibration->size}};
    $("#content").css('font-size', (smallLine * .6) + "px");
}

$(document).ready(function(){
      setNear();
    });

function wereDone(){
  $.ajax({
    url: "{{route('saveExam4')}}",
    type: 'GET',
    data:{
      oddist: $('#od_dist').val(),
      osdist: $('#os_dist').val(),
      ounear: $('#ou_near').val(),
      oudist: $('#ou_dist').val(),
      color: $("#ou_color").val(),
      notes: $("#notes").val(),
      studentid: $('#student_id').val()
    },
    success: function(data){
      if(data == 'saved'){
      window.opener.reload();
      window.close();
    } else {
      alert("Could note save data.")
    }
    },
    error: function(){
      alert("Could not save exam");
    }
  });
}


function addNote(e){

var note = $(e).val();
var notebox = $("#notes");
note = notebox.val() + note;
notebox.val(note);

}


    </script>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
   <script src="{{asset('/js/bootstrap.min.js')}}"></script>
         <script src="{{asset("/js/chart.js")}}"></script>
  </body>
</html>
