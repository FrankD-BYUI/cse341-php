<?php
session_start();
require_once '../models/item-model.php';

$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);
if ($action == NULL) {
  $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
}

switch ($action) {
  case 'product':
    if (isset($_GET['invid']) && !empty($_GET['invid'])) {
      $invid = filter_input(INPUT_GET, 'invid', FILTER_SANITIZE_NUMBER_INT);
    } else {
      header('Location: ../index.php');
      exit;
    }

    $item = getItemById($invid);

    if (!$item) {
      header('Location: ../index.php');
      exit;
    }

    include '../view/item-detail.php';
    break;

  case 'add-to-cart':
    // Check to see if a valid invid was passed in, if not go to home page
    if (isset($_POST['invid']) && !empty($_POST['invid'])) {
      $invid = filter_input(INPUT_POST, 'invid', FILTER_SANITIZE_NUMBER_INT);
    } else {
      header('Location: ../index.php');
      exit;
    }

    // make sure that invid exists in the db
    $item = getItemById($invid);
    if (!$item) {
      header('Location: ../index.php');
      exit;
    }

    // check to see if valid quantity was passed in, 
    // if not, correct or send to item page with error message
    if (isset($_POST['itemQty']) && !empty($_POST['itemQty'])) {
      $itemQty = $_POST['itemQty'];

      if ($itemQty > 25) {
        $itemQty = 25;
      } else if ($itemQty <= 0 || empty($itemQty)) {
        $_SESSION['message'] =
          "<div class='alert alert-danger' role='alert'>" .
          "Invalid quantity, please try again." .
          "</div>";
        include '../view/item-detail.php';
      }
    }

    // add the item to the cart
    if (isset($_SESSION['cart'])) {
      if (isset($_SESSION['cart'][$invid])) {
        $_SESSION['cart'][$invid] += $itemQty;
      }
    } else {
      $_SESSION['cart'][$invid] = $itemQty;
    }
    
    include '../view/item-detail.php';
    break;

  default:
    header('Location: ../index.php');
}
