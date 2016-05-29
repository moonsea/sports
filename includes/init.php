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
		$db_host = "127.0.0.1";
		$db_name = "sports";
		$db_user = "root";
		$db_password = "123456";
		$db = new ezSQL_mysql($db_user,$db_password,$db_name,$db_host);
		// define("ROOT_PATH","123.57.31.72/sports");
		define("ROOT_PATH","12.0.0.1/sports");
	}
?>
