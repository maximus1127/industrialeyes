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
    }
    .tumble400 {

    font-size: 2000%;

  }

  .tumble300 {

    font-size: 1500%;

  }

  .tumble200 {

    font-size: 1000%;
    letter-spacing: .3em;

  }

  .tumble100 {
    text-align: center;
    padding: 20px 0;
    margin: 0;
    font-size: 500%;
    letter-spacing: .3em;

  }

  .tumble80 {
    padding: 20px 0;
    margin: 0;
    font-size: 400%;
    letter-spacing: .35em;

  }

  .tumble70 {
    padding: 20px 0;
    margin: 0;
    font-size: 350%;
    letter-spacing: .3em;
  }

  .tumble60 {
    padding: 20px 20px;
    margin: 0;
    font-size: 300%;
    letter-spacing: .3em;


  }

  .tumble50 {
    padding: 20px 20px;
    margin: 0;
    font-size: 250%;
    letter-spacing: .25em;


  }

  .tumble40 {
    padding: 20px 20px;
    margin: 0;
    font-size: 200%;
    letter-spacing: .2em;
;
  }

  .tumble30 {
    padding: 20px 20px;
    margin: 0;
    font-size: 150%;
    letter-spacing: .15em;

  }

  .tumble25 {
    padding: 20px 20px;
    margin: 0;
    font-size: 125%;
    letter-spacing: .125em;


  }

  .tumble20 {
    padding: 20px 20px;
    margin: 0;
    font-size: 100%;
    letter-spacing: .1em;

  }

  #letterSize{
    bottom: 0;
    left: 0;
    position: fixed;
    font-weight: bolder;
    font-size: 18pt;
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


      <p id="letterSize">

      </p>
    </div>

       <script src="{{asset('/js/jquery.js')}}"></script>
    <script>


    var letters = ["C", "D", "H", "K", "N", "O", "R", "S", "V", "Z"];
    var numbers = ["1", "2", "3", "4", "5", "6", "7", "8", "9" , "5"];
    var ees = ["d","j","i","e", "d","j","i","e","i","j"];
    var pictures = ["k", "h", "f", "g", "b", "c", "k", "h", "f", "g", "b", "c"];
    var sizes = ['tumble20', 'tumble25', 'tumble30', 'tumble40', 'tumble50', 'tumble60', 'tumble70', 'tumble80', 'tumble100', 'tumble200', 'tumble300', 'tumble400'];
    var images = ['ishihara5.PNG', 'ishihara8.PNG', 'ishihara29.PNG', 'ishihara74.PNG','ishihara3.PNG','ishihara6.PNG','ishihara7.PNG','ishihara12.PNG','ishihara15.PNG','ishihara16.PNG','ishihara26.PNG','ishihara42.PNG','ishihara45.PNG','ishihara73.PNG', 'astigmatism.png'];






  var currentImage = 0;

  function showImages(){
    if (currentImage <=14){

    $('#patient1').html( "<img src=/images/" + images[currentImage] + ">");
        currentImage++;
    $('#letterSize').html("");
  } else {
    window.close();
  }
  }






    var student_responses = [];

    $('html').on('keydown', function(event){



      if (event.which == 32 ){
          showImages();
      };
      if (event.which == 27){
        window.close();
      }



    });




    $(document).ready(function(){

    showImages();

    });



    </script>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
      <script src="{{asset("/js/chart.js")}}"></script>
  </body>
</html>
