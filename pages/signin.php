<?php 
  if(isset($_SESSION['session'])) {
    header('Location: .');
  }
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Blog | Login</title>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="./styles/global.css">
  <link rel="stylesheet" href="./styles/sign.css">
</head>
<body>
  <header class="menu">
    <div>
      <a href="home">Blog</a>
    </div>
  </header>

  <main>
    <form action="login" method="post">
      <h1>Faça o seu login</h1>
      <?php
        if (isset($_SESSION['alert'])) {
      ?>
        <p class='alert <?= $_SESSION['alert'][0] ?>'>
          <?= $_SESSION['alert'][1] ?>
        </p>
      <?php
        }
      ?>
      <input 
        type="email" 
        name="email" 
        placeholder="E-mail"
        required
      >
      <input 
        type="password" 
        name="password" 
        placeholder="Senha"
        
      >
      <button type="submit">Entrar</button>
      <div>
        <a href="signon">
          <span class="material-icons">
            keyboard_arrow_right
          </span>
          Cadastrar-se
        </a>
      </div>
    </form>
  </main>
  
</body>
</html>