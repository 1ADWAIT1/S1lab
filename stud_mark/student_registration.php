<?php
session_start();
include 'connect.php';

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'teacher') {
    header("Location: teacher_dashboard.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST['username'];
    $roll_no  = $_POST['roll_no'];
    $address  = $_POST['address'];
    $phno     = $_POST['phno'];
    $password = $_POST['password'];

  
    $stmt = $conn->prepare("INSERT INTO reg_stud (username, roll_no, address, phno, password) 
                            VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $username, $roll_no, $address, $phno, $password);

    if ($stmt->execute()) {

        
        $stmt2 = $conn->prepare("INSERT INTO stud (roll_no, mark1, mark2, mark3, mark4, mark5, mark6, totalmarks) 
                                 VALUES (?, 0, 0, 0, 0, 0, 0, 0)");
        $stmt2->bind_param("s", $roll_no);

        if ($stmt2->execute()) {
            $message = "Student Registered Successfully and added to marks table!";
        } else {
            $message = "Student registered, but error inserting into stud: " . $stmt2->error;
        }

        $stmt2->close();

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
    <title>Student Registration</title>
    <style>
        body { font-family: Arial; margin: 20px; }
        h1 { text-align: center; }
        form {
            max-width: 400px;
            margin: auto;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
        }
        input, textarea {
            width: 100%;
            padding: 8px;
            margin: 8px 0;
        }
        button {
            padding: 10px;
            width: 100%;
            background: #333;
            color: white;
            border: none;
        }
        .msg {
            text-align: center;
            margin-bottom: 10px;
            color: green;
        }
    </style>
</head>
<body>

<h1>Student Registration</h1>

<?php if (!empty($message)) { echo "<p class='msg'>$message</p>"; } ?>

<form action="" method="POST">

    <label>Username:</label>
    <input type="text" name="username" required>

    <label>Roll No:</label>
    <input type="text" name="roll_no" required>

    <label>Address:</label>
    <textarea name="address" required></textarea>

    <label>Phone Number:</label>
    <input type="text" name="phno" required>

    <label>Password:</label>
    <input type="password" name="password" required>

    <button type="submit">Register Student</button>

</form>

</body>
</html>
