<?php 
  session_start();
  //session_unset();
  //session_destroy();

  require_once '../prove03/utilities.php';

  $cartCount = 0;
  if (isset($_SESSION['cart'])) {
    $cart = ($_SESSION['cart']);
    foreach($cart as $item => $count) {
      $cartCount += $count;
    }
  }
?>
<?php $pageTitle = "The Thing Store | Cart";
include $_SERVER['DOCUMENT_ROOT'] . '/prove03/common/header.php'; ?>

<h1>Shopping Cart</h1>

<?php 
  if($cartCount == 0) {
    echo '<h2>You have not yet added anything to your cart.</h2>';
  } else {
    $cart = $_SESSION['cart'];

    if(isset($_SESSION['message'])) {
      echo $_SESSION['message'];
      $_SESSION['message'] = null;
    }

    echo "<div class='card-container container'>";
    foreach($thingIndex as $thing => $thingName) {
      if (isset($cart[$thing])) {
        echo "<div class='card card-wide'>";
        echo "<h5 class='card-header'>$thingName</h5>";
        echo "<div class='card-body'>";
        echo "<form action='/prove03/update-item.php' method='post'>";
        echo "<label>Quantity: <input type='number' name='qty' min='0' value='$cart[$thing]'></label>";
        echo "<input type='hidden' name='item' value='$thing'>";
        echo "<input type='submit' value='Update Cart' class='btn btn-success'>";
        echo "</form>";
        echo "</div>";
        echo "</div>";
      }
    }
    echo "</div>";
    echo "<div class='container button-box'>";
    echo "<button type='button' class='btn btn-success' onclick='window.location=\"/prove03/checkout.php\"'>Place Order</button>";
    echo "<div>";
  }
?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/prove03/common/footer.php'; ?>