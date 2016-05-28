<?php
	if(!defined("SPORTS"))
	{
		echo "HACK!";
		die();
	}
	else
	{
		include_once "ez_sql_core.php";
		include_once "ez_sql_mysql.php";
		$db_host = "123.57.31.72";
		$db_name = "sports";
		$db_user = "root";
		$db_password = "";
		$db = new ezSQL_mysql($db_user,$db_password,$db_name,$db_host);
		define("ROOT_PATH","123.57.31.72/sports");
	}
?>