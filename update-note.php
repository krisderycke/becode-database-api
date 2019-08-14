<?php

require "server.php";
require "common.php";
if (isset($_POST['submit'])) {
    
    try {
     
      $note =[
        "id"        => $_POST['ID'],
        "title" => $_POST['Title'],
        "note"  => $_POST['Note_Context'],
        // "date"      => $_POST['Timestamp']
      ];
      $sql = "UPDATE `my notes` SET `ID` = :id, `Title` = :title, `Note_Context` = :note WHERE `ID` = :id";
    
    $statement = $pdo->prepare($sql);
    $statement->execute($note);
    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
  }




//////////////
if (isset($_GET['id'])) {
    
  try {
    
    $id = $_GET['id'];

    $sql = "SELECT * FROM `my notes` WHERE id = :id";
    $statement = $pdo->prepare($sql);
    $statement->bindValue(':id', $id);
    $statement->execute();

    $note = $statement->fetch(PDO::FETCH_ASSOC);
  } catch(PDOException $error) {
      echo $sql . "<br>" . $error->getMessage();
  }
} else {
  echo "Something went wrong!";
  exit;
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
  <div class="flex">
    <h1>update note</h1>

<?php if (isset($_POST['submit']) && $statement) : ?>
	<blockquote><strong><?php echo escape($_POST['Title']); ?></strong> successfully updated.</blockquote>
<?php endif; ?>



<form method="post">
    <?php foreach ($note as $key => $value) : ?>
   <!-- enter csrf -->
      <label for="<?php echo $key; ?>"><?php echo ucfirst($key); ?></label>
	    <input type="text" name="<?php echo $key; ?>" id="<?php echo $key; ?>" value="<?php echo escape($value); ?>" <?php echo ($key === 'id' ? 'readonly' : null); ?>>
    <?php endforeach; ?> 
    <input type="submit" name="submit" value="Update">
</form>

<a href="index.php">Back to home</a>

</div>
</body>
</html>
    <!-- <input name="csrf" type="hidden" value="  -->
 