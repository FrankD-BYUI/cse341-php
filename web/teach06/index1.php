<?php
require 'db.php';

$connection = connectDB();

$sql = "SELECT * from topic";
$stmt = $connection->prepare($sql);
$stmt->execute();
$topics = $stmt->fetchAll(PDO::FETCH_ASSOC);
$stmt->closeCursor();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Week 06 Teach: Team Activity</title>
</head>

<body>
    <form action="scriptures.php" method="POST">
        <p>
            <label for="book">Book:</label>
            <input type="text" name="book" id="book">
        </p>
        <p>
            <label for="chapter">Chapter:</label>
            <input type="text" name="chapter" id="chapter">
        </p>
        <p>
            <label for="verse">Verse:</label>
            <input type="text" name="verse" id="verse">
        </p>
        <p>
            <label for="content">Content:</label><br>
            <textarea name="content" id="content" cols="30" rows="10"></textarea>
        </p>
        <p>
            <label for="topics[]">Topics:</label><br>
            <?php
            foreach ($topics as $topic) {
                echo "<input type='checkbox' name='topics[]' id='topics$topic[id]' value='$topic[id]'>";
                echo "<label for='topics$topic[id]'>$topic[name]</label><br>";
            }
            echo "<input type='checkbox' name='chkOther' id='chkOther'>";
            echo "<input type='text' name='other' value=''><br>";
            ?>
        </p>
        <input type="submit" value="Submit">
    </form>
</body>

</html>