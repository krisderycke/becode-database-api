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

if (isset($_POST['submit'])) {
    try {
      require "server.php";
      require "common.php";
  
    $sql = "SELECT *  FROM `my notes` WHERE Title = :title ";
    
      $title = $_POST['title'];
  
      $statement = $pdo->prepare($sql);
       $statement->bindParam(':title', $title, PDO::PARAM_STR);
      $statement->execute();
  
      $result = $statement->fetchAll();
    } catch(PDOException $error) {
      echo $sql . "<br>" . $error->getMessage();
    }
  }
  /////////////query for all notes
  if (isset($_POST['submitAll'])) {
    try {
      require "server.php";
      require "common.php";
          $sql = "SELECT *  FROM `my notes` ORDER BY ID";
          $statement = $pdo->prepare($sql);
          $statement ->execute();
          $result = $statement->fetchAll();
        } catch(PDOException $error) {
          echo $sql . "<br>" . $error->getMessage();
        }
      }
?>

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <link rel="stylesheet" href="style.css">
   <title>CRUD</title>
</head>
<body>
<h1>Find note</h1>
<?php
if (isset($_POST['submit']) || isset($_POST['submitAll'])) {
  if ($result && $statement->rowCount() > 0) { ?>
    <h2>Results</h2>

    <table>
      <thead>
<tr>
  <th>#</th>
  <th>Title</th>
  <th>Note</th>
  <th>Date</th>
  
</tr>
      </thead>
      <tbody>
  <?php foreach ($result as $row) { ?>
      <tr>
<td><?php echo escape($row["ID"]); ?></td>
<td><?php echo escape($row["Title"]); ?></td>
<td><?php echo escape($row["Note_Context"]); ?></td>
<td><?php echo escape($row["Timestamp"]); ?></td>

      </tr>
    <?php } ?>
      </tbody>
  </table>
  <?php } else { ?>

    No results found for <?php echo escape($_POST['title']); ?>.
  <?php }
} ?>

<form method="post">   
    <input type="submit" name="submitAll" value="View All Notes">
</form>

<form method="post">
    <label for="title">Title</label>
    <input type="text" id="title" name="title" placeholder="search titel">
    <input type="submit" name="submit" value="View Results">
</form>

<a href="index.php">Back to home</a>

</body>
</html>