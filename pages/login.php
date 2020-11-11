<?php 
  if(isset($_SESSION['session'])) {
    header('Location: .');
  }

  if(!isset($POST['email'])) {
    header('Location: .');
  }

  include_once('./controllers/SessionController.php');
?>