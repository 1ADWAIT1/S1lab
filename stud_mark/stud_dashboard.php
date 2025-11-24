<?php
session_start();
include "connect.php";


if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'student') {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];

$stmt = $conn->prepare("SELECT username, roll_no FROM reg_stud WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$student = $stmt->get_result()->fetch_assoc();
$stmt->close();


$marks = null;

if ($student) {
    $roll_no = $student['roll_no'];

    $stmt2 = $conn->prepare("SELECT mark1, mark2, mark3, mark4, mark5, mark6, totalmarks 
                             FROM stud WHERE roll_no = ?");
    $stmt2->bind_param("s", $roll_no);
    $stmt2->execute();
    $marks = $stmt2->get_result()->fetch_assoc();
    $stmt2->close();
}

$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Student Dashboard</title>
    <style>
        body { font-family: Arial; margin: 30px; }
        .card {
            width: 450px;
            margin: auto;
            border: 2px solid #333;
            padding: 20px;
            border-radius: 10px;
        }
        h2 { text-align: center; }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        table, td, th { border: 1px solid #999; }
        th, td { padding: 8px; text-align: center; }
        .label { font-weight: bold; }
    </style>
</head>
<body>

<div class="card">
    <h2>Student Progress Card</h2>

    <p><span class="label">Name:</span> <?php echo $student['username']; ?></p>
    <p><span class="label">Roll Number:</span> <?php echo $student['roll_no']; ?></p>
    

    <h3>Marks Obtained</h3>
    <table>
        <tr><th>Subject</th><th>Marks</th></tr>
        <tr><td>Mark 1</td><td><?php echo $marks['mark1']; ?></td></tr>
        <tr><td>Mark 2</td><td><?php echo $marks['mark2']; ?></td></tr>
        <tr><td>Mark 3</td><td><?php echo $marks['mark3']; ?></td></tr>
        <tr><td>Mark 4</td><td><?php echo $marks['mark4']; ?></td></tr>
        <tr><td>Mark 5</td><td><?php echo $marks['mark5']; ?></td></tr>
        <tr><td>Mark 6</td><td><?php echo $marks['mark6']; ?></td></tr>
        <tr><th>Total</th><th><?php echo $marks['totalmarks']; ?></th></tr>
    </table>

</div>

</body>
</html>
