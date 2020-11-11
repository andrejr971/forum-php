<?php 
  error_reporting(-1);
  error_reporting(E_ALL);
  ini_set("display_errors", 1);

  session_start();

  date_default_timezone_set('America/Sao_Paulo');

  // if (isset($_SESSION['alert'])) {
  //   echo "<p class='alert {$_SESSION['alert'][0]}'>{$_SESSION['alert'][1]}</p>";
  // }


  // if (isset($_SESSION['user'])) {
    $path = $_GET['url'] ?? 'home';
  // } else {
  //   $path = $_GET['url'] ?? 'pages/login';
  // }

  $pathExplode = explode('/', $path);

  // if ($pathExplode[0] === 'scripts') {
  //   include_once("./scripts/{$pathExplode[1]}.php");
  // } else {
  if(file_exists("./pages/{$pathExplode[0]}.php")) {
    include_once("./pages/{$pathExplode[0]}.php");
  } else {
    include_once("./pages/home.php");
  }
  // }  
