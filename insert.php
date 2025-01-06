<?php 
    include 'connection.php';
    global $connection;
    $name=$_POST['emp_name'];
    $sex=$_POST['emp_sex'];
    $position=$_POST['emp_position'];
    $salary=$_POST['emp_salary'];
    $rate=$_POST['emp_rate'];
    $hour=$_POST['emp_hour'];
    $profile=$_POST['emp_profile'];
    $income=$salary+$rate*$hour;
    $sql="INSERT INTO `employee`(`name`, `sex`, `position`, `salary`, `rate`, `hour`, `income`, `profile`)
         VALUES ('$name','$sex','$position','$salary','$rate','$hour','$income','$profile')";
    $connection->query($sql);


    $select="SELECT `employee_id` FROM `employee` ORDER BY `employee_id` DESC LIMIT 1";
    $data=$connection->query($select);
    while($row=$data->fetch_assoc()){
       echo $row['employee_id'];
    }

?>