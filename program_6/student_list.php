<?php
include("db.php");
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <title>Student List</title>
</head>

<body>

<h2>All Students</h2>

<table border="1" cellpadding="5">
<tr>
    <th>Roll No</th>
    <th>Name</th>
    <th>Address</th>
    <th>Phone</th>
    <th>Action</th>
</tr>

<?php
$res = $conn->query("SELECT * FROM students");

while ($r = $res->fetch_assoc()) {
    echo "<tr>";
    echo "<td>{$r['rollno']}</td>";
    echo "<td>{$r['name']}</td>";
    echo "<td>{$r['address']}</td>";
    echo "<td>{$r['phone']}</td>";
    echo "<td>
            <a href='edit_student.php?rollno={$r['rollno']}'>
                Update / Delete
            </a>
          </td>";
    echo "</tr>";
}
?>

</table>

</body>
</html>