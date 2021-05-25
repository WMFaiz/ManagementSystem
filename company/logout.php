<?php

  session_start();
  unset($_SESSION['user_id']);

  session_destroy();

  setcookie('success', "Successfully logout");
  header("location: home.php");

?>