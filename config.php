<?php
session_start();
$conn = mysql_connect("localhost", "root", "")or die("Could not connect to the server.");
mysql_select_db("hmonghonda", $conn)or die("Could not select the database.");
//$conn = mysql_connect("localhost", "fajtimye_user", "da123!@#")or die("Could not connect to the server.");
//mysql_select_db("fajtimye_hmdb", $conn)or die("Could not select the database.");
mysql_query("set names 'utf8'"); // this code roader unicode
if (isset($_GET['type_user'])) {
    $_SESSION['type_user'] = $_GET['type_user'];
    $_SESSION['user_id'] = $_GET['user_id'];
}
if (!isset($_SESSION['type_user'])) {
    header('location:/sys/index.php?r=site/login');
}
?>