<?php include('server.php');?>

<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Home page of the profile</title>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.min.css">
  </head>
  <body>
    <?php

    if(isset($_SESSION['EMAIL'])) {?>

    <div class="container">
      <div class="form-group">
        <div class="text-center">
          <label class="col-md-6 control-label "><h2 style="padding: 50px;">Home page</h2></label>

      </div>
      <div class="row">
        <div class="col-md-7">
          <img src="PngItem_59407.png" class="img-fluid" alt="Responsive image"  width="450" height="300" style="padding: 35px;">
        </div>
      <div class="col-md-4">

          <h3>
              <?php
              if (isset($_SESSION['success'])) {
                echo $_SESSION['success'];
                unset($_SESSION['success']);
              }

              ?>
          </h3>
              <p>Welcome

                <?php echo $_SESSION['EMAIL'].'<br>'.'<br>';?>

              <div class="">
                <a href="logout.php" style="color: red;">Signout</a>
              </div>
             </p>
           <?php }
           else if (!isset($_SESSION['EMAIL'])) {
             //include 'header.inc.php';?>
           <h1>Sorry! Page not found</h1>
             <?php
           }
             die();
            ?>
            </div>
      </div>
    </div>
  </div>
  </body>
</html>
