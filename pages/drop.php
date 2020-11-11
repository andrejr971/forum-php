<?php
  if(!isset($_SESSION['session'])) {
    header('Location: home');
  }

  include_once('./controllers/HomeController.php');

  destroy($connection, $pathExplode[1]);

  header('Location: ..');
?>