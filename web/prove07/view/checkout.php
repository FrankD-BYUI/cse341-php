<?php
if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
  header('Location: ../account/index.php?action=login');
  die();
}
if (is_null($cart) || empty($cart)) {
  header('Location: ./index.php?action=view-cart');
  die();
}

$pageTitle = "Silly Scents | Checkout";
$active = "cart";
include '../common/header.php';
?>

<h1>Order Summary:</h1>
<?php

if (isset($_SESSION['message'])) {
  echo $_SESSION['message'];
  unset($_SESSION['message']);
} ?>

<table>
  <tr>
    <th>Item:</th>
    <th>Price:</th>
    <th>Quantity:</th>
  </tr>
  <?php
  $cartTotal = 0;
  $cartQty = 0;
  foreach ($cart as $itemInCart => $itemQty) {
    foreach ($cartItemDetails as $itemDetails) {
      if ($itemDetails['invid'] === $itemInCart) {
        $cartTotal += $itemDetails['price'] * $itemQty;
        $cartQty += $itemQty; ?>
        <tr>
          <td><?php echo $itemDetails['name'] ?></a></td>
          <td><?php echo $itemDetails['price'] * $itemQty ?></td>
          <td><?php echo $itemQty ?></td>
        </tr>
  <?php break;
      }
    }
  } ?>
  <tr>
    <td class="text-right">Total:</td>
    <td>$<?php echo number_format($cartTotal, 2); ?></td>
    <td><?php echo $cartQty; ?></td>
    <td></td>
    <td></td>
  </tr>
</table>
<hr>

<form action="./index.php" method="POST" class="login-form">
  <div>
    <label for="address" class="form-label">Shipping address</label>
    <input type="text" class="form-control" id="shippingaddress" name="shippingaddress" required>
  </div>
  <button type="submit" class="btn btn-primary">Place Order</button>
  <input type="hidden" name="action" value="order-submit">
</form>


<?php include '../common/footer.php'; ?>