<?php
require_once 'db.php';

function getUserByID($userid)
{
  $connection = connectDB();
  $sql = 'SELECT * from users WHERE userid = :userid';
  $stmt = $connection->prepare($sql);
  $stmt->bindValue(':userid', $userid, PDO::PARAM_INT);
  $stmt->execute();
  $user = $stmt->fetch(PDO::FETCH_ASSOC);
  $stmt->closeCursor();
  return $user;
}

function getUserByEmail($email)
{
  $connection = connectDB();
  $sql = 'SELECT * from users WHERE email = :email';
  $stmt = $connection->prepare($sql);
  $stmt->bindValue(':email', $email, PDO::PARAM_STR);
  $stmt->execute();
  $user = $stmt->fetch(PDO::FETCH_ASSOC);
  $stmt->closeCursor();
  return $user;
}

function checkExistingEmail($email)
{
  $connection = connectDB();
  $sql = 'SELECT email FROM users WHERE email = :email';
  $stmt = $connection->prepare($sql);
  $stmt->bindValue(':email', $email, PDO::PARAM_STR);
  $stmt->execute();
  $emails = $stmt->fetch(PDO::FETCH_NUM);
  $stmt->closeCursor();
  if (empty($emails)) {
    return 0;
  } else {
    return 1;
  }
}

function registerUser($fname, $lname, $email, $userpw)
{
  $connection = connectDB();
  $sql = 'INSERT INTO users 
            (fname, lname, email, userpw)
          VALUES
            (:fname, :lname, :email, :userpw)';
  $stmt = $connection->prepare($sql);
  $stmt->bindValue(':fname', $fname, PDO::PARAM_STR);
  $stmt->bindValue(':lname', $lname, PDO::PARAM_STR);
  $stmt->bindValue(':email', $email, PDO::PARAM_STR);
  $stmt->bindValue(':userpw', $userpw, PDO::PARAM_STR);
  $stmt->execute();
  $rowsChanged = $stmt->rowCount();
  $stmt->closeCursor();
  return $rowsChanged;
}

function getAllUsers()
{
  $connection = connectDB();
  $sql = 'SELECT userid,
            email,
            CONCAT(fname, \' \', lname) as username,
            isadmin
          FROM users';
  $stmt = $connection->prepare($sql);
  $stmt->execute();
  $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
  $stmt->closeCursor();
  return $users;
}
