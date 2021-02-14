<?php
include_once 'db.php';

function getAllItems()
{
  $connection = connectDB();
  $sql = 'SELECT * from inventory';
  $stmt = $connection->prepare($sql);
  $stmt->execute();
  $response = $stmt->fetchAll(PDO::FETCH_ASSOC);
  $stmt->closeCursor();
  return $response;
}

function getItemById($invid)
{
  $connection = connectDB();
  $sql = 'SELECT * from inventory WHERE invid = :invid';
  $stmt = $connection->prepare($sql);
  $stmt->bindValue(':invid', $invid, PDO::PARAM_INT);
  $stmt->execute();
  $response = $stmt->fetch(PDO::FETCH_ASSOC);
  $stmt->closeCursor();
  return $response;
}
