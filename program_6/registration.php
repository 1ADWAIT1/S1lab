<!DOCTYPE html>
<?php include('db.php');?>
<html>
<head></head>
<body>
<form action="POST">
    roll number<input type="text" name="rollno" required><br>
    name <input type="text" name="name" required><br>
    address <input type="text" name="address"><br>
    phone <input type="text" name="phone"><br>
    username <input type="text" name="username"><br>
    password <input type="password" name="password"><br>
    Retype password<input type="password" name="repass"><br>
    <input type="submit" name="register" value="Register">
</form>
<?php
if(isset($_POST['register'])){
    $conn->query("insert into students(rollno,name,address,phone,username,password) values('$_POST['rollno']','$_POST['name']','$_POST['address']','$_POST['phone']','$_POST['username']','$_POST['password']')");
    echo"success";
}
?>
    
</body></html>