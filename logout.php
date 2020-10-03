<?php
include('server.php');
unset($_SESSION['EMAIL']);
header('location: login.php');

if (!isset($_SESSION['EMAIL'])) {?>
<h1>Sorry! Page not found</h1>
  <?php
}
  die();
 ?>
