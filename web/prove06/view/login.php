<?php
$pageTitle = "Silly Scents | Log In";
$active = "login";
include '../common/header.php';
?>

<h1>Please Log In:</h1>

<?php
if (isset($_SESSION['message'])) {
  echo $_SESSION['message'];
  unset($_SESSION['message']);
} ?>

<form action="index.php" method="POST" class="login-form">
  <div class="mb-3">
    <label for="email" class="form-label">Email address</label>
    <input type="email" class="form-control" id="email" name="email" required>
  </div>
  <div class="mb-3">
    <label for="userpw" class="form-label">Password</label>
    <input type="password" class="form-control" id="userpw" name="userpw" required>
  </div>
  <button type="submit" class="btn btn-primary">Log In</button>
  <input type="hidden" name="action" value="login-submit">
</form>

<h3>Don't have an account yet?</h3>
<a href='index.php?action=register' class='btn btn-primary'>Register</a>


<?php include '../common/footer.php'; ?>