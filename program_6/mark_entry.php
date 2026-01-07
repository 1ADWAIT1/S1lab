<?php
include "db.php";
?>
<html>
<head>
<link rel="stylesheet" href="style.css">
<title>Mark Entry</title>
</head>

<body>

<h2>Mark Entry</h2>

<form method="post">

Roll No:

<select name="rollno">
<option value="">Select Roll No</option>

<?php
$res = $conn->query("SELECT rollno FROM students");

while($r = $res->fetch_assoc()) {
    echo "<option value='{$r['rollno']}'>{$r['rollno']}</option>";
}
?>
</select>

<input type="submit" name="search" value="Search"><br><br>

<?php

if (isset($_POST['search'])) {

    $roll = $_POST['rollno'];

    $r = $conn->query("SELECT * FROM students WHERE rollno='$roll'")->fetch_assoc();

    if ($r) {

        echo "Name: <input type='text' name='name' value='{$r['name']}' readonly><br><br>";

        echo "Science: <input type='text' name='science'><br><br>";

        echo "Maths: <input type='text' name='maths'><br><br>";

        echo "English: <input type='text' name='english'><br><br>";

        echo "<input type='submit' name='save' value='Save'>";

        echo "<input type='reset' value='Reset'>";

        echo "<input type='hidden' name='roll' value='{$roll}'>";
    }
}

if (isset($_POST['save'])) {

    $roll = $_POST['roll'];
    $sci  = $_POST['science'];
    $math = $_POST['maths'];
    $eng  = $_POST['english'];

    $conn->query("INSERT INTO marks VALUES('$roll','$sci','$math','$eng')");

    echo "<script>alert('Marks Saved');</script>";
}
?>

</form>

</body>
</html>