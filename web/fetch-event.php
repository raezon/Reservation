<?php
    require_once "db.php";
    $json = array();
    if(!empty($_SESSION['partner_id'])){
        $search=$_SESSION['partner_id'];
        $sqlQuery = "SELECT * FROM tbl_events where partner_id='$search' ORDER BY id";

    $result = mysqli_query($conn, $sqlQuery);
    $eventArray = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $row['color']='green';
        if($row['title']=='Absent') 
            $row['color']='red';
        array_push($eventArray, $row);
    }
   
    mysqli_free_result($result);

    mysqli_close($conn);
    //i will modifier value on this array to make it simple and clear
    //when i will find a value of 
    echo json_encode($eventArray);
     }
   
?>