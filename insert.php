<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <link rel="stylesheet" href="style.css">
   <style>
    
   </style>
   <title>CRUD</title>
</head>
<body>
<h1>CRUD excercise</h1>
<form method="post">
        <label for="title">Enter Title</label>
            <input type="text" name="title" id="title">
        <label for="note">Enter Note</label>
            <textarea type="text" name="note" id="note"></textarea>
            <input type="submit" name="submit" value="Submit">
</form>

<a href="index.php">Back to home</a>

<?php


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
</body>
</html>