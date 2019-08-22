<?php
 
 header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");
header('Content-type: text/javascript');

// header("Access-Control-Allow-Methods", "GET, PUT, POST, DELETE");
require 'server.php';
require 'common.php';

//select notes
    try {
    //   require "server.php";
    //   require "common.php";
          $sql = "SELECT `ID`,`Title`,`Note_Context`  FROM `my notes` ORDER BY `ID`";
          $statement = $pdo->prepare($sql);
          $statement ->execute();
          $result = $statement->fetchAll(PDO::FETCH_ASSOC);

          echo json_encode($result, JSON_PRETTY_PRINT);
        } catch(PDOException $error) {
          echo $sql . "<br>" . $error->getMessage();
        }
      

///delete note
if (isset($_POST["submit"])) {
  
    try {
             
            
              $id = $_POST["submit"];
              $sql = "DELETE FROM `my notes` WHERE ID = :id";
              $statement = $pdo->prepare($sql);
              $statement->bindValue(':id', $id);
              $statement->execute();
            //   $success = "Note successfully deleted";
            } catch(PDOException $error) {
              echo $sql . "<br>" . $error->getMessage();
            }
          }

///insert note
if (isset($_POST['submit'])) {
    require "common.php";
    // connect to database
    require 'server.php';  
    $noteSani =filter_var($_POST['note'], FILTER_SANITIZE_STRING);
    $titleSani=filter_var($_POST['title'], FILTER_SANITIZE_STRING);

    try{
    // $newNote= array(
    
    //snippet to use instead of hardcoding everything
    // $sql= sprintf(
    //         "INSERT INTO %s (%s) values (%s)",
    //         "my notes",
    //         implode(",", array_keys($newNote)),
    //         ":" . implode(", :", array_keys($newNote))
    //         );
    $sql = "INSERT INTO `my notes` (Title, Note_Context) VALUES (:title, :context)";
    $stmt = $pdo->prepare($sql);
    // Validate input
    if (empty($titleSani)) {
        $feedback['validate_titleError'] = "please fill in a title.";
    } else if (strlen($titleSani) > 20) {
        $feedback['validate_titleError'] = "Title can't be longer than 20 characters.";
    } else {
        $titleValidated = $titleSani;
    }
    if (empty($noteSani)) {
        $feedback['validate_noteError'] = "Your note is empty.";
    } else {
        $noteValidated = $noteSani;
    }
 
    
    // use parameters to statement
    $stmt->bindParam(':title', $titleValidated, PDO::PARAM_STR);
    $stmt->bindParam(':context',$noteValidated, PDO::PARAM_STR);
    
    // execute sql statement
    $stmt->execute();
}catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
}
}

?>