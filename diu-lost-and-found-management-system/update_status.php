<?php
include 'db.php';

$id=$_GET['id'];
$s=$_GET['s'];

$conn->query("UPDATE items SET status='$s' WHERE id=$id");

header("Location: dashboard.php");
?>