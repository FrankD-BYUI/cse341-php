<?php
$pageTitle = "Silly Scents | $item[name]";
$active = "home";
include '../common/header.php';
?>

<h1><?php echo $item['name']; ?></h1>
<img class='card-img-top' src='../images/default-candle.png' alt='candle'>
<p><?php echo $item['description']; ?></p>
<p><?php echo '$' . $item['price']; ?></p>
<form action="../order/index.php" method="POST" class="item-form">
  <div class="mb-3">
    <input type="number" class="form-control" id="itemQty" name="itemQty" min="1" max="25" value="1" required>
  </div>
  <button type="submit" class="btn btn-primary">Add to cart</button>
  <input type="hidden" name="invid" value="<?php echo $item['invid']; ?>">
  <input type="hidden" name="action" value="add-to-cart">
</form>

<?php include '../common/footer.php'; ?>