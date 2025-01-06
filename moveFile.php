<?php 
    $profile=rand(1,1000).'_'.$_FILES['profile']['name'];
    $tmp_name=$_FILES['profile']['tmp_name'];
    $path='./Image/'.$profile;
    move_uploaded_file($tmp_name,$path);
    echo $profile;
?>