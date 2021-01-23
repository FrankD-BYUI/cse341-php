<?php
session_start();
//session_unset();
//session_destroy();

require_once '../prove03/utilities.php';

$cartCount = 0;
$cart;
if (isset($_SESSION['cart'])) {
  $cart = ($_SESSION['cart']);
}

$inputAddress = filter_input(INPUT_POST, "inputAddress", FILTER_SANITIZE_STRING);
$inputAddress2 = filter_input(INPUT_POST, "inputAddress2", FILTER_SANITIZE_STRING);
$inputCity = filter_input(INPUT_POST, "inputCity", FILTER_SANITIZE_STRING);
$inputState = filter_input(INPUT_POST, "inputState", FILTER_SANITIZE_STRING);
$inputZip = filter_input(INPUT_POST, "inputZip", FILTER_SANITIZE_STRING);
?>

<?php $pageTitle = "The Thing Store | Order Confirmation";
include $_SERVER['DOCUMENT_ROOT'] . '/prove03/common/header.php'; ?>

<h1>Thank you for your purchase</h1>

<div class="container">
  <h2>Invoice:</h2>
  <ul>
    <?php
    foreach ($cart as $item => $qty) {
      echo "<li>$thingIndex[$item] x $qty</li>";
    } ?>
  </ul>
</div>

<div class="container">
    <h2>Shipping Information:</h2>
    <?php 
    echo "<p>$inputAddress</p>"; 
    if (!is_null($inputAddress2)) {
      echo "<p>$inputAddress2</p>";
    }
    echo "<p>$inputCity, $inputState $inputZip</p>"
    ?>
</div>

<?php 
  unset($_SESSION['cart']);
?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/prove03/common/footer.php'; ?>s