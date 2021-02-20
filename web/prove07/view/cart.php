<?php
$pageTitle = "Silly Scents | My Cart";
$active = "cart";
include '../common/header.php';
?>

<h1>The cart</h1>
<?php

if (isset($_SESSION['message'])) {
  echo $_SESSION['message'];
  unset($_SESSION['message']);
}

if (is_null($cart) || empty($cart)) {
  echo '<p>There is nothing in your cart</p>';
} else { ?>
  <table class="cart">
    <tr>
      <th>Item:</th>
      <th>Price:</th>
      <th>Quantity:</th>
      <th></th>
    </tr>
    <?php
    $cartTotal = 0;
    $cartQty = 0;
    foreach ($cart as $itemInCart => $itemQty) {
      foreach ($cartItemDetails as $itemDetails) {
        if ($itemDetails['invid'] === $itemInCart) { 
          $cartTotal += $itemDetails['price'] * $itemQty;
          $cartQty += $itemQty;
          ?>
          <tr>
            <td><a href="../products/index.php?action=product&invid=<?php echo $itemDetails['invid'] ?>"><?php echo $itemDetails['name'] ?></a></td>
            <td>$<?php echo $itemDetails['price'] * $itemQty ?></td>
            <td>
              <form action="index.php" method="POST" class="item-form">
                <div class="mb-3">
                  <input type="number" class="form-control" id="itemQty" name="itemQty" min="0" max="25" value="<?php echo $itemQty ?>" required>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
                <input type="hidden" name="invid" value="<?php echo $itemInCart; ?>">
                <input type="hidden" name="action" value="update-cart">
              </form>
            </td>
            <td>
              <form action="index.php" method="POST" class="item-form">
                <button type="submit" class="btn btn-danger ">Delete</button>
                <input type="hidden" name="invid" value="<?php echo $itemInCart; ?>">
                <input type="hidden" name="itemQty" value="0">
                <input type="hidden" name="action" value="update-cart">
              </form>
            </td>
          </tr>
    <?php break;
        }
      }
    } ?>
    <tr>
      <td class="text-right">Total:</td>
      <td>$<?php echo number_format($cartTotal,2); ?></td>
      <td><?php echo $cartQty; ?></td>
      <td></td>
      <td></td>
    </tr>
  </table>

  <?php
  if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) { ?>
    <p>
      Please
      <a href="../account/index.php?action=login">Log in</a> or
      <a href="../account/index.php?action=register">create an account</a>
      to finish your order.
    </p>
  <?php } else { ?>
    <a href='./index.php?action=checkout' class='btn btn-primary'>Continue to Checkout</a>
<?php }
} ?>


<?php include '../common/footer.php'; ?>