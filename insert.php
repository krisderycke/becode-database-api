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

try {
    $sqlSelect = "SELECT * FROM `my notes` ORDER BY `ID`";
    $result = $pdo->query($sqlSelect);
    if($result->rowCount()>0){  
        
       $x= $result->rowCount();
            
            echo "<br/> We found " .$x. " notes: <br/>" ;
           
           
            // echo "<table>";
            // echo "<tr>";
            //     echo "<th>id:    </th>";
            //     echo "<th>Title:    </th>";
            //     echo "<th>Note    </th>";
            //     echo "<th>Date:    </th>";
            // echo "</tr>";

            while ($row = $result->fetch()){
            //     echo "<tr>";
            //     echo "<td>" . $row['ID'] . "</td>";
            //     echo "<td>" . $row['Title'] . "</td>";
            //     echo "<td>" . $row['Note_Context'] . "</td>";
            //     echo "<td>" . $row['Timestamp'] . "</td>";
            // echo "</tr>";

                echo "<br/> Id = " .  $row['ID'] ;
                echo "<br/> Title= " .  $row['Title'] ;
                echo "<br/> Note = " .  $row['Note_Context'] ;
                echo "<br/> Last updated = " .  $row['Timestamp'] . "<br/>" ;
            }
            // echo "</table>";

            unset($result);
        } else {
            echo "nothing found";
        }

   
   
} catch (PDOException $e){
    die("ERROR: could not execute : $sqlSelect. " . $e->getMessage());
}
// close connection
unset($pdo);
?>