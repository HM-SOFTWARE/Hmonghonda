<?php
// This script was created by phpMyBackupPro 2.5 (http://www.phpMyBackupPro.net)
// In order to work probably, it must be saved in the directory /var/www/html/phpMyBackupPro/.
$_POST['db']=array("fajtimye_hmdb");
$_POST['tables']="on";
$_POST['data']="on";
$_POST['drop']="on";
$_POST['zip']="zip";
$_POST['mysql_host']="-1";
$period=(3600*24)*0;
$security_key="708d4c3d7574be574a1a07daa1966604";
// switch to the phpMyBackupPro 2.5 directory
@chdir("/home/fajtimyeej/public_html/phpMyBackupPro/");
//@chdir("/var/www/html");
@include("backup.php");
// switch back to the directory containing this script
?>
