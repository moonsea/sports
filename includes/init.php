<?php
	include_once "ez_sql_core.php";
	include_once "ez_sql_mysql.php";
	$db_host = "127.0.0.1";
	$db_name = "sports";
	$db_user = "root";
	$db_password = "123456";
	$db = new ezSQL_mysql($db_user,$db_password,$db_name,$db_host,'utf-8');
	$GLOBALS['db'] = $db;
?>
