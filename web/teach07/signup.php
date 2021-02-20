<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <style>
    .red {
      color: red;
    }
  </style>
</head>
<body>
  <?php 
  if (isset($message)) {
    echo "<span class='red'>$message</span>";
  } ?>
  <div class="red" id="pwError"></div>
  <form action="index.php" method="post">
    <label>Username: <input type="text" name='username' required <?php 
      if (isset($username)){
        echo "value='$username'";
      } ?>></label>
    <label>
      <?php 
        if (isset($message)) {
          echo "<span class='red'>*</span>";
        } ?>
      Password: <input type="password" name='userpw' id="userpw1" required pattern="^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$"></label>
    <label>
    <?php 
        if (isset($message)) {
          echo "<span class='red'>*</span>";
        } ?>
    Re-enter Password: <input type="password" name='userpw2' id="userpw2" required pattern="^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$" onkeyup="checkPwMatch();"></label>
    <input type="submit" value="Register">
    <input type="hidden" name="action" value="register">
  </form>

  <p>already registered? <a href="index.php?action=signin">Log in.</a></p>

  <script> 
    function checkPwMatch() {
      let pw1 = document.getElementById("userpw1").value;
      let pw2 = document.getElementById("userpw2").value;

      if (pw1 != pw2) {
        document.getElementById("pwError").innerText = "Passwords do not match";
      } else {
        document.getElementById("pwError").innerText = "";
      }

    }
  </script>
</body>
</html>