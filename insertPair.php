<html>
<body>

<?php

$servername = "localhost";
$username = "root";
$password = "";

try {


  $conn = new PDO("mysql:host=$servername;dbname=fullstack", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//print "Connected successfully";

  $teacher_name = $_POST['inputName'];
  $word = $_POST['inputWord'];

  $sql1 = "INSERT INTO teachers (name) SELECT ('$teacher_name')
    WHERE NOT EXISTS(SELECT 1 FROM teachers WHERE name='$teacher_name')";

  $sql2 = "INSERT INTO words (word) SELECT ('$word')
    WHERE NOT EXISTS(SELECT 1 FROM words WHERE word='$word')";

  $result1 = $conn->exec($sql1);
  $result2 = $conn->exec($sql2);



  $sql3 = "SELECT teacher_id FROM teachers WHERE name='$teacher_name'";
  $sql4 = "SELECT word_id FROM words WHERE word='$word'";

  foreach ($conn->query($sql3) as $row1){
    $resultT = $row1['teacher_id'];
  }

  foreach ($conn->query($sql4) as $row2){
    $resultW = $row2['word_id'];
  }

  print($resultT . "    " . $resultW);

  $sql5 = "INSERT INTO teacherword (teacher_id, word_id, usage_count)
  SELECT teachers.teacher_id, words.word_id, 1
  FROM teachers, words
  WHERE teachers.name = '$teacher_name'
  AND words.word = '$word'";

  $sql6 = "SELECT 1 FROM teacherword WHERE teacher_id='$resultT'
  AND word_id='$resultW'";

  $sql7 = "UPDATE teacherword
  SET usage_count=usage_count + 1
  WHERE teacher_id=$resultT AND word_id=$resultW";

  $conn->query($sql7);

  $pairCheck = false;

  foreach ($conn->query($sql6) as $row3){

    $pairCheck = true;

  }

  if($pairCheck == false){
    $conn->exec($sql5);
  }







}
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }





 ?>


</body>
</html>
