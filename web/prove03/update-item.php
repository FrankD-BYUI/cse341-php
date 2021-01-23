<?php
session_start();

require_once '../prove03/utilities.php';

$item = filter_input(INPUT_POST, "item", FILTER_SANITIZE_STRING);
$qty = filter_input(INPUT_POST, "qty", FILTER_SANITIZE_NUMBER_INT);
$qty = intval($qty);

$message = "";

if (!isset($thingIndex[$item]) || !isset($_SESSION['cart'])) {
  $message = "<div class='alert alert-danger' role='alert'>";
  $message .= "\nAn error has occurred, please try again.";
  $message .= "\n</div>";
  $_SESSION['message'] = $message;
  header('Location: /prove03/cart.php');
  exit;
} 

$cart = $_SESSION['cart'];

if ($cart[$item] == $qty) {
  $message = "<div class='alert alert-warning' role='alert'>";
  $message .= "\nNo changes were requested.";
  $message .= "\n</div>";
} elseif ($qty <= 0) {
  unset($cart[$item]);
  $_SESSION['cart'] = $cart;
  $message = "<div class='alert alert-success' role='alert'>";
  $message .= "\n$thingIndex[$item] removed from cart.";
  $message .= "\n</div>";
} else {
  $cart[$item] = $qty;
  $_SESSION['cart'] = $cart;
  $message = "<div class='alert alert-success' role='alert'>";
  $message .= "\n$thingIndex[$item] quantity changed to $cart[$item].";
  $message .= "\n</div>";
}

$_SESSION['message'] = $message;
header('Location: /prove03/cart.php');