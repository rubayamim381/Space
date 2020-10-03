<?php
require ('functions.inc.php');
$msg='';
$error = array();
$success_message = "";



if (isset($_POST['submit'])) {
  $name=get_safe_value($con, $_POST['name']);
  $email=get_safe_value($con, $_POST['email']);
  $pass1=get_safe_value($con, $_POST['pass1']);
  $pass2=get_safe_value($con, $_POST['pass2']);
  $isValid = true;

  //check if confirmed password is matched or not
  if ($isValid && ($pass1 != $pass2)) {
    $isValid = false;
    array_push($error, "Confirmation Password is not matching. Please, re-enter the password.");
  }



    //check if confirmed password is matched or not
    if ($isValid && ($pass1 != $pass2)) {
      $isValid = false;
      array_push($error, "Confirmation Password is not matching. Please, re-enter the password.");


    }

    //check email id is valid or not
    if ($isValid && !(filter_var($email, FILTER_VALIDATE_EMAIL))) {
      $isValid = false;
      array_push($error, "Invalid email id.");
    }

    //check if email id already exists
    if ($isValid) {

      $stmt = $con->prepare("SELECT * FROM user WHERE email = ?");
      $stmt->bind_param("s", $email);
      $stmt->execute();
      $result = $stmt->get_result();
      $stmt->close();

      if ($result->num_rows > 0) {
        $isValid = false;
        array_push($error, "Email id already exists.");
      }
    }


    //insert record
    if ($isValid && (count($error) == 0)) {

    $varification_id = rand(111111111,999999999);

    mysqli_query($con, "INSERT into user(name,email,password,varification_id, varification_status) values('$name','$email','$pass1','$varification_id',0)");

    $msg="We just sent you a varification link to <strong>$email</strong>. Please check your inbox and click on the link to get started. If you don't find the link please, request a new one.";

    $mailHtml = "Please, confirm your acount registration by clicking the button or link below: <a href='http://localhost/PHP/Space/check.php?id=$varification_id'>http://localhost/PHP/Space/check.php?id=$varification_id</a>";

    smtpMailer($email,'Verification Code',$mailHtml);
}
}


function smtpMailer($toMail, $subject, $body){
  include "smtp\class.phpmailer.php";

  $mail= new PHPMailer();
  $mail->isSMTP();
  $mail->SMTPDebug = 1;
  $mail->SMTPAuth = true;
  $mail->SMTPSecure = 'ssl';
  $mail->Host = 'smtp.gmail.com';
  $mail->Port = 465; //587
  $mail->IsHTML(true);
  $mail->CharSet= 'UTF-8';
  $mail->Username = 'spaceexplorer250@gmail.com';
  $mail->Password = 'jkkniu_tech250';
  $mail->SetFrom("spaceexplorer250@gmail.com");
  // $mail->SMTPOptions=array('ssl'=>array(
  //   'verify_peer'=>false,
  //   'verify_peer_name'=>false,
  //   'allow_self_signed'=>false,
  // ));

  //$mail->addAttachment("example.pdf");
  $mail->Subject = $subject;
  $mail->Body= $body;
  $mail->AddAddress($toMail);

  if (!$mail->Send()) {
    return 0;
  }else {
    return 1;
  }
}

  //displaying error message
  if (!empty($error)) {
       $error_msg = "Error!"." ".implode($error);
       echo "<script type='text/javascript'>alert('$error_msg');</script>";
      }
      ?>

        <?php
        // Display Success message
        if(!empty($success_message)){ ?>
        <div class="">
        <strong><?php echo "<script type='text/javascript'>alert('$success_message');</script>"; ?>
          </strong>
        </div>
      <?php  } ?>
