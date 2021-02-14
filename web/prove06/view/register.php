<?php
$pageTitle = "Silly Scents | Register";
$active = "login";
include '../common/header.php';
?>

<h1>Please Enter Your Information:</h1>

<?php
if (isset($_SESSION['message'])) {
  echo $_SESSION['message'];
  unset($_SESSION['message']);
} ?>

<form action="../account/" method="POST" class="login-form">
  <div class="mb-3">
    <label for="fname" class="form-label">First Name</label>
    <input type="fname" class="form-control" id="fname" name="fname" required>
  </div>
  <div class="mb-3">
    <label for="lname" class="form-label">Last Name</label>
    <input type="lname" class="form-control" id="lname" name="lname" required>
  </div>
  <div class="mb-3">
    <label for="email" class="form-label">Email address</label>
    <input type="email" class="form-control" id="email" name="email" required>
  </div>
  <div class="mb-3">
    <label for="password" class="form-label">Password</label>
    <input type="password" class="form-control" id="password" name="userpw" required>
  </div>
  <button type="submit" class="btn btn-primary">Register</button>
  <input type="hidden" name="action" value="register-submit">
</form>

<?php include '../common/footer.php'; ?>