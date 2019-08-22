<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");
//  Access-Control-Allow-Methods : "GET,POST,PUT,DELETE,OPTIONS";

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

