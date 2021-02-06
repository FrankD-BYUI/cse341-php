<?php

require 'db.php';

$search = "";
if(isset($_GET['search'])){
  $search = filter_input(INPUT_GET,'search',FILTER_SANITIZE_STRING);
}

$connection = connectDB();

$sql = 'SELECT * from scriptures';

if($search) {
  $sql = "SELECT * from scriptures WHERE book = :search";
}

$stmt = $connection->prepare($sql);

$stmt->bindValue(':search', $search, PDO::PARAM_STR);
$stmt->execute();
$response = $stmt->fetchAll(PDO::FETCH_ASSOC);
$stmt->closeCursor();

$message = "";
if($stmt->rowCount() == 0) {
  $message = "No results found.";
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Scriptures</title>
</head>
<body>
  <form action="/" method="get">
    <label for="search"></label>
    <input type="search" name="search" id="search">
    <input type="submit" value="search"/>
  </form>
  <h1>Scripture Resources</h1>
  <ul>
  <?php
    foreach($response as $scripture) {
      echo "<li><a href='/scripture.php?id=$scripture[id]'><strong>$scripture[book] $scripture[chapter]:$scripture[verse]</strong></a></li>";
    }
  ?>
  </ul>
  <h4 style="color: red"><?php echo $message;?></h4>
</body>
</html>