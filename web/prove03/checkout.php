<?php
session_start();
//session_unset();
//session_destroy();

require_once '../prove03/utilities.php';

$cartCount = 0;
if (isset($_SESSION['cart'])) {
  $cart = ($_SESSION['cart']);
  foreach ($cart as $item => $count) {
    $cartCount += $count;
  }
}
?>
<?php $pageTitle = "The Thing Store | Checkout";
include $_SERVER['DOCUMENT_ROOT'] . '/prove03/common/header.php'; ?>

<h1>Checkout</h1>

<form action='/prove03/confirm.php' method='post'>
  <fieldset>
    <legend>Shipping Information</legend>
    <div class="form-group">
      <label for="inputAddress">Address</label>
      <input type="text" class="form-control" id="inputAddress" name="inputAddress" placeholder="1234 Main St" required>
    </div>
    <div class="form-group">
      <label for="inputAddress2">Address 2</label>
      <input type="text" class="form-control" id="inputAddress2" name="inputAddress2" placeholder="Apartment, studio, or floor">
    </div>
    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="inputCity">City</label>
        <input type="text" class="form-control" id="inputCity" name="inputCity" required>
      </div>
      <div class="form-group col-md-4">
        <label for="inputState">State</label>
        <input type="text" class="form-control" id="inputState" name="inputState" required>
      </div>
      <div class="form-group col-md-2">
        <label for="inputZip">Zip</label>
        <input type="text" class="form-control" id="inputZip" name="inputZip" required>
      </div>
    </div>
    <input type='submit' value='Checkout' class='btn btn-success'>
    <button type='button' class='btn btn-secondary' onclick='window.location="/prove03/cart.php"'>Back to Cart</button>
  </fieldset>

</form>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/prove03/common/footer.php'; ?>