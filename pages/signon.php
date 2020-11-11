<?php 
  if(isset($_SESSION['session'])) {
    header('Location: .');
  }
  
  include_once('./controllers/UsersController.php');
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Blog | Cadastro</title>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="./styles/global.css">
  <link rel="stylesheet" href="./styles/sign.css">
</head>
<body>
  <header class="menu">
    <div>
      <div class="left">
        <a href="home">Blog</a>
        <a class="github" href="https://github.com/andrejr971/forum-php" target="blank">
          <img src="./assets/github.svg" alt="icon github"> 
          <span>GitHub</span>
        </a>
      </div>
    </div>
  </header>

  <main>
    <form action="register" method="post">
      <h1>Cadastro</h1>
      <input 
        type="text" 
        name="name" 
        placeholder="Nome"
        required
      >
      <input 
        type="text" 
        name="email" 
        placeholder="E-mail"
        required
      >
      <input 
        type="password" 
        name="password" 
        placeholder="Senha"
        required
      >
      <button type="submit">Cadastar</button>
      <div>
        <a href="signin">
          <span class="material-icons">
            keyboard_arrow_left
          </span>
          Voltar ao login 
        </a>
      </div>
    </form>
  </main>
  
</body>
</html>