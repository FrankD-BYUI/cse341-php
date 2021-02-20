<?php
session_start();
require_once '../models/account-model.php';
require_once '../models/order-model.php';

$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);
if ($action == NULL) {
  $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
}

switch ($action) {
  case 'login':
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
      $user = getUserByID($_SESSION['userDetails']['userid']);
      $orders = getOrders($_SESSION['userDetails']['userid']);
      include '../view/account.php';
    } else {
      include '../view/login.php';
    }
    break;

  case 'register':
    include '../view/register.php';
    break;

  case 'logout':
    session_destroy();
    header('location: ../index.php');
    break;

  case 'login-submit':
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
    $userpw = filter_input(INPUT_POST, 'userpw', FILTER_SANITIZE_STRING);

    if (empty($email) || empty($userpw)) {
      $_SESSION['message'] =
        "<div class='alert alert-danger' role='alert'>" .
        "All fields are requried, please try again." .
        "</div>";
      include '../view/login.php';
      exit;
    }

    $userDetails = getUserByEmail($email);

    $correctPW = password_verify($userpw, $userDetails['userpw']);

    if (!$correctPW) {
      $_SESSION['message'] =
        "<div class='alert alert-danger' role='alert'>" .
        "Invalid Email or Password." .
        "</div>";
      include '../view/login.php';
      exit;
    }

    $_SESSION['message'] =
      "<div class='alert alert-success' role='alert'>" .
      "Log in Successful, Welcome $userDetails[fname]." .
      "</div>";
    $_SESSION['loggedin'] = TRUE;
    unset($userDetails['userpw']);
    $_SESSION['userDetails'] = $userDetails;
    header('location: ../index.php');
    exit;
    break;

  case 'register-submit':
    $fname = filter_input(INPUT_POST, 'fname', FILTER_SANITIZE_STRING);
    $lname = filter_input(INPUT_POST, 'lname', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
    $userpw = filter_input(INPUT_POST, 'userpw', FILTER_SANITIZE_STRING);

    $existingEmail = checkExistingEmail($email);

    //TODO: output error if email already exists

    //TODO: enforce password constraints

    if (empty($fname) || empty($lname) || empty($email) || empty($userpw)) {
      $_SESSION['message'] =
        "<div class='alert alert-danger' role='alert'>" .
        "All fields are requried, please try again." .
        "</div>";
      include '../view/register.php';
      exit;
    }

    $hashedUserPW = password_hash($userpw, PASSWORD_DEFAULT);
    $registrationSuccess = registerUser($fname, $lname, $email, $hashedUserPW);

    if ($registrationSuccess) {
      $_SESSION['message'] =
        "<div class='alert alert-success' role='alert'>" .
        "Registration Successful, Please log in." .
        "</div>";
      include '../view/login.php';
    } else {
      $_SESSION['message'] =
        "<div class='alert alert-danger' role='alert'>" .
        "Something went wrong, please try again." .
        "</div>";
      include '../view/register.php';
    }
    break;

  default:
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
      $user = getUserByID($_SESSION['userDetails']['userid']);
      $orders = getOrders($_SESSION['userDetails']['userid']);
      include '../view/account.php';
    } else {
      include '../view/login.php';
      break;
    }
}
