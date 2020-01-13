var getAtIt;
function loadStudent(e){

    var fails = ['20/40', '20/50', '20/60', '20/70', '20/80', '20/100', '20/200', '20/300', '20/400'];
    var tester = sessionStorage.getItem('nurseName');

    $(".student_list").css('background-color', 'white');
    $("#fname").val($(e).data('fname'));
    $("#lname").val($(e).data('lname'));
    $("#dob").val($(e).data('dob'));
    $("#gender").val($(e).data('gender'));
    $("#number").val($(e).data('number'));
    $("#school").val($(e).data('school'));
    $("#student_id").val($(e).data('identify'));
    $("#teacher").val($(e).data('teacher'));
    $("#district").val($(e).data('district'));
    $("#od_dist").val($(e).data('oddist'));
    $("#od_near").val($(e).data('odnear'));
    $("#os_dist").val($(e).data('osdist'));
    $("#od_cyl").val($(e).data('odcyl'));
    $("#os_cyl").val($(e).data('oscyl'));
    $("#ou_color").val($(e).data('oucolor'));
    $("#grade").val($(e).data('grade'));
    $("#os_near").val($(e).data('osnear'));
    $("#ou_dist").val($(e).data('oudist'));
    $("#ou_near").val($(e).data('ounear'));
    $("#notes").html($(e).data('notes'));
    $("#r1k").html($(e).data('r1k'));
    $("#r2k").html($(e).data('r2k'));
    $("#r4k").html($(e).data('r4k'));
    $("#r5k").html($(e).data('r5k'));
    $("#l1k").html($(e).data('l1k'));
    $("#l2k").html($(e).data('l2k'));
    $("#l4k").html($(e).data('l4k'));
    $("#l5k").html($(e).data('l5k'));
    if($(e).data('nurse') == ""){
      $("#nurse").val(tester);
    } else {
    $("#nurse").val($(e).data('nurse'));
  }
    $(e).css('background-color', '#11b21c');
    var stunum = $(e).data('identify');
    $('#printExam').attr( 'href','/print/'+ stunum);
    $('#deleteExam').attr( 'href','/delete/'+ stunum);

    if (fails.includes($(e).data('oddist'))){
      $(".od-background").css('background', '#d84b4b');
    } else {
      $(".od-background").css('background', '#11b21c');
    }
    if (fails.includes($(e).data('osdist'))){
      $(".os-background").css('background', '#d84b4b');
    } else {
      $(".os-background").css('background', '#11b21c');
    }
    if (fails.includes($(e).data('oudist'))){
      $(".ou-background").css('background', '#d84b4b');
    } else {
      $(".ou-background").css('background', '#11b21c');
    }

    if (fails.includes($(e).data('ounear'))){
      $(".ou-background").css('background', '#d84b4b');
    } else {
      $(".ou-background").css('background', '#11b21c');
    }
    if($(e).data('oucolor')== 'Pass'){
      $("#color-pass").prop('checked', true);
      $('#color-fail').prop('checked', false);
    }else if ($(e).data('oucolor')== 'Fail'){
      $("#color-fail").prop('checked', true);
      $('$color-pass').prop('checked', false);
    }
    else if ($(e).data('oucolor')== ''){
      $("#color-fail").prop('checked', false);
      $('#color-pass').prop('checked', false);
    }

    sessionStorage.setItem('autoSelect', stunum);

  $("#studentModal").modal('hide');
  if($(e).data('grade') == '2' && ($(e).data('gender') == 'male' || $(e).data('gender') == 'm')){
    if(sessionStorage.getItem('bilateral')){
      $('#startExam').attr('href', '/bilat-color/'+$(e).data('identify'));
    } else{
      $('#startExam').attr('href', '/non-bilat-color/'+$(e).data('identify'));
    }
  } else {
    if(sessionStorage.getItem('bilateral')){
      $('#startExam').attr('href', '/bilat-non-color/'+$(e).data('identify'));
    } else{
      $('#startExam').attr('href', '/non-bilat-non-color/'+$(e).data('identify'));
    }
  }

  $("#startButton").removeAttr('disabled');


}



function showExam(){
  if($("#fname").val()!= ""){
    return win2=window.open('/exam');
  } else {
    $( "#dialog2" ).dialog({
      modal: true,
    });
  }
}
function showExam2(){
  if($("#fname").val()!= ""){
    return win2=window.open('/exam2');
  } else {
    $( "#dialog2" ).dialog({
      modal: true,
    });
  }
}
function showExam3(){
  if($("#fname").val()!= ""){
    return win2=window.open('/exam3');
  } else {
    $( "#dialog2" ).dialog({
      modal: true,
    });
  }
}
function showExam4(){
  if($("#fname").val()!= ""){
    return win2=window.open('/exam4');
  } else {
    $( "#dialog2" ).dialog({
      modal: true,
    });
  }
}
function showExam5(){
  if($("#fname").val()!= ""){
    return win2=window.open('/exam5');
  } else {
    $( "#dialog2" ).dialog({
      modal: true,
    });
  }
}







$("#nurse").keyup(function(){
  sessionStorage.setItem('nurseName', $(this).val());
});






var letters = ["C", "D", "H", "K", "N", "O", "R", "S", "V", "Z"];
var numbers = ["1", "2", "3", "4", "5", "6", "7", "8", "9" , "5"];
var ees = ["d","j","i","e", "d","j","i","e","i","j"];
var pictures = ["k", "h", "f", "g", "b", "c", "k", "h", "f", "g", "b", "c"];
var testvar = 2;
