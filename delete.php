<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");
// header("Access-Control-Allow-Methods", "GET, PUT, POST, DELETE");
require 'server.php';
require 'common.php';




// $success = null;
if (isset($_POST["submit"])) {
  
  try {
   
  
    $id = $_POST["submit"];
    $sql = "DELETE FROM `my notes` WHERE ID = :id";
    $statement = $pdo->prepare($sql);
    $statement->bindValue(':id', $id);
    $statement->execute();
    $success = "Note successfully deleted";
  } catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
  }
}
try {
 
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
<!-- <div class="flex">    -->
  <div class="list">
<h1 style="color:white">Delete note</h1>

<?php if ($success) echo $success; ?>

<form method="post">
  <table>
    <thead>
      <tr>
        <th>#</th>
        <th>Title</th>
        <th>Note</th>
        <th>Date</th>
        <th>Delete</th>
      </tr>
    </thead>
    <tbody>
    <?php foreach ($result as $row) : ?>
      <tr>
        <td><?php echo escape($row["ID"]); ?></td>
        <td><?php echo escape($row["Title"]); ?></td>
        <td><?php echo escape($row["Note_Context"]); ?></td>
        <td><?php echo escape($row["Timestamp"]); ?></td>
        <td><button type="submit" name="submit" value="<?php echo escape($row["ID"]); ?>">Delete</button></td>
      </tr>
    <?php endforeach; ?>
    </tbody>
  </table>
</form>

<a href="index.php">Back to home</a>
</div>
</div>
</body>
</html>