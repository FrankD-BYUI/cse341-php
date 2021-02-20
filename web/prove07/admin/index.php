<?php
session_start();
if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin'] == true || !$_SESSION['userDetails']['isadmin']) {
  $_SESSION['message'] =
    "<div class='alert alert-danger' role='alert'>" .
    "Access denied." .
    "</div>";
  header('Location: ../index.php');
  die();
}

require_once '../models/account-model.php';
require_once '../models/order-model.php';

$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);
if ($action == NULL) {
  $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
}

switch ($action) {
  default:
    $orders = getAllOrders();
    $users = getAllUsers();
    include '../view/admin.php';
    break;
}
