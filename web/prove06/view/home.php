<?php
$pageTitle = "Silly Scents | Home";
$active = "home";
include './common/header.php';
?>

<h1>Silly Scents Candles</h1>

<?php
if (isset($_SESSION['message'])) {
  echo $_SESSION['message'];
  unset($_SESSION['message']);
} ?>

<div class="card-container container">
  <?php
  foreach ($items as $item) {
    echo "\n<div class='card'>";
    echo "\n<img class='card-img-top' src='./images/default-candle.png' alt='candle'>";
    echo "\n<div class='card-body'>";
    echo "\n<h4 class='card-title'>$item[name]</h4>";
    echo "\n<p class='card-text'>$item[description]</p>";
    echo "\n<a href='./products/index.php?action=product&invid=$item[invid]' class='btn btn-primary'>View Details</a>";
    echo "\n</div>";
    echo "\n</div>";
  } ?>
</div>

<?php include './common/footer.php'; ?>