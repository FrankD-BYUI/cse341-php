<?php
require 'db.php';

$connection = connectDB();

$userid = 2;
$sql = 'SELECT * from users WHERE userid = :userid';
$stmt = $connection->prepare($sql);
$stmt->bindValue(':userid', $userid, PDO::PARAM_INT);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);
$stmt->closeCursor();

$sql = 'SELECT orders.orderid, orders.shippingaddress, orders.orderdate,
            CONCAT(users.fname, " ", users.lname) as username 
          FROM orders
          inner join users on order.userid = users.userid
          WHERE users.userid = :userid';
$stmt = $connection->prepare($sql);
$stmt->bindValue(':userid', $userid, PDO::PARAM_INT);
$stmt->execute();
$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
$stmt->closeCursor();

function getOrderDetails($ordernum)
{
  $connection = connectDB();
  $sql = 'SELECT inventory.name, orderItems.qty, inventory.price 
            FROM orderItems
            inner join inventory on orderitems.invid = inventory.invid
            WHERE orderItems.orderid = :ordernum';
  $stmt = $connection->prepare($sql);
  $stmt->bindValue(':ordernum', $ordernum, PDO::PARAM_INT);
  $stmt->execute();
  $orderDetails = $stmt->fetchAll(PDO::FETCH_ASSOC);
  $stmt->closeCursor();
  return $orderDetails;
}

$pageTitle = "Silly Scents | My Account";
include $_SERVER['DOCUMENT_ROOT'] . '/prove05/common/header.php';
?>

<h1>Hello <?php echo $user['fname']; ?></h1>
<p>Name: <?php echo $user['fname'] . " " . $user['lname'] ?></p>
<p>Email: <?php echo $user['email'] ?> </p>

<h2>Order History</h2>
<?php
if ($orders) {
  echo '<table>
    <tr>
      <th>Order Number:</th>
      <th>Order Date:</th>
      <th>Items:</th>
      <th>Price:</th>
      <th>Shipping Address</th>
    </tr>';

  foreach ($orders as $order) {
    $orderDetails = getOrderDetails($order);
    $orderItems = 0;
    $orderPrice = 0.00;

    foreach ($orderDetails as $item) {
      $orderItems += $item['qty'];
      $orderPrice += $item['price'];
    }

    echo "<tr>
        <td>$order[orderid]</td>
        <td>date('m/d/Y',$order[orderdate])</td>
        <td>$orderItems</td>
        <td>$orderPrice</td>
        <td>
          <div>$order[username]</div>
          <div>$order[shippingaddress]</div>
        </td>
      </tr>";
  }
  echo '</table>';
} ?>

<?php include $_SERVER['DOCUMENT_ROOT'] . 'prove05/common/footer.php'; ?>