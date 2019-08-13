<?php
require 'server.php';
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
unset($pdo);
?>