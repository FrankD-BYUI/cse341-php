<?php 
  session_start();
  //session_unset();
  //session_destroy();

  $cartCount = 0;
  if (isset($_SESSION['cart'])) {
    $cart = ($_SESSION['cart']);
    foreach($cart as $item => $count) {
      $cartCount += $count;
    }
  }
?>
<?php $pageTitle = "The Thing Store | Browse";
include $_SERVER['DOCUMENT_ROOT'] . '/prove03/common/header.php'; ?>

<h1>Welcome to the Thing Store!</h1>

<?php 
if(isset($_SESSION['message'])) {
  echo $_SESSION['message'];
  $_SESSION['message'] = null;
}
?>

<div class="card-container container">
  <div class="card">
    <img class="card-img-top" src="https://i.imgur.com/i6Ykp0J.png" alt="Thing 1">
    <div class="card-body">
      <h5 class="card-title">Thing 1</h5>
      <p class="card-text">Have you ever wanted a thing? Well this is just that thing! More specifically, this is Thing 1.</p>
      <a href="/prove03/add-item.php?item=thing1" class="btn btn-primary">Add to Cart <i class="bi bi-cart-plus"></i></a>
    </div>
  </div>
  <div class="card">
    <img class="card-img-top" src="https://i.imgur.com/FmTDNQY.png" alt="Thing 2">
    <div class="card-body">
      <h5 class="card-title">Thing 2</h5>
      <p class="card-text">Have you ever wanted a thing? Well this is just that thing! More specifically, this is Thing 2.</p>
      <a href="/prove03/add-item.php?item=thing2" class="btn btn-primary">Add to Cart <i class="bi bi-cart-plus"></i></a>
    </div>
  </div>
  <div class="card">
    <img class="card-img-top" src="https://i.imgur.com/gqEoeqc.png" alt="Thing 3">
    <div class="card-body">
      <h5 class="card-title">Thing 3</h5>
      <p class="card-text">Have you ever wanted a thing? Well this is just that thing! More specifically, this is Thing 3.</p>
      <a href="/prove03/add-item.php?item=thing3" class="btn btn-primary">Add to Cart <i class="bi bi-cart-plus"></i></a>
    </div>
  </div>
  <div class="card">
    <img class="card-img-top" src="https://i.imgur.com/8vygOvw.png" alt="Thing 4">
    <div class="card-body">
      <h5 class="card-title">Thing 4</h5>
      <p class="card-text">Have you ever wanted a thing? Well this is just that thing! More specifically, this is Thing 4.</p>
      <a href="/prove03/add-item.php?item=thing4" class="btn btn-primary">Add to Cart <i class="bi bi-cart-plus"></i></a>
    </div>
  </div>
  <div class="card">
    <img class="card-img-top" src="https://i.imgur.com/uM9j5Ut.png" alt="Thing 5">
    <div class="card-body">
      <h5 class="card-title">Thing 5</h5>
      <p class="card-text">Have you ever wanted a thing? Well this is just that thing! More specifically, this is Thing 5.</p>
      <a href="/prove03/add-item.php?item=thing5" class="btn btn-primary">Add to Cart <i class="bi bi-cart-plus"></i></a>
    </div>
  </div>
  <div class="card">
    <img class="card-img-top" src="https://i.imgur.com/AOSMV3C.png" alt="Thing 6">
    <div class="card-body">
      <h5 class="card-title">Thing 6</h5>
      <p class="card-text">Have you ever wanted a thing? Well this is just that thing! More specifically, this is Thing 6.</p>
      <a href="/prove03/add-item.php?item=thing6" class="btn btn-primary">Add to Cart <i class="bi bi-cart-plus"></i></a>
    </div>
  </div>
  <div class="card">
    <img class="card-img-top" src="https://i.imgur.com/arGEz6K.png" alt="Thing 7">
    <div class="card-body">
      <h5 class="card-title">Thing 7</h5>
      <p class="card-text">Have you ever wanted a thing? Well this is just that thing! More specifically, this is Thing 7.</p>
      <a href="/prove03/add-item.php?item=thing7" class="btn btn-primary">Add to Cart <i class="bi bi-cart-plus"></i></a>
    </div>
  </div>
  <div class="card">
    <img class="card-img-top" src="https://i.imgur.com/XOH693Z.png" alt="Thing 8">
    <div class="card-body">
      <h5 class="card-title">Thing 8</h5>
      <p class="card-text">Have you ever wanted a thing? Well this is just that thing! More specifically, this is Thing 8.</p>
      <a href="/prove03/add-item.php?item=thing8" class="btn btn-primary">Add to Cart <i class="bi bi-cart-plus"></i></a>
    </div>
  </div>
  <div class="card">
    <img class="card-img-top" src="https://i.imgur.com/gsFK6KW.png" alt="Thing 9">
    <div class="card-body">
      <h5 class="card-title">Thing 9</h5>
      <p class="card-text">Have you ever wanted a thing? Well this is just that thing! More specifically, this is Thing 9.</p>
      <a href="/prove03/add-item.php?item=thing9" class="btn btn-primary">Add to Cart <i class="bi bi-cart-plus"></i></a>
    </div>
  </div>
  <div class="card">
    <img class="card-img-top" src="https://i.imgur.com/yuNC207.png" alt="Thing 10">
    <div class="card-body">
      <h5 class="card-title">Thing 10</h5>
      <p class="card-text">Have you ever wanted a thing? Well this is just that thing! More specifically, this is Thing 10.</p>
      <a href="/prove03/add-item.php?item=thing10" class="btn btn-primary">Add to Cart <i class="bi bi-cart-plus"></i></a>
    </div>
  </div>
</div>


<?php include $_SERVER['DOCUMENT_ROOT'] . '/prove03/common/footer.php'; ?>