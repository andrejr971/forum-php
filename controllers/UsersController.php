<?php
  $connection = include_once('./database/connection.php');

  function store($connection, $request) {
    $sql = "insert into users (name, email, password) values (:name, :email, :password)";
    $insert = $connection->prepare($sql);
    $insert->bindValue(':name', $request->name);
    $insert->bindValue(':email', $request->email);
    $insert->bindValue(':password', $request->password);
    $insert->execute();

    $_SESSION['alert'] = ['success', 'Cadastro realizado, agora faça o login para continuar'];
    header('Location: signin');
  }

  function update($connection, $request) {
    if (isset($request->password)) {
      $sql = "update users set name = :name, email = :email, avatar = :avatar, password = :password where id = :id";
    } else {
      $sql = "update users set name = :name, email = :email, avatar = :avatar where id = :id";
    }
    $insert = $connection->prepare($sql);
    $insert->bindValue(':name', $request->name);
    $insert->bindValue(':email', $request->email);
    $insert->bindValue(':id', $_SESSION['session']['id']);
    $insert->bindValue(':avatar', $request->avatar);

    if (isset($request->password)) {
      $insert->bindValue(':password', $request->password);
    }

    $insert->execute();

    $_SESSION['session']['name'] = $request->name;
    $_SESSION['session']['email'] = $request->email;
    $_SESSION['session']['avatar'] = $request->avatar;

    $_SESSION['alert'] = ['success', 'Perfil atualizado'];
    header('Location: profile');
  }

  if (isset($_POST['name'])) {
    $request = (Object) [
      'name' => $_POST['name'],
      'email' => $_POST['email'],
      'password' => password_hash($_POST['password'], PASSWORD_DEFAULT, ['cost' => 15]),
    ];

    if (isset($_SESSION['session'])) {
      $file = $_FILES['avatar'];

      $request->password = null;
      $request->avatar = $_SESSION['session']['avatar'];

      if (!empty($file['name'])) {
        $filename = MD5($file['name']) . rand(0, 9999);
        $type = substr($file['name'], -4);
        
        $tmp = $file['tmp_name'];
        
        $path = "./tmp/{$filename}{$type}";  
        
        move_uploaded_file($tmp, $path);
        
        $request->avatar = "{$filename}{$type}";
      } 

      if (!empty($_POST['old_password'])) {
        if ($_POST['password'] !== $_POST['confirm_password']) {
          $_SESSION['alert'] = ['danger', 'Senhas não conferem'];
          return;
        } else {
          $request->password = password_hash($_POST['password'], PASSWORD_DEFAULT, ['cost' => 15]);
        }
      }

      update($connection, $request);
    } else {
      store($connection, $request);
    }
  }
  