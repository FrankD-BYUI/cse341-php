<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <form action="index.php" method="post">
    <label>Username: <input type="text" name='username'></label>
    <label>Password: <input type="password" name='userpw'></label>
    <input type="submit" value="Sign in">
    <input type="hidden" name="action" value="signin-submit">
  </form>

  <p>Not registered? <a href="index.php?action=signup">Create an account.</a></p>
</body>
</html>