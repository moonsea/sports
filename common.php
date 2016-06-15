<?php
	error_reporting(0);
	include("includes/init.php");
	$api = $_POST["act"];
	if($api == "getwww")
	{
		$ret = array();
		$ret['status'] = 1;
		$ret['error'] = "SUCCESS";
		$ret['data'] = 'http://o83f02wso.bkt.clouddn.com';
		echo json_encode($ret);
		exit(); 
	}
?>