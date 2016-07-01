<?php 
include('config.php');
$get_id=$_GET['interest_id'];
mysql_query("delete from interest where id = '$get_id' ")or die(mysql_error());
header('location:index.php');
?>