<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Note App</title>
  </head>
  <body>
    <h3>Note App</h3>
    <form action="insert.php" method="get">
      <label for="">insert title</label>
      <input type="text" name="title" id="title" autofocus />
    </form>
    <form action="insert.php" method="post">
      <label for="">write your note</label>
      <textarea name="note" id="note" cols="30" rows="10"></textarea>
    </form>
    <input type="button" value="submit" name="submit" />
  </body>
</html>
