<?php
include 'connect.php';

$student_found = false;
$message = "";
$roll_no = "";

if (isset($_POST['search'])) {

    $roll_no = $_POST['roll_no'];

    $stmt = $conn->prepare("SELECT roll_no FROM reg_stud WHERE roll_no = ?");
    $stmt->bind_param("s", $roll_no);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $student_found = true;
    } else {
        $message = "Roll Number Not Found!";
    }
    $stmt->close();
}

if (isset($_POST['submit_marks'])) {

    $roll_no = $_POST['roll_no'];   
    $mark1   = $_POST['mark1'];
    $mark2   = $_POST['mark2'];
    $mark3   = $_POST['mark3'];
    $mark4   = $_POST['mark4'];
    $mark5   = $_POST['mark5'];
    $mark6   = $_POST['mark6'];

    $totalmarks = $mark1 + $mark2 + $mark3 + $mark4 + $mark5 + $mark6;

    $stmt = $conn->prepare("
        UPDATE stud 
        SET mark1=?, mark2=?, mark3=?, mark4=?, mark5=?, mark6=?, totalmarks=? 
        WHERE roll_no=?
    ");

    $stmt->bind_param("iiiiiiis", $mark1, $mark2, $mark3, $mark4, $mark5, $mark6, $totalmarks, $roll_no);

    if ($stmt->execute()) {
        $message = "Marks Updated Successfully!";
    } else {
        $message = "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>


<!DOCTYPE html>
<html>
<head>
    <title>Mark Entry</title>
    <style>
        body { font-family: Arial; margin: 20px; }
        form {
            max-width: 400px;
            margin: auto;
            padding: 15px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }
        input { width: 100%; padding: 8px; margin: 6px 0; }
        button { width: 100%; padding: 10px; background: #333; color: #fff; border: none; }
        .msg { text-align:center; color: green; }
        .err { text-align:center; color: red; }
    </style>
</head>
<body>

<h1 style="text-align:center;">Mark Entry</h1>

<?php 
if (!empty($message)) { 
    echo "<p class='" . ($student_found ? "msg" : "err") . "'>$message</p>"; 
} 
?>

<form method="POST">
    <label>Enter Roll No:</label>
    <input type="text" name="roll_no" required>
    <button type="submit" name="search">Search</button>
</form>

<br>

<?php if ($student_found): ?>
<form method="POST">

    <input type="hidden" name="roll_no" value="<?= htmlspecialchars($roll_no) ?>">

    <label>Mark 1:</label>
    <input type="number" name="mark1" required>

    <label>Mark 2:</label>
    <input type="number" name="mark2" required>

    <label>Mark 3:</label>
    <input type="number" name="mark3" required>

    <label>Mark 4:</label>
    <input type="number" name="mark4" required>

    <label>Mark 5:</label>
    <input type="number" name="mark5" required>

    <label>Mark 6:</label>
    <input type="number" name="mark6" required>

    <button type="submit" name="submit_marks">Submit Marks</button>
</form>
<?php endif; ?>

</body>
</html>
