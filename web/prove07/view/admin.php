<?php
if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin'] == true || !$_SESSION['userDetails']['isadmin']) {
  $_SESSION['message'] =
    "<div class='alert alert-danger' role='alert'>" .
    "Access denied." .
    "</div>";
  header('Location: ../index.php');
  die();
}

$pageTitle = "Silly Scents | Admin";
$active = "admin";
include '../common/header.php';
?>

<h1>Admin Tools</h1>

<?php
if (isset($_SESSION['message'])) {
  echo $_SESSION['message'];
  unset($_SESSION['message']);
} ?>

<h2>Orders</h2>
<table class="table-lines">
  <tr>
    <th>Order #:</th>
    <th>Order Date:</th>
    <th>User ID:</th>
    <th>User Email:</th>
    <th>Items:</th>
    <th>Price:</th>
    <th>Shipping Address</th>
  </tr>

  <?php
  foreach ($orders as $order) {
    $orderDetails = getOrderDetails($order['orderid']);
    $orderItems = 0;
    $orderPrice = 0.00;

    foreach ($orderDetails as $item) {
      $orderItems += $item['qty'];
      $orderPrice += $item['price'] * $item['qty'];
    } ?>
    <tr>
      <td><?php echo $order['orderid']; ?></td>
      <td><?php echo date('m/d/Y', strtotime($order['orderdate'])); ?></td>
      <td><?php echo $order['userid']; ?></td>
      <td><?php echo $order['email']; ?></td>
      <td><?php echo $orderItems; ?></td>
      <td>$<?php echo $orderPrice ?></td>
      <td>
        <div><?php echo $order['username']; ?></div>
        <div><?php echo $order['shippingaddress']; ?></div>
      </td>
    </tr>
  <?php } ?>
</table>

<h2>Users</h2>
<table class="table-lines">
  <tr>
    <th>User ID:</th>
    <th>User Email:</th>
    <th>User Name:</th>
    <th>Admin:</th>
  </tr>

  <?php
  foreach ($users as $user) { ?>
    <tr>
      <td><?php echo $user['userid']; ?></td>
      <td><?php echo $user['email']; ?></td>
      <td><?php echo $user['username']; ?></td>
      <td><?php
          if ($user['isadmin']) {
            echo "Yes";
          } else {
            echo "No";
          } ?></td>
    </tr>
  <?php } ?>
</table>

<?php include '../common/footer.php'; ?>