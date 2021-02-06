<?php
require 'db.php';

$invid = "";
if (isset($_GET['invid'])) {
  $invid = filter_input(INPUT_GET, 'invid', FILTER_SANITIZE_NUMBER_INT);
}

if (!$invid) {
  header('Location: /prove05/');
}

$connection = connectDB();

$sql = 'SELECT * from inventory WHERE invid = :invid';
$stmt = $connection->prepare($sql);
$stmt->bindValue(':invid', $invid, PDO::PARAM_INT);
$stmt->execute();
$response = $stmt->fetch(PDO::FETCH_ASSOC);
$stmt->closeCursor();

$pageTitle = "Silly Scents | $response[name]";
include '/prove05/common/header.php';
?>

<h1><?php echo $response['name']; ?></h1>
<img class='card-img-top' src='/prove05/images/default-candle.png' alt='candle'>
<p><?php echo $item['description']; ?></p>
<a href='#' class='btn btn-primary'>Add to Cart</a>

<?php include 'prove05/common/footer.php'; ?>