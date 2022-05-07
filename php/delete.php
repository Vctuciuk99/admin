<?php 

$mysqli = require "../php/database_conn.php";

error_reporting(0);

$items = $_GET['employee'];
//print_r($items);
$query = "DELETE FROM `user_personal_info` WHERE `Employee_No` = '$items'";

$data = mysqli_query($mysqli, $query);

if($data)
{   
    header("Location: ../views/manage_user.php");
}
else
{
    echo "FAILED";
}


?>