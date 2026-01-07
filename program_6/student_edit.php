<?php
include("db.php");

$roll = $_GET['rollno'];

$r = $conn->query("SELECT * FROM students WHERE rollno='$roll'")->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <title>Edit Student</title>
</head>

<body>

<h2>Update / Delete Student</h2>

<form method="post">

Roll No:
<input type="text" name="rollno" value="<?= $r['rollno'] ?>" readonly><br><br>

Name:
<input type="text" name="name" value="<?= $r['name'] ?>" readonly><br><br>

Address:
<input type="text" name="address" value="<?= $r['address'] ?>"><br><br>

Phone:
<input type="text" name="phone" value="<?= $r['phone'] ?>"><br><br>

<input type="submit" name="update" value="Update">
<input type="submit" name="delete" value="Delete">

</form>

<?php
if (isset($_POST['update'])) {

    $addr = $_POST['address'];
    $ph   = $_POST['phone'];

    $conn->query("UPDATE students SET address='$addr', phone='$ph' WHERE rollno='$roll'");

    echo "<script>alert('Student Updated');</script>";
}

if (isset($_POST['delete'])) {

    $conn->query("DELETE FROM students WHERE rollno='$roll'");

    echo "<script>alert('Student Deleted');</script>";
}
?>

</body>
</html>