<?php 
date_default_timezone_set('asia/phnom_penh');
include 'connection.php';
global $connection;
    $id=$_POST['id'];
    $name=$_POST['name'];
    $sex=$_POST['sex'];
    $position=$_POST['position'];
    $salary=$_POST['salary'];
    $rate=$_POST['rate'];
    $hour=$_POST['hour'];
    $income=$_POST['income'];
    $profile=$_POST['profile'];
    $update_at=date('ymd');
    
    $sql="UPDATE `employee` SET `name`='$name',`sex`='$sex',`position`='$position',`salary`='$salary',`rate`='$rate',`hour`='$hour'
    ,`income`='$income', `profile`='$profile' ,`update_at`='$update_at' WHERE `employee_id`='$id';";
    $res=$connection->query($sql);
    
    echo $res;
?>