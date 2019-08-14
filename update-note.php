<?php

require "server.php";
require "common.php";
if (isset($_GET['id'])) {
    
  try {
    
    $id = $_GET['id'];

    $sql = "SELECT * FROM `my notes` WHERE id = :id";
    $statement = $pdo->prepare($sql);
    $statement->bindValue(':id', $id);
    $statement->execute();

    $notes = $statement->fetch(PDO::FETCH_ASSOC);
  } catch(PDOException $error) {
      echo $sql . "<br>" . $error->getMessage();
  }
} else {
  echo "Something went wrong!";
  exit;
}