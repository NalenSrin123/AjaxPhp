<?php 
include 'connection.php';
global $connection;
    $id=$_POST['emp_id'];
    $sql="DELETE FROM `employee` WHERE `employee_id`='$id'";
    $connection->query($sql);
    echo $id;
?>