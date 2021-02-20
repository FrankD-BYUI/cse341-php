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
      die();
    }

    $item = getItemById($invid);

    if (!$item) {
      header('Location: ../index.php');
      die();
    }

    include '../view/item-detail.php';
    break;

  default:
    header('Location: ../index.php');
}
