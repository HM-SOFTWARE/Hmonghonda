<?php 
include('config.php');
$get_id=$_GET['cartype_id'];
mysql_query("delete from car_type where id = '$get_id' ")or die(mysql_error());
header('location:index.php');
?>