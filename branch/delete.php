<?php 
include('config.php');
$get_id=$_GET['branch_id'];
mysql_query("delete from branch where id = '$get_id' ")or die(mysql_error());
header('location:index.php');
?>