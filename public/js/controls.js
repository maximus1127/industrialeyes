
    var student_responses = [];
      var single = false;

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
      loopCount = 4;
    }
  }

  function setSingle(){
    single = !single;
    console.log(single);
  }

$('html').on('keydown', function(event){
  if(event.which == 79){
    setSingle();
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
  if (event.which == 54 ){
    var sixSize = {{$calibration->size}};
    $("#content").css('font-size', (sixSize * .6) + 'px');
  };
  if (event.which == 88 ){
    setNear();
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

  if (event.which == 32 ){
    student_responses.push($("#letterSize").html());
    opener.fillIn();
    if (student_responses.length == 1){
        $("#currentExam").html('Left Eye Distance');
    } else if (student_responses.length == 2){
        $("#currentExam").html('Both Eyes Distance');
    }
    else if(student_responses.length == 3)
    window.close();

  };
  if (event.which == 37 || event.which == 39){
    randomize();
  }



});
