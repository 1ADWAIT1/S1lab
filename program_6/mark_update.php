<?php include("db.php"); ?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <title>Mark Update</title>
</head>

<body>

<h2>Mark Update</h2>

<form method="post">

Roll No:

<select name="rollno">
    <option value="">Select Roll No</option>

<?php
$res = $conn->query("SELECT rollno FROM students");

while ($r = $res->fetch_assoc()) {
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

        echo "<input type='submit' name='save' value='Update'> ";

        echo "<input type='reset' value='Reset'>";

        echo "<input type='hidden' name='roll' value='{$roll}'>";
    }
}

if (isset($_POST['save'])) {

    $roll = $_POST['roll'];
    $sci  = $_POST['science'];
    $math = $_POST['maths'];
    $eng  = $_POST['english'];

    $conn->query("UPDATE marks SET science='$sci', maths='$math', english='$eng' WHERE rollno='$roll'");

    echo "<script>alert('Marks Updated');</script>";
}
?>

</form>

</body>
</html>