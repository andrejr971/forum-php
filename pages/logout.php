<?php
  if(!isset($_SESSION['session'])) {
    header('Location: home');
  }

  include_once('./controllers/SessionController.php');

  sessionDestroy();
?>