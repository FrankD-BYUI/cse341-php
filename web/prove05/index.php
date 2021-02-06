<?php
require 'db.php';

$pageTitle = "Silly Scents | Home";
include $_SERVER['DOCUMENT_ROOT'] . '/common/header.php'; 

$connection = connectDB();

$sql = 'SELECT * from inventory';
$stmt = $connection->prepare($sql);
$stmt->execute();
$response = $stmt->fetchAll(PDO::FETCH_ASSOC);
$stmt->closeCursor();
?>

<h1>Silly Scents Candles</h1>

<div class="card-container container">
<?php
foreach($response as $item) {
  echo '<div class="card">';
  echo "<img class='card-img-top' src='/prove05/images/default-candle.png' alt='candle'>";
  echo '<div class="card-body">';
  echo "<h5 class='card-title'>$item[name]</h5>";
  echo "<p class='card-text'>$item[description]</p>";
  echo "<a href='/prove05/item-detail.php?item=$item[invid]' class='btn btn-primary'>View Details</a>";
  echo '</div>';
  echo '</div>';
}
?>
</div>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/common/footer.php'; ?>