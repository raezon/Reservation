<?php
session_start();
$conn = mysqli_connect("localhost","root","","clicangodb") ;

if (!$conn)
{
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
?>