<?php
$conn = new mysqli("localhost","root","","lost_found");

if($conn->connect_error){
    die("Connection Failed: ".$conn->connect_error);
}
?>