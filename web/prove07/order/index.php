<?php
session_start();
require_once '../models/order-model.php';
require_once '../models/item-model.php';

$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);
if ($action == NULL) {
  $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
}

$cart = null;
if (isset($_SESSION['cart'])) {
  $cart = $_SESSION['cart'];
}
$cartItemDetails = getAllItemsForCart($cart);

switch ($action) {
  case 'view-cart':
    include '../view/cart.php';
    break;

  case 'update-cart':
    // Check to see if a valid invid was passed in, if not go to home page
    if (isset($_POST['invid']) && !empty($_POST['invid'])) {
      $invid = filter_input(INPUT_POST, 'invid', FILTER_SANITIZE_NUMBER_INT);
    } else {
      header('Location: ../index.php');
      die();
    }

    // make sure that invid exists in the db
    if (!ItemIdExists($invid)) {
      header('Location: ../index.php');
      die();
    }

    // check to see if valid quantity was passed in, 
    // if not, correct or send to item page with error message
    if (isset($_POST['itemQty']) && !empty($_POST['itemQty'])) {
      $itemQty = $_POST['itemQty'];
    } else {
      $itemQty = 0;
    }

    // Make sure the item is in the cart and update it
    if (isset($_SESSION['cart'][$invid])) {
      if ($itemQty <= 0) {
        unset($_SESSION['cart'][$invid]);
        $_SESSION['message'] =
          "<div class='alert alert-success' role='alert'>" .
          "Item removed from cart." .
          "</div>";
      } else {
        $_SESSION['cart'][$invid] = intval($itemQty);
        $_SESSION['message'] =
          "<div class='alert alert-success' role='alert'>" .
          "Item quantity updated." .
          "</div>";
      }
    } else {
      $_SESSION['message'] =
        "<div class='alert alert-danger' role='alert'>" .
        "Attempted to modify an item that wasn't in the cart, please try again." .
        "</div>";
      header('Location: index.php?action=view-cart');
    }

    header('Location: index.php?action=view-cart');
    die();
    break;

  case 'add-to-cart':
    // Check to see if a valid invid was passed in, if not go to home page
    if (isset($_POST['invid']) && !empty($_POST['invid'])) {
      $invid = filter_input(INPUT_POST, 'invid', FILTER_SANITIZE_NUMBER_INT);
    } else {
      header('Location: ../index.php');
      die();
    }

    // make sure that invid exists in the db
    if (!ItemIdExists($invid)) {
      header('Location: ../index.php');
      die();
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
        header("Location: ../products/index.php?action=product&invid=$invid");
      }
    }

    // add the item to the cart
    // check to see if the cart is already initialized,
    // if cart is initialized, check to see if cart already has this item
    // if cart already has this item, add new qty to it.
    // if cart does not have this item, add item
    // if cart is not alrady initialized, add cart and this item to the session.
    if (isset($_SESSION['cart'])) {
      if (isset($_SESSION['cart'][$invid])) {
        $_SESSION['cart'][$invid] += intval($itemQty);
      } else {
        $_SESSION['cart'][$invid] = intval($itemQty);
      }
    } else {
      $_SESSION['cart'][$invid] = intval($itemQty);
    }
    ksort($_SESSION['cart']);

    header("Location: ../products/index.php?action=product&invid=$invid");
    break;

  case 'checkout':
    if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
      header("Location: ../account/index?action=login");
      die();
    }

    if (is_null($cart) || empty($cart)) {
      header("Location: ./index.php?action=view-cart");
      die();
    }

    include '../view/checkout.php';
    break;


  case 'order-submit':
    // make sure user is logged in
    if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
      header("Location: ../account/index?action=login");
      die();
    }

    // make sure there's something in the cart
    if (is_null($cart) || empty($cart)) {
      header("Location: ./index.php?action=view-cart");
      die();
    }

    // make sure you have an address
    //echo ($_POST['shippingaddress']);
    if (isset($_POST['shippingaddress']) && !empty($_POST['shippingaddress'])) {
      $shippingaddress = filter_input(INPUT_POST, 'shippingaddress', FILTER_SANITIZE_STRING);
    } else {
      header("Location: ./index.php?action=view-cart");
      die();
    }
    //echo $shippingaddress;

    echo var_dump($_SESSION);
    $orderid = placeOrder($_SESSION['userDetails']['userid'], $shippingaddress);

    foreach ($cart as $invid => $qty) {
      placeOrderItem($orderid, $invid, $qty);
    }

    unset($_SESSION['cart']);

    $_SESSION['message'] =
      "<div class='alert alert-success' role='alert'>" .
      "Order sucessfully placed." .
      "</div>";

    header('Location: ../account/index.php');
    break;


  default:
    header('Location: ../index.php');
    break;
}
