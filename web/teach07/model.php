<?php

require_once 'db.php';

function registerUser($username, $hasheduserpw) {
  $connection = connectDB();
  $sql = 'INSERT INTO t07user (username, userpw) VALUES (:username, :hasheduserpw)';
  $stmt = $connection->prepare($sql);
  $stmt->bindValue(':username', $username, PDO::PARAM_STR);
  $stmt->bindValue(':hasheduserpw', $hasheduserpw, PDO::PARAM_STR);
  $stmt->execute();
  $rowsChanged = $stmt->rowCount();
  $stmt->closeCursor();
  return $rowsChanged;
}

function getUserInfo($username) {
  $connection = connectDB();
  $sql = 'SELECT * FROM t07user WHERE username = :username';
  $stmt = $connection->prepare($sql);
  $stmt->bindValue(':username', $username, PDO::PARAM_STR);
  $stmt->execute();
  $userInfo = $stmt->fetch(PDO::FETCH_ASSOC);
  $stmt->closeCursor();
  return $userInfo;
}

function getUserNameByID($userid) {
  $connection = connectDB();
  $sql = 'SELECT username FROM t07user WHERE userid = :userid';
  $stmt = $connection->prepare($sql);
  $stmt->bindValue(':userid', $userid, PDO::PARAM_STR);
  $stmt->execute();
  $userInfo = $stmt->fetch(PDO::FETCH_ASSOC);
  $stmt->closeCursor();
  return $userInfo;
}