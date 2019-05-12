function loadStudent(e){

    var fails = ['20/40', '20/50', '20/60', '20/80', '20/100', '20/200', '20/400'];

    $(".student_list").css('background-color', 'white');
    $("#fname").val($(e).data('fname'));
    $("#lname").val($(e).data('lname'));
    $("#dob").val($(e).data('dob'));
    $("#gender").val($(e).data('gender'));
    $("#number").val($(e).data('number'));
    $("#school").val($(e).data('school'));
    $("#student_id").val($(e).data('identify'));
    $("#fname").val($(e).data('fname'));
    $("#lname").val($(e).data('lname'));
    $("#teacher").val($(e).data('teacher'));
    $("#district").val($(e).data('district'));
    $("#od_dist").val($(e).data('oddist'));
    $("#od_near").val($(e).data('odnear'));
    $("#os_dist").val($(e).data('osdist'));
    $("#od_cyl").val($(e).data('odcyl'));
    $("#os_cyl").val($(e).data('oscyl'));
    $("#od_color").val($(e).data('odcolor'));
    $("#os_color").val($(e).data('oscolor'));
    $("#os_near").val($(e).data('osnear'));
    $("#ou_dist").val($(e).data('oudist'));
    $("#ou_near").val($(e).data('ounear'));
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

}
// function loadStudent2(e){
//
//     $(".student_list").css('background-color', 'white');
//     $('#fname').val($(e).data('fname'));
//     $('#lname').val($(e).data('lname'));
//     $("#dob").val($(e).data('dob'));
//
//       $("#student_id").val($(e).data('identify'));
//       $("#fname").val($(e).data('fname'));
//       $("#lname").val($(e).data('lname'));
//     $("#gender").val($(e).data('gender'));
//     $("#number").val($(e).data('number'));
//     $("#school").val($(e).data('school'));
//     $("#teacher").val($(e).data('teacher'));
//     $("#district").val($(e).data('district'));
//     $("#od_dist").val($(e).data('oddist'));
//     $("#od_near").val($(e).data('odnear'));
//     $("#os_dist").val($(e).data('osdist'));
//     $("#od_cyl").val($(e).data('odcyl'));
//     $("#os_cyl").val($(e).data('oscyl'));
//     $("#od_color").val($(e).data('odcolor'));
//     $("#os_color").val($(e).data('oscolor'));
//     $("#os_near").val($(e).data('osnear'));
//     $("#ou_dist").val($(e).data('oudist'));
//     $("#ou_near").val($(e).data('ounear'));
//     var stunum = $(e).data('identify');
//     $('#printExam').attr( 'href','/print/'+ stunum);
//     $(e).css('background-color', '#218838');
//
//
// }




var letters = ["C", "D", "H", "K", "N", "O", "R", "S", "V", "Z"];
var numbers = ["1", "2", "3", "4", "5", "6", "7", "8", "9" , "5"];
var ees = ["d","j","i","e", "d","j","i","e","i","j"];
var pictures = ["k", "h", "f", "g", "b", "c", "k", "h", "f", "g", "b", "c"];
var testvar = 2;
