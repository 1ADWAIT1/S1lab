<?php
include 'connect.php';
echo "<script>console.log(" . json_encode($_POST) . ");</script>";

if ($_SERVER["REQUEST_METHOD"] == "POST") { 

    $user = $_POST['username'];
    $pass = $_POST['password'];

    $stmt_student = $conn->prepare("SELECT username FROM reg_stud WHERE username=? AND password=?");
    $stmt_student->bind_param("ss", $user, $pass);
    $stmt_student->execute();
    $result_student = $stmt_student->get_result();

 
    $stmt_teacher = $conn->prepare("SELECT username FROM teacher WHERE username=? AND password=?");
    $stmt_teacher->bind_param("ss", $user, $pass);
    $stmt_teacher->execute();
    $result_teacher = $stmt_teacher->get_result();

 
    if ($result_student->num_rows == 1) {
        $row = $result_student->fetch_assoc();
        session_start();
        $_SESSION['username'] = $row['username'];
        $_SESSION['role'] = "student";

        header("Location: stud_dashboard.php");
        exit();

    } elseif ($result_teacher->num_rows == 1) {
        $row = $result_teacher->fetch_assoc();
        session_start();
        $_SESSION['username'] = $row['username'];
        $_SESSION['role'] = "teacher";

        header("Location: teacher_dashboard.php");
        exit();

    } else {
        echo "<h3 style='color:red;'>Invalid username or password</h3>";
    }

    $stmt_student->close();
    $stmt_teacher->close();
}

$conn->close();
?>



<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <form action="" method="post"> 
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>

        <input type="submit" value="Login">
    </form>

   <script>
document.querySelector("form").addEventListener("submit", function (e) {
    e.preventDefault();
    console.log("Username:", document.getElementById("username").value);
    console.log("Password:", document.getElementById("password").value);

    this.submit();  
});
</script>


</body>
</html>
