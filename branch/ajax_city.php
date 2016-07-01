<?php
include('config.php');
if($_POST['id'])
{

$province_id=$_POST['id'];
$sql=mysql_query("select * from district where province_id='$province_id'");
while($row=mysql_fetch_array($sql))
{
$id=$row['id'];
$district_name=$row['district_name'];
echo '<option value="'.$id.'">'.$district_name.'</option>';
}
}
?>