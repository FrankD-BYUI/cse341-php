<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $pageTitle ?></title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
  <link rel="stylesheet" href="/prove03/css/styles.css">
</head>

<body>
  <header>
    <div class="container">
      <nav class="navbar">
        <a class="navbar-brand" href="/prove03/">The Things Store</a>
        <a class="navbar-text cart" href="/prove03/cart.php"><i class="bi bi-cart4"></i>
          <?php
          if (isset($cartCount)) {
            echo "($cartCount)";
          }
          ?></a>
      </nav>
    </div>
  </header>

  <main class="container">