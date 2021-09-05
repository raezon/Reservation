<?php
require_once "db.php";

$id = $_POST['id'];
$type = $_POST['type'];
if($type==0)
$sqlDelete = "UPDATE  tbl_events Set title='Absent' WHERE id=".$id;
else
$sqlDelete = "UPDATE  tbl_events Set title='Available' WHERE id=".$id;

mysqli_query($conn, $sqlDelete);
//echo mysqli_affected_rows($conn);
mysqli_close($conn);
