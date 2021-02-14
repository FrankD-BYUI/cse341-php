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
    <form action="" method="POST">
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
        <input type="hidden" name="action" value="insert">
        <?php
        // stretch activity 2
        $action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);
        $book = filter_input(INPUT_POST, 'book', FILTER_SANITIZE_STRING);
        $chapter = filter_input(INPUT_POST, 'chapter', FILTER_SANITIZE_STRING);
        $verse = filter_input(INPUT_POST, 'verse', FILTER_SANITIZE_STRING);
        $content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_STRING);
        $topics = !empty($_POST['topics']) ? $_POST['topics'] : array();
        $other = !empty($_POST['chkOther']) ? filter_input(INPUT_POST, 'other', FILTER_SANITIZE_STRING) : "";

        if (!empty($action)) {
            $sql = "INSERT INTO scriptures (book, chapter, verse, content) VALUES (:book, :chapter, :verse, :content)";
            $stmt = $connection->prepare($sql);
            $stmt->bindValue(':book', $book);
            $stmt->bindValue(':chapter', $chapter);
            $stmt->bindValue(':verse', $verse);
            $stmt->bindValue(':content', $content);
            $stmt->execute();
            $scripture_id = $connection->lastInsertId("scriptures_id_seq");
            $stmt->closeCursor();

            foreach ($topics as $topic) {
                $sql = "INSERT INTO topic_scriptures (topic_id, scripture_id) VALUES (:topic_id, :scripture_id)";
                $stmt = $connection->prepare($sql);
                $stmt->bindValue(':topic_id', $topic);
                $stmt->bindValue(':scripture_id', $scripture_id);
                $stmt->execute();
                $stmt->closeCursor();
            }

            // stretch activity 1
            if (!empty($other)) {
                $sql = "INSERT INTO topic (name) VALUES (:name)";
                $stmt = $connection->prepare($sql);
                $stmt->bindValue(':name', $other);
                $stmt->execute();
                $topic_id = $connection->lastInsertId("topic_id_seq");
                $stmt->closeCursor();

                $sql = "INSERT INTO topic_scriptures (topic_id, scripture_id) VALUES (:topic_id, :scripture_id)";
                $stmt = $connection->prepare($sql);
                $stmt->bindValue(':topic_id', $topic_id);
                $stmt->bindValue(':scripture_id', $scripture_id);
                $stmt->execute();
                $stmt->closeCursor();
            }

            $sql = "SELECT * from scriptures";
            $stmt = $connection->prepare($sql);
            $stmt->execute();
            $scriptures = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $stmt->closeCursor();

            echo "<hr>";
            echo "<h2>Scriptures</h2>";

            foreach ($scriptures as $scripture) {
                echo "<p><strong>$scripture[book] $scripture[chapter]:$scripture[verse]</strong><br>";
                echo '"' . $scripture['content'] . '"';

                $sql = "SELECT t.name FROM topic t, topic_scriptures ts WHERE ts.topic_id = t.id AND ts.scripture_id = :scripture_id";
                $stmt = $connection->prepare($sql);
                $stmt->bindValue(':scripture_id', $scripture['id']);
                $stmt->execute();
                $topics = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $stmt->closeCursor();

                echo "<br><i><strong>Topics:</strong></i> ";
                foreach ($topics as $topic) {
                    echo "$topic[name] ";
                }
                echo "</p>";
            }
        }
        ?>
    </form>
</body>

</html>