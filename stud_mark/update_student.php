<?php
include "teacher_session.php"; 
include "connect.php";

$message = "";
$student_found = false;
$student = null;
$roll_no = "";

if (isset($_POST['search'])) {
    $roll_no = $_POST['roll_no'];

    $stmt = $conn->prepare("SELECT * FROM reg_stud WHERE roll_no=?");
    $stmt->bind_param("s", $roll_no);
    $stmt->execute();
    $student = $stmt->get_result()->fetch_assoc();
    $stmt->close();

    if ($student) {
        $student_found = true;
    } else {
        $message = "Roll Number not found!";
    }
}


if (isset($_POST['update'])) {

    $roll_no = $_POST['roll_no']; 
    $username = $_POST['username'];
    $address = $_POST['address'];
    $phno = $_POST['phno'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("UPDATE reg_stud 
                            SET username=?, address=?, phno=?, password=? 
                            WHERE roll_no=?");

    $stmt->bind_param("sssss", $username, $address, $phno, $password, $roll_no);

    if ($stmt->execute()) {
        $message = "Student information updated successfully!";
    } else {
        $message = "Error: " . $stmt->error;
    }

    $stmt->close();
}

if (isset($_POST['delete'])) {

  $roll_no = $_POST['roll_no'];


$stmt1 = $conn->prepare("DELETE FROM reg_stud WHERE roll_no=?");
$stmt1->bind_param("s", $roll_no);

$stmt2 = $conn->prepare("DELETE FROM stud WHERE roll_no=?");
$stmt2->bind_param("s", $roll_no);


if ($stmt1->execute() && $stmt2->execute()) {
    $message = "Student and marks deleted successfully!";
    $student_found = false;
    $student = null;
} else {
    $message = "Error deleting student: " . $conn->error;
}

$stmt1->close();
$stmt2->close();

}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Student Info</title>
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
        button { width: 100%; padding: 10px; background: #333; color: white; border: none; margin-top: 10px; }
        .msg { text-align:center; color: green; }
        .err { text-align:center; color: red; }
    </style>
</head>
<body>

<h1 style="text-align:center;">Update Student Info</h1>

<?php
if (!empty($message)) {
    echo "<p class='" . ($student_found ? "msg" : "err") . "'>$message</p>";
}
?>

<form method="POST">
    <h3>Search by Roll Number</h3>
    <input type="text" name="roll_no" placeholder="Enter Roll Number" required>
    <button type="submit" name="search">Search</button>
</form>

<?php if ($student_found): ?>

<form method="POST">
    <h3>Update Info for Roll No: <b><?php echo $roll_no; ?></b></h3>

    <input type="hidden" name="roll_no" value="<?php echo $roll_no; ?>">

    <input type="text" name="username" placeholder="Username" value="<?php echo $student['username']; ?>" required>
    <input type="text" name="address" placeholder="Address" value="<?php echo $student['address']; ?>" required>
    <input type="text" name="phno" placeholder="Phone Number" value="<?php echo $student['phno']; ?>" required>
    <input type="text" name="password" placeholder="Password" value="<?php echo $student['password']; ?>" required>

    <button type="submit" name="update">Update Student</button>
    <button type="submit" name="delete" onclick="return confirm('Are you sure you want to delete this student?');" style="background:red;">Delete Student</button>
</form>
<?php endif; ?>

</body>
</html>
