<?php 
include('config.php');
$get_id=$_GET['staff_id'];
mysql_query("update staff set status=2 where id = '$get_id' ")or die(mysql_error());
header('location:index.php');
?>