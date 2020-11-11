<?php
  $connection = include_once('./database/connection.php');
  
  function ensureAuthenticate($email, $password, $connection) {
    echo $email;
    echo $password;

    $sql = "select * from users where email = :email";
    $result = $connection->prepare($sql);
    $result->bindValue(':email', $email);
    $result->execute();

    $user = $result->fetchAll(PDO::FETCH_OBJ);


    if (empty($user[0])) {
      $_SESSION['alert'] = ['danger', 'E-mail ou senha incorreto'];
      header('Location: login');
      return;
    }

    $user = $user[0];

    $comparer = password_verify($password, $user->password);

    if (!$comparer) {
      $_SESSION['alert'] = ['danger', 'E-mail ou senha incorreto'];
      header('Location: login');
      return;
    }

    $_SESSION['session'] = [
      'id' => $user->id,
      'name' => $user->name,
      'email' => $user->email,
      'avatar' => $user->avatar
    ];

    unset($_SESSION['alert']);
    header('Location: home');
  }

  function sessionDestroy() {
    unset($_SESSION['session']);
    session_destroy();

    header('Location: home');
  }

  if (isset($_POST['email'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    ensureAuthenticate($email, $password, $connection);
  }