<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

try {
    require "server.php";
    require "common.php";
  
  
    $sql = "SELECT * FROM `my notes` ORDER BY ID";
  
    $statement = $pdo->prepare($sql);
    $statement->execute();
  
    $result = $statement->fetchAll();
  
  } catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
  }
?>








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
  <!-- <div class="flex"> -->
  <div class="list">

    <h1 style="color:white">Edit note</h1>
    <table>
  <thead>
    <tr>
      <th>#</th>
      <th>Title</th>
      <th>Note</th>
      <th>Date</th>
      <th>Edit</th>
    </tr>
  </thead>
    <tbody>
    <?php foreach ($result as $row) : ?>
      <tr>
        <td><?php echo escape($row["ID"]); ?></td>
        <td><?php echo escape($row["Title"]); ?></td>
        <td><?php echo escape($row["Note_Context"]); ?></td>
        <td><?php echo escape($row["Timestamp"]); ?> </td>
        <td><a href="update-note.php?id=<?php echo escape($row["ID"]); ?>">Edit</a></td>
      </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<a href="index.php">Back to home</a>

</div>
</body>
</html>