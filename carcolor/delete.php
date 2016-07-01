<?php 
include('config.php');
$get_id=$_GET['corlor_id'];
mysql_query("delete from car_color where id = '$get_id' ")or die(mysql_error());
header('location:index.php');
?>