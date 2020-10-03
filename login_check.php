<?php
include('server.php');
if (isset($_POST['email']) && $_POST['pass1'] ) {
  $email=$_POST['email'];
  $password=$_POST['pass1'];

  $sql=mysqli_query($con, "SELECT * from user where email='$email' and password='$password'");
  $check= mysqli_num_rows($sql);

  if ($check>0) {
    $row=$sql->fetch_assoc();
    $varification_status=$row['varification_status'];

    if ($varification_status==0) {
      echo "You have not confirmed your account yet. Please check your inbox and verify your email id";
    }else{
      echo "done";
      $_SESSION['success']="Congratulations! Successfully you are logged in";
      $_SESSION['EMAIL']=$email;
    }
  }else {
    echo "Please enter correct login details";
  }
}
?>
