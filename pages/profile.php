<?php
  if(!isset($_SESSION['session'])) {
    header('Location: ..');
  }

  include_once('./controllers/UsersController.php');
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Blog | Profile</title>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="./styles/global.css">
  <link rel="stylesheet" href="./styles/profile.css">
</head>
<body>
  <header class="menu">
    <div>
      <a href="home">Blog</a>

      <div>
        <a href="profile" class="profile">
          <img 
            src="<?= $_SESSION['session']['avatar'] 
              ? "./tmp/{$_SESSION['session']['avatar']}" 
              : "https://ui-avatars.com/api/?name={$_SESSION['session']['name']}&background=1c1b22&color=fff&bold=true&format=svg&size=110" ?>" 
            alt="avatar"
          >
        </a>
        <a href="logout" class="sign">Sair</a>
      </div>
    </div>
  </header>

  <main>
    <form action="" method="post" class="dropzone" enctype="multipart/form-data">
      <?php
        if (isset($_SESSION['alert'])) {
      ?>
        <p class='alert <?= $_SESSION['alert'][0] ?>'>
          <?= $_SESSION['alert'][1] ?>
        </p>
      <?php
        }
      ?>
      
      <label for="perfil">
        <input type="file" name="avatar" id="perfil" accept="image/*">
        <img 
          src="<?= $_SESSION['session']['avatar'] 
            ? "./tmp/{$_SESSION['session']['avatar']}" 
            : "https://ui-avatars.com/api/?name={$_SESSION['session']['name']}&background=121214&color=fff&bold=true&format=svg&size=110" ?>" 
          alt="avatar"
          id="avatar"
        >
      </label>

      <input 
        type="text" 
        name="name" 
        value="<?= $_SESSION['session']['name'] ?>"
        placeholder="Nome" 
        autocomplete="off"
        required
      >
      <input 
        type="email" 
        name="email" 
        value="<?= $_SESSION['session']['email'] ?>"
        placeholder="E-mail" 
        autocomplete="off"
        required
      >
      <div class="separator"></div>
      <input 
        type="password" 
        name="old_password" 
        placeholder="Sua senha"
      >
      <input 
        type="password" 
        name="password" 
        placeholder="Senha nova"
      >
      <input 
        type="password" 
        name="confirm_password" 
        placeholder="Confirme a sua senha"
      >
      <button type="submit">Salvar</button>
    </form>
  </main>

  <script>
    const inputPerfil = document.getElementById('perfil');

    inputPerfil.addEventListener('change', ({ target }) => {
      const file = target.files[0];

      const preview = URL.createObjectURL(file);

      const avatar = document.getElementById('avatar');
      avatar.setAttribute('src', preview);
    });
  </script>
</body>
</html>