<?php 
include('config.php');
$get_id=$_GET['generation_id'];
mysql_query("delete from car_generation where id = '$get_id' ")or die(mysql_error());
header('location:index.php');
?>