<?php

$servername = "localhost";
$username = "root";
$password = "";

try {

	$conn = new PDO("mysql:host=$servername;dbname=fullstack", $username, $password);
	// set the PDO error mode to exception
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$teacherName = $_POST['input'];

	$sql1 = "SELECT teacher_id
	FROM teachers
	WHERE name='$teacherName'
	LIMIT 1";


	foreach ($conn->query($sql1) as $row1) {
		$teacherId = $row1['teacher_id'];
	}

	$sql2 = "SELECT words.word, teacherword.usage_count
	FROM words
	INNER JOIN teacherword
	ON teacherword.word_id=words.word_id
	WHERE teacherword.teacher_id=$teacherId";

	print $teacherName . " is associated with:";
	print "<br>";
	print "<table>";

	foreach ($conn->query($sql2) as $row2) {


		print "<tr>";
		print "<td>" . $row2['word'] . "</td>";
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
