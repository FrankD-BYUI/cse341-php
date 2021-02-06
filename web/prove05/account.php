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



$pageTitle = "Silly Scents | My Account";
include $_SERVER['DOCUMENT_ROOT'] . '/prove05/common/header.php';
?>

<h1>Hello<?php echo $user['fname']; ?></h1>
<p>Name: <?php echo $user['fname'] . " " . $user['lname'] ?></p>
<p>Email: <?php echo $user['email']?> </p>

<h2>Order History</h2>

<?php include $_SERVER['DOCUMENT_ROOT'] . 'prove05/common/footer.php'; ?>