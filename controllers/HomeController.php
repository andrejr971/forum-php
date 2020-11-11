<?php
  unset($_SESSION['alert']);
  $connection = include_once('./database/connection.php');

  function index($connection) {
    $sql = "select * from comment order by created_at desc";
    $results = $connection->prepare($sql);
    $results->execute();

    return $results->fetchAll(PDO::FETCH_OBJ);
  }
  
  $comments = index($connection); 
  
  function store($connection, $request) {
    global $comments;
    
    if (isset($_SESSION['session'])) {
      $sql = "insert into comment (text, user_id, name_user, avatar_user) values (:text, :id, :name, :avatar)";
    } else {
      $sql = "insert into comment (text) values (:text)";
    }
    
    $results = $connection->prepare($sql);
    $results->bindValue(':text', $request);
    if (isset($_SESSION['session'])) {
      $results->bindValue(':id', $_SESSION['session']['id']);
      $results->bindValue(':name', $_SESSION['session']['name']);
      $results->bindValue(':avatar', $_SESSION['session']['avatar']);
    } 

    $results->execute();
    $comments = index($connection); 
  }

  function destroy($connection, $id) {
    $sql = "delete from comment where id = :id and user_id = :user_id";
    $results = $connection->prepare($sql);
    $results->bindValue(':id', $id);
    $results->bindValue(':user_id', $_SESSION['session']['id']);
    $results->execute();
  }

  if (isset($_POST['comment'])) {
    store($connection, $_POST['comment']);
  }