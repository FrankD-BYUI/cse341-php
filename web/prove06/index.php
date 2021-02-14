<?php
session_start();
require_once 'models/item-model.php';

$items = getAllItems();

$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);
if ($action == NULL) {
  $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
}

switch ($action) {
  default:
    include 'view/home.php';
    break;
}
