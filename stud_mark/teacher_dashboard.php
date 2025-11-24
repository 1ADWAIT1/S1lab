<?php
session_start();

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'teacher') {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Teacher Dashboard</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        h1, h2 { text-align: center; }
        .menu a {
            display: block;
            padding: 10px;
            margin: 6px 0;
            background: #f0f0f0;
            text-decoration: none;
            color: #333;
            border-radius: 4px;
        }
        .menu a:hover { background: #e0e0e0; }
        .logout { text-align: center; margin-top: 20px; display: block; color: #c00; text-decoration: none; }
    </style>
</head>
<body>

<h1>Teacher Dashboard</h1>
<h2>Welcome, <?php echo $username; ?></h2>

<div class="menu">
    <a href="student_registration.php">Student Registration</a>
    <a href="mark_entry.php">Mark Entry</a>
    <a href="mark_update.php">Update Marks</a>
    <a href="update_student.php">Update Student Info</a>

</div>

<a href="logout.php" class="logout">Logout</a>

</body>
</html>
