<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
  $_SESSION['loggedin'] = false;
}

require_once 'model.php';

$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);
if ($action == NULL) {
  $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
}

switch ($action) {
  case 'signin':
    if ($_SESSION['loggedin']) {
      $username = getUserNameByID($_SESSION['userid']);
      include 'welcome.php';
      break;
    }
    include 'signin.php';
    break;

  case 'welcome':
    if ($_SESSION['loggedin']) {
      $username = getUserNameByID($_SESSION['userid']);
      include 'welcome.php';
      break;
    }
    include 'signin.php';
    break;

  case 'register':
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $userpw = filter_input(INPUT_POST, 'userpw', FILTER_SANITIZE_STRING);
    $userpw2 = filter_input(INPUT_POST, 'userpw2', FILTER_SANITIZE_STRING);

    if ($userpw !== $userpw2) {
      $message = 'Error: passwords must match!';
      $userpw = null;
      $userpw2 = null;
      include 'signup.php';
      break;
    }

    if (!preg_match('/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/', $userpw)) {
      $message = 'Error: password must be at least 7 charagerts and include a number!';
      $userpw = null;
      $userpw2 = null;
      include 'signup.php';
      break;
    }

    $hasheduserpw = password_hash($userpw, PASSWORD_DEFAULT);

    $success = registerUser($username, $hasheduserpw);

    if ($success) {
      header('Location: index.php?action=signin');
      die();
    }
    break;

  case 'signin-submit':
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $userpw = filter_input(INPUT_POST, 'userpw', FILTER_SANITIZE_STRING);

    if (empty($username) || empty($userpw)) {
      include 'signin.php';
      die();
    }

    $userInfo = getUserInfo($username);

    if (password_verify($userpw, $userInfo['userpw'])) {
      $_SESSION['loggedin'] = true;
      $_SESSION['userid'] = $userInfo['userid'];

      include 'welcome.php';
      break;
    }


    break;

  default:
    if ($_SESSION['loggedin']) {
      include 'welcome.php';
      break;
    }
    include 'signup.php';
    break;
}
