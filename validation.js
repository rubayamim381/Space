$(document).ready(function(){

$('#usernameCheck').hide();
$('#emailCheck').hide();


$('#passcheck').hide();
$('#conpasscheck').hide();



var username_err = true;
var email_err = true;


var pass_err = true;
var conpass_err = true;


//first Name
$('#name').keyup(function(){
username_check();
});

function username_check(){

var username_val = $('#name').val();

if(username_val.length == ''){
$('#usernameCheck').show();
$('#usernameCheck').html("**Please fill your username");
$('#usernameCheck').focus();
$('#usernameCheck').css("color","red");
username_err = false;
return false;

}else if((username_val.length < 3 ) || (username_val.length > 10 ) ){
$('#usernameCheck').show();
$('#usernameCheck').html("**Username length must be between 3 to 10");
$('#usernameCheck').focus();
$('#usernameCheck').css("color","red");
username_err = false;
return false;

}else{
$('#usernameCheck').hide();
username_err = true;
return true;
}
}






//mobile number check
$('#mob').keyup(function(){
mob_check();
});

function mob_check(){

var mob_val = $('#mob').val();

if((mob_val.length == '') || (mob_val.length < 13)) {
$('#mobCheck').show();
$('#mobCheck').html("**Enter your valid phone number. Example: 8801****");
$('#mobCheck').focus();
$('#mobCheck').css("color","red");
mob_err = false;
return false;

}else{
$('#mobCheck').hide();
mob_err = true;
return true;
}
}


// $("#btnsubmit").on("click", validate);
$('#btnSubmit').click(function(){

username_err = true;
email_err = true;
mob_err = true;


username_check();
email_check();

mob_check();



if((username_err == false ) || (email_err == false )) {

return false;

}

else {
  return true;
}

});

});


//submit button
// function submit_btn(){
//   var email = JQuery('#email').val();
//   jQuery.ajax({
//     url: 'validation.php',
//     type: 'post',
//     data: 'email='+email,
//     success: function(result){
//
//     }
//   });
// }
