<?php
session_start();
//session_unset();
//session_destroy();
//var_dump($_GET);
//var_dump($_SESSION);

require_once '../prove03/utilities.php';

$item = filter_input(INPUT_GET, "item", FILTER_SANITIZE_STRING);
if (!isset($thingIndex[$item])) {
  $message = "<div class='alert alert-danger' role='alert'>";
  $message .= "\nAn error has occurred, please try again.";
  $message .= "\n</div>";
  $_SESSION['message'] = $message;
  header('Location: /prove03/');
  exit;
}

if (isset($_SESSION['cart'])) {
  $cart = $_SESSION['cart'];
  if (array_key_exists($item, $cart)) {
    $cart[$item] += 1;
  } else {
    $cart[$item] = 1;
  }
  $_SESSION['cart'] = $cart;
} else {
  $_SESSION['cart'] = [
    $item => 1
  ];
}
$message = "<div class='alert alert-success' role='alert'>";
$message .= "\n$thingIndex[$item] added to cart.";
$message .= "\n</div>";
$_SESSION['message'] = $message;
//var_dump($_SESSION);
header('Location: /prove03/');
