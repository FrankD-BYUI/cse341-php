<?php
$pageTitle = "Silly Scents | My Account";
$active = "account";
include '../common/header.php';

?>

<h1>Hello <?php echo $user['fname']; ?></h1>

<?php
if (isset($_SESSION['message'])) {
  echo $_SESSION['message'];
  unset($_SESSION['message']);
} ?>

<p>Name: <?php echo $user['fname'] . " " . $user['lname'] ?></p>
<p>Email: <?php echo $user['email'] ?> </p>

<h2>Order History</h2>
<?php
if (!$orders) {
  echo '<p>You do not have any orders.</p>';
} else {
  echo '<table>
    <tr>
      <th>Order #:</th>
      <th>Order Date:</th>
      <th>Items:</th>
      <th>Price:</th>
      <th>Shipping Address</th>
    </tr>';

  foreach ($orders as $order) {
    $orderDetails = getOrderDetails($order['orderid']);
    $orderItems = 0;
    $orderPrice = 0.00;

    foreach ($orderDetails as $item) {
      $orderItems += $item['qty'];
      $orderPrice += $item['price'] * $item['qty'];
    }

    echo "<tr>
        <td>$order[orderid]</td>
        <td>" . date('m/d/Y', strtotime($order['orderdate'])) . "</td>
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

<?php include '../common/footer.php'; ?>