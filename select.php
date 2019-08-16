<?php


// require 'server.php';
// try {
//    $sqlSelect = "SELECT * FROM `my notes` ORDER BY `ID`";
//    $result = $pdo->query($sqlSelect);
//    if($result->rowCount()>0){  
       
//       $x= $result->rowCount();
           
//     //        echo "<br/> We found " .$x. " notes: <br/>" ;
          
          
    //        // echo "<table>";
    //        // echo "<tr>";
    //        //     echo "<th>id:    </th>";
    //        //     echo "<th>Title:    </th>";
    //        //     echo "<th>Note    </th>";
    //        //     echo "<th>Date:    </th>";
    //        // echo "</tr>";

    //        while ($row = $result->fetch()){
    //        //     echo "<tr>";
    //        //     echo "<td>" . $row['ID'] . "</td>";
    //        //     echo "<td>" . $row['Title'] . "</td>";
    //        //     echo "<td>" . $row['Note_Context'] . "</td>";
    //        //     echo "<td>" . $row['Timestamp'] . "</td>";
    //        // echo "</tr>";

    //            echo "<br/> Id = " .  $row['ID'] ;
    //            echo "<br/> Title= " .  $row['Title'] ;
    //            echo "<br/> Note = " .  $row['Note_Context'] ;
    //            echo "<br/> Last updated = " .  $row['Timestamp'] . "<br/>" ;
    //        }
    //        // echo "</table>";

    //        unset($result);
    //    } else {
    //        echo "nothing found";
    //    }

  
  
// } catch (PDOException $e){
//    die("ERROR: could not execute : $sqlSelect. " . $e->getMessage());
// }
// unset($pdo);
// 

// if (isset($_POST['submit'])) {
//     try {
//       require "server.php";
//       require "common.php";
  
//     $sql = "SELECT `ID`,`Title`  FROM `my notes`";
    
//       $title = $_POST['title'];
  
//       $statement = $pdo->prepare($sql);
//        $statement->bindParam(':title', $title, PDO::PARAM_STR);
//       $statement->execute();
  
//       $result = $statement->fetchAll();
//     } catch(PDOException $error) {
//       echo $sql . "<br>" . $error->getMessage();
//     }
//   }
  /////////////query for all notes
  // if (isset($_POST['submitAll'])) 
  header('Content-type: text/javascript');
    try {
      require "server.php";
      require "common.php";
          $sql = "SELECT `ID`,`Title`  FROM `my notes`";
          $statement = $pdo->prepare($sql);
          $statement ->execute();
          $result = $statement->fetchAll(PDO::FETCH_ASSOC);

          echo json_encode($result, JSON_PRETTY_PRINT);
        } catch(PDOException $error) {
          echo $sql . "<br>" . $error->getMessage();
        }
      
?>
