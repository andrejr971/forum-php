<?php 
  include_once('./controllers/HomeController.php');
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Blog</title>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="./styles/global.css">
  <link rel="stylesheet" href="./styles/home.css">
</head>
<body>
  <header class="menu">
    <div>
      <div class="left">
        <a href=".">Blog</a>
        <a class="github" href="https://github.com/andrejr971/forum-php" target="blank">
          <img src="./assets/github.svg" alt="icon github"> 
          <span>GitHub</span>
        </a>
      </div>
      <div>
        <?php
          if(isset($_SESSION['session'])) {
        ?>
          <a href="profile" class="profile">
            <img 
              src="<?= $_SESSION['session']['avatar']  && file_exists("./tmp/{$_SESSION['session']['avatar']}")
                ? "./tmp/{$_SESSION['session']['avatar']}" 
                : "https://ui-avatars.com/api/?name={$_SESSION['session']['name']}&background=1c1b22&color=fff&bold=true&format=svg&size=110" ?>" 
              alt="avatar"
            >
          </a>
          <a href="logout" class="sign">Sair</a>
        <?php
          } else {
        ?>
          <a href="signin" class="sign">Login</a>
        <?php
          }
        ?>        
      </div>
    </div>
  </header>

  <main>
    <form action="." method="post">
      <textarea name="comment" placeholder="Deixe um comentário" required></textarea>
      <button type="submit">Publicar</button>
    </form>
    
    <article>
      <ul>
        <?php
          foreach ($comments as $comment) {
            $date = new DateTime($comment->created_at);
            $date->modify('-3 hour');
          ?>
            <li>
              <div class="avatar">
                <?php
                  if (isset($comment->avatar) && file_exists("./tmp/{$comment->avatar}")) {
                ?>
                  <img 
                    src="<?= $comment->avatar 
                        ? "./tmp/{$comment->avatar}" 
                        : "https://ui-avatars.com/api/?name={$comment->name}&background=1c1b22&color=fff&bold=true&format=svg&size=110" ?>"
                    alt="profile"
                  >
                <?php
                  } else {
                ?>
                    <img 
                      src="https://ui-avatars.com/api/?name=anonimo&background=1c1b22&color=fff&bold=true&format=svg&size=110" 
                      alt="profile"
                    >
                <?php
                  }
                ?>
              </div>
              
              <div class="comment">
                <header>
                  <strong>
                    <?= $comment->name ?? 'Anônimo' ?>
                    <span><?= $date->format('d/m/Y - H:i') ?></span>

                  </strong>
                  <?php
                    if (isset($comment->id) && isset($_SESSION['session']) && $comment->id === $_SESSION['session']['id']) {
                    ?>
                      <a href="drop/<?= $comment->comment_id ?>">
                        <span class="material-icons">
                          close
                        </span>
                      </a>
                  <?php
                    }
                  ?>                  
                </header>
                <p> <?= $comment->text ?> </p>
              </div>
            </li>
          <?php
          }
        ?>
      </ul>
    </article>
  </main>
  
</body>
</html>