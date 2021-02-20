<?php
require_once 'db.php';
// require_once 'item-model.php';

function placeOrder($userid, $shippingaddress)
{
  $connection = connectDB();
  $sql = 'INSERT INTO orders
            (userid, shippingaddress)
          VALUES
            (:userid, :shippingaddress)
          RETURNING orderid';
  $stmt = $connection->prepare($sql);
  $stmt->bindValue(':userid', $userid, PDO::PARAM_STR);
  $stmt->bindValue(':shippingaddress', $shippingaddress, PDO::PARAM_STR);
  $stmt->execute();
  $orderid = intval($connection->lastInsertId());
  $stmt->closeCursor();
  return $orderid;
}

function placeOrderItem($orderid, $invid, $qty)
{
  $connection = connectDB();
  $sql = 'INSERT INTO orderitems
          VALUES (:orderid, :invid, :qty)';
  $stmt = $connection->prepare($sql);
  $stmt->bindValue(':orderid', $orderid, PDO::PARAM_INT);
  $stmt->bindValue(':invid', $invid, PDO::PARAM_INT);
  $stmt->bindValue(':qty', $qty, PDO::PARAM_INT);
  $stmt->execute();
  $stmt->closeCursor();
}

function getOrders($userid)
{
  $connection = connectDB();
  $sql = 'SELECT orders.orderid, orders.shippingaddress, orders.orderdate,
            CONCAT(users.fname, \' \', users.lname) as username 
          FROM orders
          inner join users on orders.userid = users.userid
          WHERE users.userid = :userid';
  $stmt = $connection->prepare($sql);
  $stmt->bindValue(':userid', $userid, PDO::PARAM_INT);
  $stmt->execute();
  $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
  $stmt->closeCursor();
  return $orders;
}

function getAllOrders()
{
  $connection = connectDB();
  $sql = 'SELECT orders.orderid, orders.shippingaddress, orders.orderdate,
            CONCAT(users.fname, \' \', users.lname) AS username, users.userid, users.email 
          FROM orders
          INNER JOIN users ON orders.userid = users.userid
          ORDER BY orders.orderdate DESC';
  $stmt = $connection->prepare($sql);
  $stmt->execute();
  $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
  $stmt->closeCursor();
  return $orders;
}

function getOrderDetails($orderid)
{
  $connection = connectDB();
  $sql = 'SELECT inventory.name, orderItems.qty, inventory.price 
            FROM orderItems
            inner join inventory on orderitems.invid = inventory.invid
            WHERE orderItems.orderid = :orderid';
  $stmt = $connection->prepare($sql);
  $stmt->bindValue(':orderid', $orderid, PDO::PARAM_INT);
  $stmt->execute();
  $orderDetails = $stmt->fetchAll(PDO::FETCH_ASSOC);
  $stmt->closeCursor();
  return $orderDetails;
}
