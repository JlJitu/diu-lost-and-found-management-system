<?php
include 'db.php';

if(isset($_POST['reg'])){
$name=$_POST['name'];
$email=$_POST['email'];
$pass=$_POST['password'];

$conn->query("INSERT INTO users(name,email,password)
VALUES('$name','$email','$pass')");

header("Location: login.php");
}
?>

<form method="POST">
<input name="name"><br>
<input name="email"><br>
<input name="password"><br>
<button name="reg">Register</button>
</form>