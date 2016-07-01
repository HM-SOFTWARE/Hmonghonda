<?php 
include('config.php');
$get_id=$_GET['brand_id'];
mysql_query("delete from brand where id = '$get_id' ")or die(mysql_error());
header('location:index.php');
?>