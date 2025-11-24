<?php
session_start();
include "connect.php";


if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'teacher') {
    header("Location: login.php");
    exit();
}

$student_found = false;
$message = "";
$marks = null;
$roll_no = "";


if (isset($_POST['search'])) {
    $roll_no = $_POST['roll_no'];

    $stmt = $conn->prepare("SELECT * FROM stud WHERE roll_no = ?");
    $stmt->bind_param("s", $roll_no);
    $stmt->execute();
    $marks = $stmt->get_result()->fetch_assoc();
    $stmt->close();

    if ($marks) {
        $student_found = true;
    } else {
        $message = "No marks found for this Roll Number!";
    }
}


if (isset($_POST['update_marks'])) {

    $roll_no = $_POST['roll_no'];
    $mark1   = $_POST['mark1'];
    $mark2   = $_POST['mark2'];
    $mark3   = $_POST['mark3'];
    $mark4   = $_POST['mark4'];
    $mark5   = $_POST['mark5'];
    $mark6   = $_POST['mark6'];

    $total = $mark1 + $mark2 + $mark3 + $mark4 + $mark5 + $mark6;

    $stmt = $conn->prepare("UPDATE stud 
                            SET mark1=?, mark2=?, mark3=?, mark4=?, mark5=?, mark6=?, totalmarks=? 
                            WHERE roll_no=?");

    $stmt->bind_param("iiiiiiis", $mark1, $mark2, $mark3, $mark4, $mark5, $mark6, $total, $roll_no);

    if ($stmt->execute()) {
        $message = "Marks Updated Successfully!";
    } else {
        $message = "Error updating marks: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update Student Marks</title>
    <style>
        body { font-family: Arial; margin: 20px; }
        form {
            max-width: 450px;
            margin: auto;
            padding: 15px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }
        input { width: 100%; padding: 8px; margin: 6px 0; }
        button { width: 100%; padding: 10px; background: #333; color: white; border: none; }
        .msg { text-align:center; color: green; }
        .err { text-align:center; color: red; }
    </style>
</head>
<body>

<h1 style="text-align:center;">Update Student Marks</h1>

<?php 
if (!empty($message)) { 
    echo "<p class='" . ($student_found ? "msg" : "err") . "'>$message</p>"; 
} 
?>


<form method="POST">
    <h3>Search Roll Number</h3>
    <input type="text" name="roll_no" placeholder="Enter Roll Number" required>
    <button type="submit" name="search">Search</button>
</form>

<?php if ($student_found): ?>

<form method="POST">
    <h3>Update Marks for Roll No: <b><?php echo $roll_no; ?></b></h3>

    <input type="hidden" name="roll_no" value="<?php echo $roll_no; ?>">

    <input type="number" name="mark1" value="<?php echo $marks['mark1']; ?>" required>
    <input type="number" name="mark2" value="<?php echo $marks['mark2']; ?>" required>
    <input type="number" name="mark3" value="<?php echo $marks['mark3']; ?>" required>
    <input type="number" name="mark4" value="<?php echo $marks['mark4']; ?>" required>
    <input type="number" name="mark5" value="<?php echo $marks['mark5']; ?>" required>
    <input type="number" name="mark6" value="<?php echo $marks['mark6']; ?>" required>

    <button type="submit" name="update_marks">Update Marks</button>
</form>
<?php endif; ?>

</body>
</html>
