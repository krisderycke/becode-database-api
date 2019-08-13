<?php

// date_default_timezone_set("Europe/Brussels");
// $now = date("d/m/Y-h:i") ;

// connect to database
 require 'server.php';  


// sanitize variables
$titleSani=filter_var($_GET['title'], FILTER_SANITIZE_STRING);
$noteSani =filter_var($_POST['note'], FILTER_SANITIZE_STRING);



    // insert query notation
    try {
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
        echo "Records inserted!";
       
} catch(PDOException $e){
    die("ERROR: Could not prepare/execute query: $sql. " . $e->getMessage());
}


// close connection
unset($pdo);
?>