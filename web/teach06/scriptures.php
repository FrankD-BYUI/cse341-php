<?php
require 'db.php';

$connection = connectDB();

$book = filter_input(INPUT_POST, 'book', FILTER_SANITIZE_STRING);
$chapter = filter_input(INPUT_POST, 'chapter', FILTER_SANITIZE_STRING);
$verse = filter_input(INPUT_POST, 'verse', FILTER_SANITIZE_STRING);
$content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_STRING);
$topics = !empty($_POST['topics']) ? $_POST['topics'] : array();
$other = !empty($_POST['chkOther']) ? filter_input(INPUT_POST, 'other', FILTER_SANITIZE_STRING) : "";

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
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Week 06 Teach: Team Activity</title>
</head>

<body>
	<h1>Scriptures</h1>
	<?php
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
	?>
</body>

</html>