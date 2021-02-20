<?php
  if (!$_SESSION['loggedin']) {
    header('Location: index.php?action=signin');
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <h1>welcome <?php echo $username; ?></h1>
</body>
</html>