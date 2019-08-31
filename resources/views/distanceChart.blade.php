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
  max-width: 80%;
  max-height: 80%;
}


    </style>

  </head>
  <body onload="randomize()" class="container">
    <div id="testDisplay">
      <div id="content">


        <div id="patient1"></div>


      </div>

      <p id="currentExam">

      </p>
      <p id="letterSize"></p>
        <p id="page">10ft</p>
    </div>

<script src="{{asset("/js/jquery.js")}}"></script>
    <script>


    var letters = ["&nbspC", "&nbspD", "&nbspH", "&nbspK", "&nbspN", "&nbspO", "&nbspR", "&nbspS", "&nbspV", "&nbspZ"];
    var numbers = ["1", "2", "3", "4", "5", "6", "7", "8", "9" , "5"];
    var ees = ["d","j","i","e", "d","j","i","e","i","j"];
    var pictures = ["k", "h", "f", "g", "b", "c", "k", "h", "f", "g", "b", "c"];
    var sizes = ['tumble20', 'tumble25', 'tumble30', 'tumble40', 'tumble50', 'tumble60', 'tumble70', 'tumble80', 'tumble100', 'tumble200', 'tumble300', 'tumble400'];
    var images = ['ishihara5.PNG', 'ishihara8.PNG', 'ishihara29.PNG', 'ishihara74.PNG', 'astigmatism.png'];

    var selection = letters;
    var currentSize = 0;
    var loopCount = 5;
    var single = false;
    $("#patient1").addClass(sizes[currentSize]);


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
  function setSingle(){
    single = !single;
    console.log(single);
  }


  var currentImage = 0;

  function showImages(){
    if (currentImage <=3){
    currentImage++;
    $('#patient1').html( "<img src=/images/" + images[currentImage] + ">");
    $('#letterSize').html("");
  } else {
    window.close();
  }
  }

    function randomize(){
    var display_string = "";
    copy1 = selection.slice();
    for (i=0; i<loopCount; i++){
            loopArray = copy1.splice( Math.floor(Math.random()*copy1.length), 1 );
            display_string += loopArray;
        }
        $("#patient1").html(display_string);
        if($("#patient1").hasClass('tumble20')){
          $("#letterSize").html("20/20");
        }
        if($("#patient1").hasClass('tumble25')){
          $("#letterSize").html("20/25");
        }
        if($("#patient1").hasClass('tumble30')){
          $("#letterSize").html("20/30");
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




    var student_responses = [];

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
      if (event.which == 187 ){
        grow();
      };
      if (event.which == 189 ){
        shrink();
      };
      if (event.which == 88 ){
        var sixSize = {{$calibration->size}};
        $("#content").css('font-size', (sixSize * .6) + 'px');
      };
      // if (event.which == 50 ){
      //   setNear();
      // };

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

      if (event.which == 32 ){
        randomize();
        if(sessionStorage.getItem('bilateral')){
        student_responses.push($("#letterSize").html());
        opener.fillIn();
        if (student_responses.length == 1){
            $("#currentExam").html('Left Eye Distance');
        } else if (student_responses.length == 2){
            $("#currentExam").html('Both Eyes Distance');
        }
        else if(student_responses.length == 3)
        window.close();
      } else if (!sessionStorage.getItem('bilateral')){
        student_responses.push($("#letterSize").html());
        opener.fillIn();
        if (student_responses.length == 1){
            $("#currentExam").html('Left Eye Distance');
        } else if (student_responses.length == 2){
              window.close();
        }
      }
      };
      if (event.which == 37 || event.which == 39){
        randomize();
      }



    });




    var currentZoom = 20;
    function grow(){
        currentZoom += 1;
        $("#content").css('font-size', currentZoom + 'px');
        $.ajax({
          url: "/insert",
          data:{
            size: currentZoom
          }

        });
    }


    function shrink(){
       currentZoom -= 1;
       $("#content").css('font-size', currentZoom + 'px');
       $.ajax({
         url: "/insert",
         data:{
           size: currentZoom
         }

       });
    }


    $(document).ready(function(){

      $("#currentExam").html('Right Eye Distance');
      $("#content").css('font-size', {{$calibration->size}} + "px");
      console.log({{$calibration->size}});

    });



    </script>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
      <script src="{{asset("/js/chart.js")}}"></script>
  </body>
</html>
