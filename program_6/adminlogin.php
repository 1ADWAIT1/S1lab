<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <form action="" method="POST">
            <h2> Admin Login</h2>
            <label>Username </label><br>
            <input type="text" name="username" required><br>
            <label>Password </label><br>
            <input type="password" name="password" required><br>
            <input type="submit" value="Submit">
            <input type="reset" value="Reset">
        </form>
    </body>
</html>
<?php 
if($_SERVER["REQUEST_METHOD"]=="POST"){
include "db.php";
$user=$_POST['username'];
$pass=$_POST['password'];
$stmt=$conn->prepare("select * from password where username=? and password=?");
$stmt->bind_param("ss",$user,$pass);
$stmt->execute();
$result=$stmt->get_result();
if($result->num_rows>0){
    header("Location:index.php");
    exit();
}
else{
    echo "<h3 style='color:red;'>Invalid Username or password</h3>";
}
$stmt->close();
$conn->close();
}
?>
