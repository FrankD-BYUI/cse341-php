<?php
require 'db.php';

$connection = connectDB();

$sql = 'SELECT * from inventory';
$stmt = $connection->prepare($sql);
$stmt->execute();
$response = $stmt->fetchAll(PDO::FETCH_ASSOC);
$stmt->closeCursor();

$pageTitle = "Silly Scents | Home";
include $_SERVER['DOCUMENT_ROOT'] . '/prove05/common/header.php';
?>

<h1>Silly Scents Candles</h1>

<div class="card-container container">
  <?php
  foreach ($response as $item) {
    echo "\n<div class='card'>";
    echo "\n<img class='card-img-top' src='/prove05/images/default-candle.png' alt='candle'>";
    echo "\n<div class='card-body'>";
    echo "\n<h5 class='card-title'>$item[name]</h5>";
    echo "\n<p class='card-text'>$item[description]</p>";
    echo "\n<a href='/prove05/item-detail.php?invid=$item[invid]' class='btn btn-primary'>View Details</a>";
    echo "\n</div>";
    echo "\n</div>";
  } ?>
</div>

<?php include $_SERVER['DOCUMENT_ROOT'] . 'prove05/common/footer.php'; ?>