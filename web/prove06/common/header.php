<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $pageTitle ?></title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <link rel="stylesheet" href="/prove06/css/styles.css">
</head>

<body>
  <header>
    <ul class="nav nav-tabs">
      <li role="presentation" <?php if ($active == "home") echo 'class="active"'; ?>><a href="/prove06/index.php">Home</a></li>
      <li role="presentation"><a href="#">Cart
          <?php
          $cartQty;
          if (isset($_SESSION['cart'])) {
            $cartQty = 0;
            foreach ($_SESSION['cart'] as $key => $value) {
              $cartQty += $value;
            }
          }
          if (isset($cartQty) && $cartQty > 0) {
            echo " (" . $cartQty . ")";
          } ?> </a></li>
      <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) { ?>
        <li role="presentation" <?php if ($active == "account") echo 'class="active"'; ?>><a href="/prove06/account/index.php">Account</a></li>
        <li role="presentation"><a href="/prove06/account/index.php?action=logout">Log Out</a></li>
      <?php } else { ?>
        <li role="presentation" <?php if ($active == "login") echo 'class="active"'; ?>><a href="/prove06/account/index.php?action=login">Log In</a></li>
      <?php } ?>
    </ul>
  </header>

  <main class="container">