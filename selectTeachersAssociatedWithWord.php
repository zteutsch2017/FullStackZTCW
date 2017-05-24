<?php

$servername = "localhost";
$username = "root";
$password = "";

try {

	$conn = new PDO("mysql:host=$servername;dbname=fullstack", $username, $password);
	// set the PDO error mode to exception
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$word = $_POST['input'];

	$sql1 = "SELECT word_id
	FROM words
	WHERE word='$word'
	LIMIT 1";

	foreach ($conn->query($sql1) as $row1) {
		$wordId = $row1['word_id'];
	}

	$sql2 = "SELECT teachers.name, teacherword.usage_count
	FROM teachers
	INNER JOIN teacherword
	ON teacherword.teacher_id=teachers.teacher_id
	WHERE teacherword.word_id=$wordId";

	print "\"" . $word . "\"" . " is associated with:";
	print "<br>";
	print "<table>";

	foreach ($conn->query($sql2) as $row2) {


		print "<tr>";
		print "<td>" . $row2['name'] . "</td>";
		print "<td>" . $row2['usage_count'] . "</td>";
		print "</tr>";
	}
	print "</table>";

}
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }

?>
